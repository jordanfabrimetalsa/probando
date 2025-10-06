<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rescue;
use App\Models\Voluntary;
use Exception;

class RescueController extends Controller
{
    public function index(){
        $voluntaries = Voluntary::all();
        return view('module.registro_rescate.index', compact('voluntaries'));
    }

    public function data(){
        try{
            $rescue = Rescue::all();
            return response()->json($rescue);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
