<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Models\Category;
use App\Models\Product;
use App\Models\StockProductAdd;
use App\Models\Delegation;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\StockMovement;

class InventarioController extends Controller
{
    public function index()
    {
        $delegations = Delegation::all();
        return view('module.inventario.index', compact('delegations'));
    }

    public function data(){
        try{
            $products = Product::join('categories', 'products.id_category', '=', 'categories.id')
            ->join('warehouses', 'products.id_warehouse', '=', 'warehouses.id')
            ->select('products.*', 'products.barcode as barcode', 'categories.name as category_name', 'warehouses.name as warehouse_name')
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
            $request->validate([
                'name' => 'required|max:100|unique:categories,name',
                'description' => 'required|max:255'
            ]);

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
            $request->validate([
                'name' => 'required|max:100|unique:warehouses,name',
                'description' => 'required|max:255',
                'path' => 'required|max:255',
                'status' => 'required|boolean',
                'delegation_id' => 'required|exists:delegations,id'
            ]);

            $warehouse = new Warehouse();
            $warehouse->name = $request->name;
            $warehouse->description = $request->description;
            $warehouse->path = $request->path;
            $warehouse->status = $request->status;
            $warehouse->delegation_id = $request->delegation_id;
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
        $request->validate([
            'barcode' => 'required|max:100|unique:products,barcode',
            'name' => 'required|max:100|unique:products,name',
            'description' => 'required|max:255',
            'colour' => 'required|max:100',
            'size' => 'required|max:100',
            'brand' => 'required|max:100',
            'status' => 'required|boolean',
            'id_category' => 'required|exists:categories,id',
            'id_warehouse' => 'required|exists:warehouses,id',
            'image' => 'required|image|mimes:png,jpeg,jpg|max:2048'
        ]);

        try{
            $product = new Product();
            $product->barcode = $request->barcode;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->colour = $request->colour;
            $product->size = $request->size;
            $product->brand = $request->brand;
            $product->status = $request->status;
            $product->id_category = $request->id_category;
            $product->id_warehouse = $request->id_warehouse;

            // Handle image upload
            if ($request->hasFile('image')) {
               $name_product = uniqid() . '_' . $request->file('image')->getClientOriginalName();
               $product->image = $request->file('image')->storeAs('images', $name_product, 'public');
            }

            $product->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Inventario registrado'
            ], 201);

        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al crear el inventario por: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        try{
            $products = Product::join('categories', 'products.id_category', '=', 'categories.id')
                                ->join('warehouses', 'products.id_warehouse', '=', 'warehouses.id')
                                ->select('products.*', 'categories.name as category_name', 'categories.description as category_description', 'warehouses.name as warehouse_name', 'warehouses.description as warehouse_description', 'warehouses.status as warehouse_status', 'warehouses.path as warehouse_path')
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
        $request->validate([
            'product_id_show' => 'required|exists:products,id',
            'quantity' => 'required|numeric',
            'unit_cost' => 'required|numeric'
        ]);

        try{
            // Registrar el agregado de stock en la tabla stock_products
            $stockAdd = new StockProductAdd();
            $stockAdd->count = $request->quantity;
            $stockAdd->cost = $request->unit_cost;
            $stockAdd->product_id = $request->product_id_show;

            // Actualizar el stock del producto
            $productDetail = Product::find($request->product_id_show);
            $productDetail->stock = $productDetail->stock + $request->quantity;
            $productDetail->status = true;
            $productDetail->save();

            if($stockAdd->save()){
                $stockMovement = new StockMovement();
                $stockMovement->quantity = $request->quantity;
                $stockMovement->unit_cost = $request->unit_cost;
                $stockMovement->product_id = $request->product_id_show;
                $stockMovement->user_id = auth::user()->id;
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
                'message' => 'Error al agregar stock ' . $e->getMessage()
            ], 500);
        }
    }

    public function reduce_stock(Request $request)
    {
        $request->validate([
            'product_id_reduce' => 'required|exists:products,id',
            'quantity' => 'required|numeric'
        ]);

        try{
            $product = Product::find($request->product_id_reduce);

            $valueComparation = intval($product->stock) - intval($request->quantity);

            if($valueComparation < 0){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Esta reduciendo mas de lo que existe, solo se puede reducir ' . $product->stock . ' ' . ($product->stock == 1 ? 'unidad' : 'unidades')
                ], 400);
            }

            $product->stock -= $request->quantity;

            if($product->stock == 0){
                $product->status = false;
            }

            if($product->save()){
                $stockMovement = new StockMovement();
                $stockMovement->quantity = $request->quantity;
                $stockMovement->unit_cost = 0;
                $stockMovement->product_id = $request->product_id_reduce;
                $stockMovement->user_id = auth::user()->id;
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

    public function dataWarehouse(){
        try{
            $warehouses = Warehouse::all();
            return response()->json($warehouses);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener las bodegas'
            ], 500);
        }
    }

    public function dataCategory(){
        try{
            $categories = Category::all();
            return response()->json($categories);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al obtener las categorías'
            ], 500);
        }
    }
}
