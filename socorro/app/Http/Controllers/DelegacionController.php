<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delegation;
use Exception;
use App\Models\Regions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DelegacionController extends Controller
{

    public function index()
    {
        $delegations = Delegation::all();
        $regions = Regions::all();
        return view('module.delegation.index', compact('delegations', 'regions'));
    }

    public function data()
    {
        $delegations = Delegation::with('region')->get();
        return response()->json($delegations);
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'region_id' => 'required|integer',
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048'
            ]);

            $delegation = new Delegation();
            $delegation->name = $request->name;
            $delegation->region_id = $request->region_id;

            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('delegations', 'public');
                $delegation->image = $path;
            }

            $save = $delegation->save();
            return response()->json(['success' => "Se ha generado con exito"]);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }


    public function edit($id)
    {
        try{
            $delegation = Delegation::find($id);
            return response()->json($delegation);
        }catch(Exception $e){
            return response()->json(['error' => $e]);
        }
    }

    public function update(Request $request, string $id)
    {
        try{
            $delegation = Delegation::findOrFail($id);

            if (!$request->has('name') || $request->name === null) {
                return response()->json(['error' => 'El campo nombre es obligatorio.'], 422);
            }

            $request->validate([
                'name' => 'required|string|max:255'
            ]);

            $delegation->name = $request->name;
            $delegation->region_id = $request->region_id;
            $delegation->save();
            return response()->json(['success' => 'Delegación actualizada correctamente']);
        }catch(Exception $e){
            return response()->json(['error' => $e]);
        }
    }

    public function destroy(string $id)
    {
        try{
            $delegation = Delegation::find($id);
            $delegation->delete();
            return response()->json(['success' => 'Delegación eliminada correctamente']);
        }catch(Exception $e){
            return response()->json(['error' => $e]);
        }
    }
}
