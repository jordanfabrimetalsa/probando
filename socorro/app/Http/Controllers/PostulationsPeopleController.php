<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PostulationsPeople;
use Exception;
use Illuminate\Support\Facades\Log;

class PostulationsPeopleController extends Controller
{
    public function data($id){
        try{
            // Log para depurar
            Log::info('Buscando postulantes para postulation_id: ' . $id);

            $postulationsPeople = PostulationsPeople::where('postulation_id', $id)->get();

            Log::info('Registros encontrados: ' . $postulationsPeople->count());
            Log::info('Datos encontrados:', $postulationsPeople->toArray());

            return response()->json($postulationsPeople);
        }catch(Exception $e){
            Log::error('Error en data method: ' . $e->getMessage());
            return response()->json($e);
        }
    }

    public function store(Request $request){
        try{
            // Log simple para verificar si llega aquí
            file_put_contents(storage_path('logs/test.log'), date('Y-m-d H:i:s') . ' - Store method called' . PHP_EOL, FILE_APPEND);

            Log::info('Datos recibidos:', $request->all());

            // Crear sin validación para pruebas
            $postulationPeople = PostulationsPeople::create($request->all());

            Log::info('Postulación creada:', $postulationPeople->toArray());

            return response()->json([
                'success' => true,
                'message' => 'Postulación enviada correctamente',
                'data' => $postulationPeople
            ]);
        }catch(Exception $e){
            Log::error('Error:', $e->getMessage());
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
