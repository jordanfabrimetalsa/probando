<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\StockMovement;
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
            $products = Product::join('categories', 'products.id_category', '=', 'categories.id')
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

    public function stock_movements(){
        try{
            $stock_movements = StockMovement::join('products', 'stock_movement.product_id', '=', 'products.id')
            ->join('users', 'stock_movement.user_id', '=', 'users.id')
            ->select('stock_movement.*', 'users.name as user_name', 'products.name as product_name', 'stock_movement.quantity as quantity', 'stock_movement.unit_cost as unit_cost', 'stock_movement.unit_cost as unit_cost', 'stock_movement.product_id as product_id', 'stock_movement.user_id as user_id', 'stock_movement.created_at as created_at', 'stock_movement.updated_at as updated_at')
            ->get();
            return response()->json($stock_movements);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener los movimientos de stock'
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
            $product->total = $request->stock * $request->price;
            $product->status = $request->status;
            $product->id_category = $request->id_category;
            $product->id_warehouse = $request->id_warehouse;

            if($product->save()){
                $stockMovement = new StockMovement();
                $stockMovement->quantity = $request->stock;
                $stockMovement->unit_cost = $request->price;
                $stockMovement->product_id = $product->id;
                $stockMovement->user_id = auth()->user()->id;
                $stockMovement->type = 'add';
                $stockMovement->save();                
                return response()->json([
                    'status' => 'success',
                    'message' => 'Inventario registrado'
                ], 201);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error al crear el inventario'
                ], 500);
            }

        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear el inventario'
            ], 500);
        }
    }

    public function show(string $id)
    {
        try{
            $products = Product::join('categories', 'products.id_category', '=', 'categories.id')
                                ->join('warehouses', 'products.id_warehouse', '=', 'warehouses.id')
                                ->select('products.*', 'categories.name as category_name', 'categories.description as category_description', 'warehouses.name as warehouse_name', 'warehouses.description as warehouse_description', 'warehouses.status as warehouse_status', 'warehouses.path as warehouse_path', 'products.total as total')
                                ->where('products.id', $id)
                                ->get();
            return response()->json($products);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener los inventarios'
            ], 500);
        }
    }

    public function addStock(Request $request)
    {
        try{
            $product = Product::find($request->product_id_show);
            $product->stock = ($product->stock + $request->quantity);
            $product->total += ($request->quantity * $request->unit_cost);
            if($product->save()){
                $stockMovement = new StockMovement();
                $stockMovement->quantity = $request->quantity;
                $stockMovement->unit_cost = $request->unit_cost;
                $stockMovement->product_id = $request->product_id_show;
                $stockMovement->user_id = auth()->user()->id;
                $stockMovement->type = 'add';
                $stockMovement->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Stock agregado correctamente'
                ], 200);
            }
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al agregar stock'
            ], 500);
        }
    }

    public function reduce_stock(Request $request)
    {
        try{
            $product = Product::find($request->product_id_reduce);

            if($product->stock < $request->quantity){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Esta reduciendo mas de lo que existe, solo se puede reducir ' . $product->stock . ' ' . ($product->stock == 1 ? 'unidad' : 'unidades')
                ], 400);
            }
            
            $unitary = ($product->total / $product->stock);
            $product->stock = ($product->stock - $request->quantity);
            $product->total = ($product->total - ($request->quantity * $unitary));

            if($product->save()){
                $stockMovement = new StockMovement();
                $stockMovement->quantity = $request->quantity;
                $stockMovement->unit_cost = $unitary;
                $stockMovement->product_id = $request->product_id_reduce;
                $stockMovement->user_id = auth()->user()->id;
                $stockMovement->type = 'reduce';
                $stockMovement->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Stock reducido correctamente'
                ], 200);
            }
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al reducir stock'
            ], 500);
        }
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
