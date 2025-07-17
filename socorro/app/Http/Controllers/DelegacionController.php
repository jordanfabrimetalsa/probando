<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delegation;
use Exception;

class DelegacionController extends Controller
{

    public function index()
    {
        $delegations = Delegation::all();
        return view('module.delegation.index', compact('delegations'));
    }

    public function data()
    {
        $delegations = Delegation::all();
        return response()->json($delegations);
    }

    public function store(Request $request)
    {
        try{
            $delegation = new Delegation();
            $delegation->name = $request->name;
            $delegation->save();
            return response()->json(['success' => 'Delegación creada correctamente']);
        }catch(Exception $e){
            return response()->json(['error' => $e]);
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
