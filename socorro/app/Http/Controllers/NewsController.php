<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News;
use App\Models\CategoriesNews;
use Exception;

class NewsController extends Controller
{
    public function index()
    {
        return view('module.news.index');
    }

    public function data()
    {
        $news = News::all();
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

    public function create()
    {
        return view('module.news.create');
    }
}
