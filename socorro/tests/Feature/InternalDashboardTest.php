<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\FinanceCategory;
use App\Models\FinanceTransaction;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class InternalDashboardTest extends TestCase
{
    use DatabaseTransactions;
    public function test_authenticated_user_can_render_dashboard_with_charts(): void
    {
        $user = User::where('role', 'admin')->first();
        $this->assertNotNull($user, 'Se necesita un usuario administrador para comprobar el panel interno.');

        $this->actingAs($user)
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('departuresChart')
            ->assertSee('activitiesChart')
            ->assertSee('regionsChart')
            ->assertSee('Salidas que requieren seguimiento');
    }

    public function test_finance_category_validation_is_controlled(): void
    {
        $user = User::where('role', 'admin')->first();
        $this->assertNotNull($user, 'Se necesita un usuario administrador para comprobar finanzas.');

        $this->actingAs($user)
            ->post(route('finances.categories.store'), [])
            ->assertSessionHasErrors(['name', 'type', 'color']);
    }

    public function test_authenticated_user_can_render_profile_without_serializing_exceptions(): void
    {
        $user = User::whereNotNull('voluntary_id')->first();
        $this->assertNotNull($user, 'Se necesita un usuario asociado a un voluntario para comprobar el perfil.');

        $this->actingAs($user)
            ->get(route('profile'))
            ->assertOk();
    }

    public function test_dues_payment_is_visible_in_voluntary_profile(): void
    {
        $user = User::whereNotNull('voluntary_id')->first();
        $category = FinanceCategory::where('system_key', 'membership_dues')->first();
        $this->assertNotNull($user);
        $this->assertNotNull($category);

        FinanceTransaction::create([
            'finance_category_id' => $category->id,
            'user_id' => $user->id,
            'voluntary_id' => $user->voluntary_id,
            'transaction_date' => now()->toDateString(),
            'amount' => 5000,
            'counterparty' => 'Voluntario CSA',
            'description' => 'Cuota de prueba visible en perfil',
        ]);

        $this->actingAs($user)->get(route('profile'))
            ->assertOk()
            ->assertSee('Cuota de prueba visible en perfil');
    }

    public function test_inventory_movements_reject_incomplete_or_invalid_quantities(): void
    {
        $user = User::where('role', 'admin')->first();
        $this->assertNotNull($user);

        $this->actingAs($user)->postJson(route('inventario.add_stock'), ['quantity' => 0])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['product_id_show', 'quantity', 'unit_cost', 'source']);

        $this->actingAs($user)->postJson(route('inventario.reduce_stock'), ['quantity' => -1])
            ->assertUnprocessable()
            ->assertJsonValidationErrors(['product_id_reduce', 'quantity', 'reason']);
    }
}
