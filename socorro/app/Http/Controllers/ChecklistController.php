<?php

namespace App\Http\Controllers;
use App\Models\CategoryCheck;
use App\Models\QuestionCheck;
use Illuminate\Http\Request;
use App\Models\Delegation;

class ChecklistController extends Controller
{
    public function categoria()
    {
        $delegations = Delegation::all();
        return view('module.checklist.indexCategoria', compact('delegations'));
    }

    public function respuesta()
    {
        $question = QuestionCheck::join('categories_check', 'checklist.id_category_check', '=', 'categories_check.id')
        ->select('checklist.name as name', 'checklist.quantity as quantity', 'checklist.status as status', 'categories_check.name as category')
        ->where('checklist.status', 'Y')
        ->get();
        return view('module.checklist.indexRespuesta', compact('question'));
    }

    public function data(){
        $check = CategoryCheck::with('delegation')->get();
        return response()->json($check);
    }

    public function questionData($id){
        try{
            $check = QuestionCheck::join('categories_check', 'checklist.id_category_check', '=', 'categories_check.id')
            ->select('checklist.name as name', 'checklist.quantity as quantity', 'checklist.status as status')
            ->where('categories_check.id', $id)
            ->get();
            return response()->json($check);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener las preguntas'.$e
            ], 500);
        }
    }

    public function categoriaStore(Request $request)
    {
        try{
            $category = new CategoryCheck();
            $category->name = $request->name;
            $category->id_delegation = $request->id_delegation;
            $category->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Categoria registrado'
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear la categoria'.$e
            ], 500);
        }
    }

    public function questionStore(Request $request)
    {
        try{
            $question = new QuestionCheck();
            $question->name = $request->name;
            $question->quantity = $request->quantity;
            $question->status = $request->status;
            $question->id_category_check = $request->id_category_check;
            $question->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Pregunta registrado'
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear la pregunta'
            ], 500);
        }
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
