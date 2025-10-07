<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function store(Request $request){
        try{
            $rescue = new Rescue();
            $rescue->type = $request->type;
            $rescue->place = $request->place;
            $rescue->road = $request->road;
            $rescue->weather = $request->weather;
            $rescue->kilometer_total = $request->kilometer_total;
            $rescue->different_height = $request->different_height;
            $rescue->quantity_people = $request->quantity_people;
            $rescue->quantity_voluntaries = $request->quantity_voluntaries;
            $rescue->helper_external = $request->helper_external;
            $rescue->external_helper = $request->external_helper;
            $rescue->name_accident = $request->name_accident;
            $rescue->phone_accident = $request->phone_accident;
            $rescue->email_accident = $request->email_accident;
            $rescue->address = $request->address;
            $rescue->city = $request->city;
            $rescue->state = $request->state;
            $rescue->allergic = $request->allergic;
            $rescue->disease = $request->disease;
            $rescue->date_call = $request->date_call;
            $rescue->date_start_trek = $request->date_start_trek;
            $rescue->date_middle_trek = $request->date_middle_trek;
            $rescue->date_finish_rescue = $request->date_finish_rescue;
            $rescue->injury = $request->injury;
            $rescue->gravity = $request->gravity;
            $rescue->medical_assistance = $request->medical_assistance;
            $rescue->Stretcher = $request->Stretcher;
            $rescue->type_transport = $request->type_transport;
            $rescue->helicopter = $request->helicopter;
            $rescue->voluntario_id = $request->voluntary_id;
            $rescue->user_id = Auth::user()->id;
            $rescue->situation = $request->situation;
            $rescue->observations = $request->observations;
            $rescue->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Rescate registrado correctamente'
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function edit($id){
        $rescue = Rescue::find($id);
        return response()->json($rescue);
    }

    public function update(Request $request, $id){

    }

    public function destroy($id){

    }
}
