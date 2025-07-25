<?php

namespace App\Http\Controllers;
use App\Models\CategoryCheck;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    public function categoria()
    {
        return view('module.checklist.indexCategoria');
    }

    public function respuesta()
    {
        return view('module.checklist.indexRespuesta');
    }

    public function data(){
        $check = CategoryCheck::all();
        return response()->json($check);
    }

    public function create()
    {
        //
    }

    public function categoriaStore(Request $request)
    {
        try{
            $category = new CategoryCheck();
            $category->name = $request->name;
            $category->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Categoria registrado'
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear la categoria'
            ], 500);
        }
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        try{
            $category = CategoryCheck::find($id);
            $category->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Categoria eliminada'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al eliminar la categoria'
            ], 500);
        }
    }
}
