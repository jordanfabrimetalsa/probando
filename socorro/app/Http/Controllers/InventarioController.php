<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Category;
use App\Models\Product;
use Exception;
class InventarioController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        $categories = Category::all();
        return view('module.inventario.index', compact('warehouses', 'categories'));
    }

    public function data(){
        $products = Product::with('category', 'warehouse')->get();
        return response()->json($products);
    }

    public function categoryStore(Request $request){
        try{
            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
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
    public function store(Request $request)
    {
        //
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
        //
    }
}
