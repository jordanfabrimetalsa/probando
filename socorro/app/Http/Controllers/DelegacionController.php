<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Delegation;
use Exception;
use App\Models\Regions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Support\DelegationAccess;

class DelegacionController extends Controller
{

    public function index()
    {
        $delegations = DelegationAccess::isNational() ? Delegation::all() : Delegation::whereKey(DelegationAccess::id())->get();
        $regions = Regions::all();
        return view('module.delegation.index', compact('delegations', 'regions'));
    }

    public function data()
    {
        $delegations = DelegationAccess::scope(Delegation::with('region'), 'delegations.id')->get();
        return response()->json($delegations);
    }

    public function store(Request $request)
    {
        abort_unless(DelegationAccess::isNational(), 403, 'Solo la Delegación Nacional puede crear delegaciones.');
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
            $delegation = Delegation::findOrFail($id);
            DelegationAccess::authorize((int) $delegation->id);
            return response()->json($delegation);
        }catch(Exception $e){
            return response()->json(['error' => $e]);
        }
    }

    public function update(Request $request, string $id)
    {
        try{
            $delegation = Delegation::findOrFail($id);
            DelegationAccess::authorize((int) $delegation->id);

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
        abort_unless(DelegationAccess::isNational(), 403, 'Solo la Delegación Nacional puede eliminar delegaciones.');
        try{
            $delegation = Delegation::findOrFail($id);
            abort_if($delegation->is_national, 422, 'La Delegación Nacional no se puede eliminar.');
            $delegation->delete();
            return response()->json(['success' => 'Delegación eliminada correctamente']);
        }catch(Exception $e){
            return response()->json(['error' => $e]);
        }
    }
}
