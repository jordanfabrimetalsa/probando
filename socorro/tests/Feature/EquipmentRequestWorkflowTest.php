<?php

namespace Tests\Feature;

use App\Models\EquipmentRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class EquipmentRequestWorkflowTest extends TestCase
{
    use DatabaseTransactions;

    public function test_approval_reduces_stock_and_returns_restore_it(): void
    {
        $admin = User::with('voluntary')->where('role', 'admin')->firstOrFail();
        $now = now();
        $warehouseId = DB::table('warehouses')->insertGetId([
            'name'=>'Bodega prueba solicitudes '.uniqid(), 'description'=>'Prueba', 'path'=>'Sede',
            'status'=>true, 'delegation_id'=>$admin->voluntary->delegation_id,
            'created_at'=>$now, 'updated_at'=>$now,
        ]);
        $categoryId = DB::table('categories')->insertGetId([
            'name'=>'Categoría solicitudes '.uniqid(), 'description'=>'Prueba',
            'created_at'=>$now, 'updated_at'=>$now,
        ]);
        $productId = DB::table('products')->insertGetId([
            'barcode'=>'TEST-'.uniqid(), 'name'=>'Cuerda prueba '.uniqid(), 'description'=>'Prueba',
            'colour'=>'Rojo', 'size'=>'50 m', 'brand'=>'CSA', 'stock'=>10, 'status'=>true,
            'image'=>null, 'id_category'=>$categoryId, 'id_warehouse'=>$warehouseId,
            'created_at'=>$now, 'updated_at'=>$now,
        ]);

        $this->actingAs($admin)->post(route('equipment-requests.store'), [
            'warehouse_id'=>$warehouseId, 'purpose'=>'Operativo de prueba',
            'needed_at'=>now()->format('Y-m-d'), 'expected_return_at'=>now()->addDay()->format('Y-m-d'),
            'items'=>[['product_id'=>$productId,'quantity'=>4]],
        ])->assertRedirect();

        $equipmentRequest = EquipmentRequest::with('items')->latest('id')->firstOrFail();
        $this->post(route('equipment-requests.review', $equipmentRequest), [
            'decision'=>'approve', 'review_note'=>'Entrega autorizada',
        ])->assertRedirect();
        $this->assertDatabaseHas('products', ['id'=>$productId,'stock'=>6]);

        $item = $equipmentRequest->items->first();
        $this->post(route('equipment-requests.return', $equipmentRequest), [
            'returns'=>[$item->id=>4],
        ])->assertRedirect();

        $this->assertDatabaseHas('products', ['id'=>$productId,'stock'=>10]);
        $this->assertDatabaseHas('equipment_requests', ['id'=>$equipmentRequest->id,'status'=>'returned']);
        $this->assertDatabaseHas('stock_movement', ['reference'=>'SOL-'.$equipmentRequest->id,'type'=>'reduce','quantity'=>4]);
        $this->assertDatabaseHas('stock_movement', ['reference'=>'SOL-'.$equipmentRequest->id,'type'=>'add','quantity'=>4]);
    }

    public function test_rejection_does_not_change_stock(): void
    {
        $admin = User::with('voluntary')->where('role', 'admin')->firstOrFail();
        $warehouseId = DB::table('warehouses')->insertGetId([
            'name'=>'Bodega rechazo '.uniqid(), 'description'=>'Prueba', 'path'=>'Sede',
            'status'=>true, 'delegation_id'=>$admin->voluntary->delegation_id,
            'created_at'=>now(), 'updated_at'=>now(),
        ]);
        $request = EquipmentRequest::create([
            'user_id'=>$admin->id, 'warehouse_id'=>$warehouseId,
            'delegation_id'=>$admin->voluntary->delegation_id, 'purpose'=>'Solicitud a rechazar',
            'needed_at'=>now(), 'expected_return_at'=>now()->addDay(), 'status'=>'pending',
        ]);

        $this->actingAs($admin)->post(route('equipment-requests.review', $request), [
            'decision'=>'reject', 'review_note'=>'Equipo reservado para otra operación',
        ])->assertRedirect();

        $this->assertDatabaseHas('equipment_requests', ['id'=>$request->id,'status'=>'rejected']);
    }
}
