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
use App\Support\DelegationAccess;

class InventarioController extends Controller
{
    public function index()
    {
        $delegations = DelegationAccess::isNational() ? Delegation::all() : Delegation::whereKey(DelegationAccess::id())->get();
        return view('module.inventario.index', compact('delegations'));
    }

    public function data(){
        try{
            $products = Product::join('categories', 'products.id_category', '=', 'categories.id')
            ->join('warehouses', 'products.id_warehouse', '=', 'warehouses.id')
            ->select('products.*', 'products.barcode as barcode', 'categories.name as category_name', 'warehouses.name as warehouse_name')
            ->when(!DelegationAccess::isNational(), fn ($query) => $query->where('warehouses.delegation_id', DelegationAccess::id()))
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
            $stock_movements = StockMovement::leftJoin('products', 'stock_movement.product_id', '=', 'products.id')
            ->leftJoin('users', 'stock_movement.user_id', '=', 'users.id')
            ->leftJoin('warehouses', 'stock_movement.warehouse_id', '=', 'warehouses.id')
            ->select('stock_movement.*', 'users.name as user_name', 'products.name as product_name', 'warehouses.name as warehouse_name')
            ->when(!DelegationAccess::isNational(), fn ($query) => $query->where('stock_movement.delegation_id', DelegationAccess::id()))
            ->orderByDesc('stock_movement.occurred_at')
            ->orderByDesc('stock_movement.id')
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
        $validated = $request->validate([
            'name' => 'required|max:100|unique:categories,name',
            'description' => 'required|max:255'
        ]);
        try{
            $category = new Category();
            $category->name = $validated['name'];
            $category->description = $validated['description'];
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
        $validated = $request->validate([
            'name' => 'required|max:100|unique:warehouses,name',
            'description' => 'required|max:255',
            'path' => 'required|max:255',
            'status' => 'required|boolean',
            'delegation_id' => 'required|exists:delegations,id'
        ]);
        try{
            DelegationAccess::authorize((int) $validated['delegation_id']);
            $warehouse = new Warehouse();
            $warehouse->name = $validated['name'];
            $warehouse->description = $validated['description'];
            $warehouse->path = $validated['path'];
            $warehouse->status = $validated['status'];
            $warehouse->delegation_id = $validated['delegation_id'];
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
            'image' => 'image|mimes:png,jpeg,jpg|max:2048'
        ]);

        try{
            $warehouse = Warehouse::findOrFail($request->id_warehouse);
            DelegationAccess::authorize((int) $warehouse->delegation_id);
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
            } else {
                $product->image = null;
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
                                ->when(!DelegationAccess::isNational(), fn ($query) => $query->where('warehouses.delegation_id', DelegationAccess::id()))
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
        $validated = $request->validate([
            'product_id_show' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:1000000',
            'unit_cost' => 'required|numeric|min:0|max:999999999',
            'source' => 'required|string|min:2|max:150',
            'reference' => 'nullable|string|max:100',
        ], [], ['product_id_show' => 'producto', 'quantity' => 'cantidad', 'unit_cost' => 'costo unitario', 'source' => 'origen']);

        try{
            DB::transaction(function () use ($validated) {
                $product = Product::lockForUpdate()->findOrFail($validated['product_id_show']);
                $warehouse = Warehouse::findOrFail($product->id_warehouse);
                DelegationAccess::authorize((int) $warehouse->delegation_id);
                $before = (int) $product->stock;
                $after = $before + (int) $validated['quantity'];

                StockProductAdd::create(['count' => $validated['quantity'], 'cost' => $validated['unit_cost'], 'product_id' => $product->id]);
                $product->update(['stock' => $after, 'status' => true]);
                StockMovement::create([
                    'type' => 'add', 'quantity' => $validated['quantity'], 'balance_before' => $before,
                    'balance_after' => $after, 'unit_cost' => $validated['unit_cost'],
                    'reason' => 'Entrada desde '.$validated['source'], 'reference' => $validated['reference'] ?? null,
                    'occurred_at' => now(), 'product_id' => $product->id, 'warehouse_id' => $product->id_warehouse,
                    'delegation_id' => $warehouse->delegation_id,
                    'user_id' => Auth::id(),
                ]);
            });

            return response()->json(['status' => 'success', 'message' => 'Stock agregado correctamente'], 200);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error al agregar stock ' . $e->getMessage()
            ], 500);
        }
    }

    public function reduce_stock(Request $request)
    {
        $validated = $request->validate([
            'product_id_reduce' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1|max:1000000',
            'reason' => 'required|string|min:3|max:180',
            'reference' => 'nullable|string|max:100',
        ], [], ['product_id_reduce' => 'producto', 'quantity' => 'cantidad', 'reason' => 'motivo']);

        try{
            DB::transaction(function () use ($validated) {
                $product = Product::lockForUpdate()->findOrFail($validated['product_id_reduce']);
                $warehouse = Warehouse::findOrFail($product->id_warehouse);
                DelegationAccess::authorize((int) $warehouse->delegation_id);
                $before = (int) $product->stock;
                if ((int) $validated['quantity'] > $before) {
                    throw new \DomainException('Solo existen '.$before.' unidades disponibles.');
                }
                $after = $before - (int) $validated['quantity'];
                $lastUnitCost = (int) (StockProductAdd::where('product_id', $product->id)->latest()->value('cost') ?? 0);
                $product->update(['stock' => $after, 'status' => $after > 0]);
                StockMovement::create([
                    'type' => 'reduce', 'quantity' => $validated['quantity'], 'balance_before' => $before,
                    'balance_after' => $after, 'unit_cost' => $lastUnitCost, 'reason' => $validated['reason'],
                    'reference' => $validated['reference'] ?? null, 'occurred_at' => now(),
                    'product_id' => $product->id, 'warehouse_id' => $product->id_warehouse, 'user_id' => Auth::id(),
                    'delegation_id' => $warehouse->delegation_id,
                ]);
            });

            return response()->json(['status' => 'success', 'message' => 'Stock reducido correctamente'], 200);
        } catch (\DomainException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 422);
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
            $product = Product::findOrFail($id);
            DelegationAccess::authorize((int) $product->warehouse->delegation_id);
            if ($product->stock > 0) {
                return response()->json(['status' => 'error', 'message' => 'No puedes archivar un producto que todavía tiene stock. Registra primero su salida.'], 422);
            }
            $product->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Producto archivado; su historial fue conservado.'
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
            $warehouses = DelegationAccess::scope(Warehouse::query())->get();
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
