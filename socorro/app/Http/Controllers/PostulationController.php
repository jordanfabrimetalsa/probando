<?php

namespace App\Http\Controllers;

use App\Models\Postulation;
use App\Models\Delegation;
use App\Models\Voluntary;
use Illuminate\Http\Request;
use Exception;

class PostulationController extends Controller
{
    public function data($id)
    {
        try{
            $postulations = Postulation::where('delegation_id', $id)
                ->where('status', 'A')
                ->where('end_date', '>=', now())
                ->orderBy('start_date')
                ->get();

            return response()->json($postulations);
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'cant_people_selected' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'delegation_id_postulation' => 'required'
        ]);

        try {
            $postulation = Postulation::create([
                'title' => $validated['title'],
                'description' => $validated['description'],
                'cant_people_selected' => $validated['cant_people_selected'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'delegation_id' => $validated['delegation_id_postulation']
            ]);

            $delegation = Delegation::find($validated['delegation_id_postulation']);
            $delegation->postulation_status = 'A';
            $delegation->save();

            return response()->json([
                'message' => 'Postulación creada correctamente',
                'postulation' => $postulation
            ], 201);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function details($id)
    {
        try{
            $postulation = Postulation::find($id);

            return response()->json($postulation);
        }catch(Exception $e){
            return response()->json($e);
        }
    }

    public function voluntariesData($id)
    {
        try{
            $voluntaries = Voluntary::where('delegation_id', $id)->get();

            return response()->json($voluntaries);
        }catch(Exception $e){
            return response()->json($e);
        }
    }
}
