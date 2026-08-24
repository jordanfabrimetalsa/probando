<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\CategoriesNews;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class NewsController extends Controller
{
    public function index()
    {
        return view('module.news.index');
    }

    public function data()
    {
        $news = News::with(['category', 'user'])->get();
        return response()->json($news);
    }

    public function categoryData()
    {
        $categories = CategoriesNews::all();
        return response()->json($categories);
    }

    public function categoryStore(Request $request){
        try{
            $category = new CategoriesNews();
            $category->name = $request->name;
            $category->save();
            return response()->json($category);
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function store(Request $request)
    {
        try{
            $validated = $request->validate([
                'title' => ['required', 'string', 'max:180'],
                'editor' => ['required', 'string', 'min:20'],
                'category_id' => ['required', 'exists:categories_news,id'],
                'featured' => ['required', 'boolean'],
                'image' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            ], [
                'editor.required' => 'Escribe el contenido de la noticia.',
                'editor.min' => 'El contenido debe tener al menos 20 caracteres.',
                'category_id.required' => 'Selecciona una categoría.',
                'featured.required' => 'Selecciona la visibilidad de la noticia.',
                'image.required' => 'Selecciona una imagen de portada.',
            ]);
            $news = new News();
            $news->title = $validated['title'];
            $news->slug = Str::slug($validated['title']);
            $news->description = $validated['editor'];
            $news->category_id = $validated['category_id'];
            $news->featured = $validated['featured'];
            $news->user_id = Auth::user()->id;

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('news', 'public');
                $news->image = $path;
            }

            $news->save();
            return response()->json($news);
        }catch(ValidationException $e){
            throw $e;
        }catch(Exception $e){
            report($e);
            return response()->json(['message' => 'No fue posible crear la noticia.'], 500);
        }
    }

    public function show($id){
        try{
            $news = News::with(['category', 'user'])->findOrFail($id);
            if ($news && $news->image) {
                $news->image = asset('storage/' . $news->image);
            }
            return response()->json($news);
        }catch(Exception $e){
            return response()->json(['message' => 'No fue posible encontrar la noticia.'], 404);
        }
    }

    public function destroy($id)
    {
        try {
            $news = News::findOrFail($id);
            $imagePath = $news->image;

            $news->delete();

            if ($imagePath) {
                Storage::disk('public')->delete($imagePath);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'La noticia fue eliminada correctamente.',
            ]);
        } catch (Exception $e) {
            report($e);

            return response()->json([
                'status' => 'error',
                'message' => 'No fue posible eliminar la noticia.',
            ], 500);
        }
    }
}
