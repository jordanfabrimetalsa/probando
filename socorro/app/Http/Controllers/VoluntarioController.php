<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voluntary;
use App\Models\Delegation;
use App\Models\Image_Voluntary;
use Illuminate\Support\Facades\Hash;

class VoluntarioController extends Controller
{

    public function index()
    {
        $delegations = Delegation::all();
        return view('module.voluntario.index', compact('delegations'));
    }

    public function data()
    {
        $voluntarios = Voluntary::all();
        return response()->json($voluntarios);
    }

    public function store(Request $request)
    {
        $voluntary = new Voluntary();
        $voluntary->delegation_id = $request->delegation_id;
        $voluntary->document = $request->document;
        $voluntary->name = $request->name;
        $voluntary->lastname = $request->lastname;
        $voluntary->email = $request->email;
        $voluntary->phone = $request->phone;
        $voluntary->birthday = $request->birthday;
        $voluntary->gender = $request->gender;
        $voluntary->allergic = $request->allergic;
        $voluntary->disease = $request->disease;
        $voluntary->medicine = $request->medicine;
        $voluntary->vehicle = $request->vehicle;
        $voluntary->license = $request->license;
        $voluntary->password = Hash::make($request->password);
        $voluntary->type = $request->type;
        $voluntary->status = $request->status;
        
        if($voluntary->save()){
            $image_voluntary = new Image_Voluntary();
            $image_voluntary->voluntary_id = $voluntary->id;
            $image_voluntary->name = $request->file('image')->getClientOriginalName();
            $image_voluntary->path = $request->file('image')->store('imagenes', 'public');
            $image_voluntary->save();
        }else{
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear el voluntario'
            ], 500);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Voluntario registrado'
        ], 201);
    }

    public function show(string $id)
    {
        $voluntary = Voluntary::find($id);
        return response()->json($voluntary);
    }

    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
