<?php

namespace App\Http\Controllers;

use App\Models\EquipmentRequest;
use App\Models\EquipmentRequestItem;
use App\Models\Product;
use App\Models\StockMovement;
use App\Models\StockProductAdd;
use App\Models\Warehouse;
use App\Support\DelegationAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class EquipmentRequestController extends Controller
{
    public function index()
    {
        $delegationId = DelegationAccess::id();
        $warehouses = Warehouse::where('delegation_id', $delegationId)->where('status', true)->orderBy('name')->get();
        $products = Product::with('warehouse')->whereIn('id_warehouse', $warehouses->pluck('id'))
            ->where('stock', '>', 0)->where('status', true)->orderBy('name')->get();
        $personal = EquipmentRequest::with(['warehouse','items.product','reviewer'])
            ->where('user_id', Auth::id())->latest()->get();
        $pending = collect();
        $toReturn = collect();

        if (Auth::user()->hasPermission('inventory.manage')) {
            $pending = DelegationAccess::scope(EquipmentRequest::with(['user.voluntary','warehouse','items.product']), 'delegation_id')
                ->where('status', 'pending')->oldest()->get();
            $toReturn = DelegationAccess::scope(EquipmentRequest::with(['user.voluntary','warehouse','items.product']), 'delegation_id')
                ->whereIn('status', ['approved', 'partially_returned'])->orderBy('expected_return_at')->get();
        }

        return view('module.equipment_requests.index', compact('warehouses','products','personal','pending','toReturn'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'warehouse_id' => ['required', 'exists:warehouses,id'],
            'purpose' => ['required', 'string', 'min:5', 'max:180'],
            'needed_at' => ['required', 'date', 'after_or_equal:today'],
            'expected_return_at' => ['required', 'date', 'after_or_equal:needed_at'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.product_id' => ['required', 'integer', 'distinct', 'exists:products,id'],
            'items.*.quantity' => ['required', 'integer', 'min:1', 'max:1000000'],
        ], [], ['warehouse_id'=>'bodega','needed_at'=>'fecha de retiro','expected_return_at'=>'fecha de devolución','items'=>'equipos']);

        $warehouse = Warehouse::findOrFail($data['warehouse_id']);
        abort_unless((int) $warehouse->delegation_id === (int) DelegationAccess::id(), 403, 'Solo puede solicitar equipos de su delegación.');
        $products = Product::whereIn('id', collect($data['items'])->pluck('product_id'))->get()->keyBy('id');

        foreach ($data['items'] as $item) {
            $product = $products->get($item['product_id']);
            abort_unless($product && (int) $product->id_warehouse === (int) $warehouse->id, 422, 'Todos los equipos deben pertenecer a la bodega seleccionada.');
            if ((int) $item['quantity'] > (int) $product->stock) {
                return back()->withErrors(['items' => "Solo hay {$product->stock} unidades disponibles de {$product->name}."])->withInput();
            }
        }

        DB::transaction(function () use ($data, $warehouse) {
            $equipmentRequest = EquipmentRequest::create([
                'user_id' => Auth::id(), 'warehouse_id' => $warehouse->id,
                'delegation_id' => $warehouse->delegation_id, 'purpose' => $data['purpose'],
                'needed_at' => $data['needed_at'], 'expected_return_at' => $data['expected_return_at'],
                'status' => 'pending',
            ]);
            foreach ($data['items'] as $item) $equipmentRequest->items()->create($item);
        });

        return back()->with('success', 'Solicitud enviada para revisión.');
    }

    public function review(Request $request, EquipmentRequest $equipmentRequest)
    {
        $data = $request->validate([
            'decision' => ['required', Rule::in(['approve','reject'])],
            'review_note' => ['nullable', 'string', 'max:500'],
        ]);
        DelegationAccess::authorize((int) $equipmentRequest->delegation_id);
        abort_unless($equipmentRequest->status === 'pending', 422, 'Esta solicitud ya fue revisada.');

        if ($data['decision'] === 'reject') {
            $equipmentRequest->update(['status'=>'rejected','reviewed_by'=>Auth::id(),'reviewed_at'=>now(),'review_note'=>$data['review_note'] ?? null]);
            return back()->with('success', 'Solicitud rechazada sin modificar el stock.');
        }

        try {
            DB::transaction(function () use ($equipmentRequest, $data) {
                $equipmentRequest->load('items');
                foreach ($equipmentRequest->items->sortBy('product_id') as $item) {
                    $product = Product::lockForUpdate()->findOrFail($item->product_id);
                    if ((int) $product->stock < (int) $item->quantity) {
                        throw new \DomainException("Stock insuficiente para {$product->name}: quedan {$product->stock}.");
                    }
                    $before = (int) $product->stock;
                    $after = $before - (int) $item->quantity;
                    $product->update(['stock'=>$after, 'status'=>$after > 0]);
                    StockMovement::create([
                        'type'=>'reduce','quantity'=>$item->quantity,'balance_before'=>$before,'balance_after'=>$after,
                        'unit_cost'=>(int)(StockProductAdd::where('product_id',$product->id)->latest()->value('cost') ?? 0),
                        'reason'=>'Entrega por solicitud de equipo','reference'=>'SOL-'.$equipmentRequest->id,
                        'occurred_at'=>now(),'product_id'=>$product->id,'warehouse_id'=>$equipmentRequest->warehouse_id,
                        'delegation_id'=>$equipmentRequest->delegation_id,'user_id'=>Auth::id(),
                    ]);
                }
                $equipmentRequest->update(['status'=>'approved','reviewed_by'=>Auth::id(),'reviewed_at'=>now(),'review_note'=>$data['review_note'] ?? null]);
            });
        } catch (\DomainException $exception) {
            return back()->withErrors(['stock'=>$exception->getMessage()]);
        }

        return back()->with('success', 'Solicitud aprobada y stock descontado.');
    }

    public function returnEquipment(Request $request, EquipmentRequest $equipmentRequest)
    {
        $data = $request->validate([
            'returns' => ['required', 'array'],
            'returns.*' => ['nullable', 'integer', 'min:0'],
        ]);
        DelegationAccess::authorize((int) $equipmentRequest->delegation_id);
        abort_unless(in_array($equipmentRequest->status, ['approved','partially_returned'], true), 422, 'La solicitud no tiene equipos pendientes de devolución.');

        try {
            DB::transaction(function () use ($equipmentRequest, $data) {
                $equipmentRequest->load('items.product');
                $returnedAny = false;
                foreach ($equipmentRequest->items as $item) {
                    $quantity = (int) ($data['returns'][$item->id] ?? 0);
                    if ($quantity === 0) continue;
                    $remaining = (int) $item->quantity - (int) $item->returned_quantity;
                    if ($quantity > $remaining) throw new \DomainException("La devolución de {$item->product->name} supera las {$remaining} unidades pendientes.");
                    $product = Product::lockForUpdate()->findOrFail($item->product_id);
                    $before = (int) $product->stock;
                    $after = $before + $quantity;
                    $product->update(['stock'=>$after,'status'=>true]);
                    $item->update(['returned_quantity'=>$item->returned_quantity + $quantity]);
                    StockMovement::create([
                        'type'=>'add','quantity'=>$quantity,'balance_before'=>$before,'balance_after'=>$after,
                        'unit_cost'=>(int)(StockProductAdd::where('product_id',$product->id)->latest()->value('cost') ?? 0),
                        'reason'=>'Devolución de equipo','reference'=>'SOL-'.$equipmentRequest->id,
                        'occurred_at'=>now(),'product_id'=>$product->id,'warehouse_id'=>$equipmentRequest->warehouse_id,
                        'delegation_id'=>$equipmentRequest->delegation_id,'user_id'=>Auth::id(),
                    ]);
                    $returnedAny = true;
                }
                if (!$returnedAny) throw new \DomainException('Indique al menos una cantidad para devolver.');
                $equipmentRequest->refresh()->load('items');
                $complete = $equipmentRequest->items->every(fn ($item) => (int)$item->returned_quantity === (int)$item->quantity);
                $equipmentRequest->update(['status'=>$complete ? 'returned' : 'partially_returned','returned_at'=>$complete ? now() : null]);
            });
        } catch (\DomainException $exception) {
            return back()->withErrors(['returns'=>$exception->getMessage()]);
        }

        return back()->with('success', 'Devolución registrada y stock repuesto.');
    }
}
