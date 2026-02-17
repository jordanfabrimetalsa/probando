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
            $news->description = $request->description;
            $news->category_id = $request->category_id;
            $news->user_id = Auth::user()->id;
            $name_image = time().".".$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images/news'), $name_image);
            $news->image = $name_image;
            $news->save();
            return response()->json($news);
        }catch(Exception $e){
            return response()->json($e);
        }
    }
}
