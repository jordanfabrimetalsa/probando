<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
class InventarioController extends Controller
{
    public function index()
    {
        $warehouses = Warehouse::all();
        $categories = Category::all();
        return view('module.inventario.index', compact('warehouses', 'categories'));
    }

    public function data(){
        try{
            $products = DB::table('products')
            ->join('categories', 'products.id_category', '=', 'categories.id')
            ->join('warehouses', 'products.id_warehouse', '=', 'warehouses.id')
            ->select('products.*', 'categories.name as category_name', 'warehouses.name as warehouse_name')
            ->get();
            return response()->json($products);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener los inventarios'
            ], 500);
        }
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
    public function warehouseStore(Request $request){
        try{
            $warehouse = new Warehouse();
            $warehouse->name = $request->name;
            $warehouse->description = $request->description;
            $warehouse->path = $request->path;
            $warehouse->status = $request->status;
            $warehouse->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Bodega registrado'
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear la bodega'
            ], 500);
        }
    }
    public function store(Request $request)
    {
        try{
            $product = new Product();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->colour = $request->colour;
            $product->size = $request->size;
            $product->brand = $request->brand;
            $product->stock = $request->stock;
            $product->price = $request->price;
            $product->status = $request->status;
            $product->id_category = $request->id_category;
            $product->id_warehouse = $request->id_warehouse;
            $product->save();
            return response()->json([
                'status' => 'success',
                'message' => 'Inventario registrado'
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear el inventario'
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
            $product = Product::find($id);
            $product->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Inventario eliminado'
            ], 200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al eliminar el inventario'
            ], 500);
        }
    }
}
