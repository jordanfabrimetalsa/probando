<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class VoluntaryRemarkTest extends TestCase
{
    use DatabaseTransactions;

    public function test_authorized_user_can_register_a_congratulation_remark(): void
    {
        $admin = User::where('role', 'admin')->firstOrFail();
        $this->actingAs($admin)->postJson(route('voluntarios.remark'), [
            'id_user_remark'=>$admin->voluntary_id,
            'remark'=>'Excelente participación en operativo.',
            'gravity'=>'0',
        ])->assertOk();

        $this->assertDatabaseHas('remarks', ['voluntary_id'=>$admin->voluntary_id, 'responsable_id'=>$admin->id, 'gravity'=>'0']);
    }
}
