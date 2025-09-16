<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SendOut;
use Exception;

class SendOutController extends Controller
{
    public function store(Request $request)
    {
        try{
            $sendout = new SendOut;

            $sendout->name = $request->name;
            $sendout->lastname = $request->lastname;
            $sendout->document_type = $request->document_type;
            $sendout->document_number = $request->document_number;
            $sendout->email = $request->email;
            $sendout->phone = $request->phone;
            $sendout->region = $request->region;
            $sendout->destination = $request->destination;
            $sendout->route = $request->route;
            $sendout->file_path = $request->file_path;
            $sendout->activity = $request->activity;
            $sendout->number_participants = $request->number_participants;
            $sendout->departure_date = $request->departure_date;
            $sendout->return_date = $request->return_date;

            if($request->hasFile('image')){
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
                return response()->json([
                    'success' => false,
                    'message' => 'Error al guardar la salida'
                ], 500);
            }
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Error al guardar la salida',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
