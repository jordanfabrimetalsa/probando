<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\CategoriesNews;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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
            $news = new News();
            $news->title = $request->title;
            $news->slug = Str::slug($request->title);
            $news->description = $request->editor;
            $news->category_id = $request->category_id;
            $news->featured = $request->featured;
            $news->user_id = Auth::user()->id;

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('news', 'public');
                $news->image = $path;
            }

            $news->save();
            return response()->json($news);
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function show($id){
        try{
            $news = News::with(['category', 'user'])->find($id);
            if ($news && $news->image) {
                $news->image = asset('storage/' . $news->image);
            }
            return response()->json($news);
        }catch(Exception $e){
            return response()->json($e);
        }
    }
}
