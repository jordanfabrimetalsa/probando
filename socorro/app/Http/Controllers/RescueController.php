<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rescue;
use App\Models\Voluntary;
use Exception;
use PDF;
use Illuminate\Support\Facades\Storage;

class RescueController extends Controller
{
    public function index(){
        $voluntaries = Voluntary::all();
        return view('module.registro_rescate.index', compact('voluntaries'));
    }

    public function registerComun(){
        $voluntaries = Voluntary::all();
        return view('module.registro_rescate.register_comun', compact('voluntaries'));
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

    public function show($id){
        try{
            $rescue = Rescue::join('voluntaries', 'rescue.voluntario_id', '=', 'voluntaries.id')
                            ->select('rescue.*', 'voluntaries.name as voluntary_name', 'voluntaries.lastname as voluntary_lastname')
                            ->find($id);

            if(!$rescue){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Registro no encontrado'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $rescue
            ], 200);

        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error interno: ' . $id . ' -  ' . $e->getMessage()
            ], 500);
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

            $pdf = PDF::loadView('module.pdf.rescue', compact('rescue'));

            $relativePath = "rescues/rescue_{$rescue->id}.pdf"; // dentro de 'public' disk
            Storage::disk('public')->put($relativePath, $pdf->output());

            return response()->json([
                'status' => 'success',
                'message' => 'Rescate registrado correctamente',
                'download_url' => Storage::disk('public')->url($relativePath) // opcional
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function pdf($id)
    {
        $rescue = \App\Models\Rescue::findOrFail($id);
        $path = "rescues/rescue_{$rescue->id}.pdf";

        if (!Storage::disk('public')->exists($path)) {
            $pdf = PDF::loadView('module.pdf.rescue', compact('rescue'));
            Storage::disk('public')->put($path, $pdf->output());
        }

        $absolutePath = \Storage::disk('public')->path($path);

        return response()->file($absolutePath);
    }

    public function update(Request $request, $id){
        try{
            $rescue = Rescue::find($id);
            if($rescue->situation != 'completed'){
                $rescue->type = $request->type_show_hidden;
                $rescue->place = $request->place_show;
                $rescue->road = $request->road_show;
                $rescue->weather = $request->weather_show_hidden;
                $rescue->kilometer_total = $request->kilometer_total_show;
                $rescue->different_height = $request->different_height_show;
                $rescue->quantity_people = $request->quantity_people_show;
                $rescue->quantity_voluntaries = $request->quantity_voluntaries_show;
                $rescue->helper_external = $request->helper_external_show_hidden;
                $rescue->external_helper = $request->external_helper_show_hidden;

                $rescue->name_accident = $request->name_accident_show;
                $rescue->phone_accident = $request->phone_accident_show;
                $rescue->email_accident = $request->email_accident_show;
                $rescue->address = $request->address_show;
                $rescue->city = $request->city_show;
                $rescue->state = $request->state_show;
                $rescue->allergic = $request->allergic_show;
                $rescue->disease = $request->disease_show;

                $rescue->date_call = $request->date_call_show;
                $rescue->date_start_trek = $request->date_start_trek_show;
                $rescue->date_middle_trek = $request->date_middle_trek_show;
                $rescue->date_finish_rescue = $request->date_finish_rescue_show;
                $rescue->injury = $request->injury_show;
                $rescue->gravity = $request->gravity_show;
                $rescue->medical_assistance = $request->medical_assistance_show_hidden;

                $rescue->Stretcher = $request->Stretcher_show_hidden;
                $rescue->type_transport = $request->type_transport_show_hidden;
                $rescue->helicopter = $request->helicopter_show_hidden;
                $rescue->voluntario_id = $request->voluntary_id_show_hidden;
                $rescue->situation = $request->situation_show;
                $rescue->observations = $request->observations_show;
                $rescue->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Rescate actualizado correctamente: ' . $request
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'No se puede actualizar el rescate, porque ya esta completado.'
                ]);
            }

        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id){
        $rescue = Rescue::find($id);

        if(!$rescue){
            return response()->json([
                'status' => 'error',
                'message' => 'Rescate no encontrado por: ' . $rescue
            ], 404);
        }

        $rescue->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Rescate eliminado correctamente'
        ]);
    }
}
