<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\SendOut;
use Exception;

class SendOutController extends Controller
{
    public function store(Request $request)
    {
        try{
            $request->validate([
                'name' => 'required',
                'lastname' => 'required',
                'document_type' => 'required',
                'document_number' => 'required',
                'email' => 'required|email',
                'phone' => 'required|numeric',
                'region' => 'required',
                'destination' => 'required',
                'route' => 'required',
                'activity' => 'required',
                'number_participants' => 'required|numeric',
                'departure_date' => 'required|date',
                'return_date' => 'required|date',
            ]);

            $sendout_search = SendOut::where('document_number', $request->document_number)
                                        ->where('active', 1)
                                        ->first();

            if ($sendout_search) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al guardar la salida',
                    'error' => 'Aun tienes un aviso activo.'
                ], 409);
            }else{
                $sendout = new SendOut;
            }

            $sendout->name = $request->name;
            $sendout->lastname = $request->lastname;
            $sendout->document_type = $request->document_type;
            $sendout->document_number = $request->document_number;
            $sendout->email = $request->email;
            $sendout->phone = $request->phone;
            $sendout->region = $request->region;
            $sendout->destination = $request->destination;
            $sendout->route = $request->route;
            $sendout->activity = $request->activity;
            $sendout->number_participants = $request->number_participants;
            $sendout->departure_date = $request->departure_date;
            $sendout->return_date = $request->return_date;
            $sendout->active = 1;

            if($request->hasFile('file_path')){
                $file = $request->file('file_path');

                $path = $file->store('sendouts', 'public');

                $sendout->file_path = $path;
            }

            if ($sendout->save()) {
                return response()->json([
                    'success' => true,
                    'data' => $sendout,
                    'message' => 'Salida guardada correctamente'
                ]);
            }else{
                Log::error('Error al guardar la salida: ' . $sendout->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Error al guardar la salida'
                ], 500);
            }
        }catch(Exception $e){
            Log::error('Error al guardar la salida: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar la salida',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function search(Request $request)
    {
        try{
            $sendout = SendOut::where('document_number', $request->rut)->get();

            if ($sendout) {
                return response()->json([
                    'success' => true,
                    'data' => $sendout,
                    'message' => 'Salida encontrada correctamente'
                ]);
            }else{
                Log::error('Error al buscar la salida: ' . $sendout->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Error al buscar la salida'
                ], 500);
            }
        }catch(Exception $e){
            Log::error('Error al buscar la salida: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al buscar la salida',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function finish(Request $request){
        try{
            $sendout = SendOut::find($request->id);

            if ($sendout) {
                $sendout->active = false;
                $sendout->return_date = now();
                if ($sendout->save()) {
                    return response()->json([
                        'success' => true,
                        'data' => $sendout,
                        'message' => 'Salida terminada correctamente'
                    ]);
                }else{
                    Log::error('Error al terminar la salida: ' . $sendout->getMessage());
                    return response()->json([
                        'success' => false,
                        'message' => 'Error al terminar la salida'
                    ], 500);
                }
            }else{
                Log::error('Error al terminar la salida: ' . $sendout->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Error al terminar la salida'
                ], 500);
            }

        }catch(Exception $e){
            Log::error('Error al terminar la salida: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al terminar la salida',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function list(){
        return view('module.aviso.index');
    }

    public function data(){
        try{
            $sendouts = SendOut::all()->map(function($sendout) {
                if ($sendout->file_path) {
                    $sendout->download_url = route('aviso.download', $sendout->id);
                }
                return $sendout;
            });

            if ($sendouts) {
                return response()->json($sendouts);
            }else{
                Log::error('Error al listar las salidas');
                return response()->json([
                    'success' => false,
                    'message' => 'Error al listar las salidas'
                ], 500);
            }

        }catch(Exception $e){
            Log::error('Error al listar las salidas: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al listar las salidas',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function download($id)
    {
        $sendout = SendOut::findOrFail($id);

        if (!$sendout->file_path) {
            abort(404, 'Archivo no encontrado');
        }

        $filePath = storage_path('app/public/' . $sendout->file_path);

        if (!file_exists($filePath)) {
            abort(404, 'El archivo no existe en el servidor');
        }

        return response()->download($filePath);
    }
}
