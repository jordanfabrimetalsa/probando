<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostulationsPeople;
use Exception;

class PostulationsPeopleController extends Controller
{
    public function data($id){
        try{
            $postulationsPeople = PostulationsPeople::where('postulation_id', $id)->get();
            return response()->json($postulationsPeople);
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function store(Request $request){
        try{
            $postulationPeople = PostulationsPeople::create($request->all());
            return response()->json($postulationPeople);
        }catch(Exception $e){
            return response()->json($e);
        }
    }
}
