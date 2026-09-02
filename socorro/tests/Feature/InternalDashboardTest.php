<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\FinanceCategory;
use App\Models\FinanceTransaction;
use App\Models\Guard;
use App\Models\Schedule;
use App\Models\Voluntary;
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

    public function test_common_user_can_register_but_cannot_view_rescue_dashboard_or_records(): void
    {
        $user = User::where('role', 'comun')->first();
        $this->assertNotNull($user, 'Se necesita un usuario común para comprobar el acceso a rescates.');

        $this->actingAs($user)
            ->get(route('registro_rescate'))
            ->assertOk()
            ->assertSee('Registrar rescate')
            ->assertDontSee('Dashboard de rescates')
            ->assertDontSee('Registros de rescate');

        $this->actingAs($user)->get(route('registro-rescate.dashboard'))->assertForbidden();
        $this->actingAs($user)->get(route('registro-rescate'))->assertForbidden();
    }

    public function test_admin_can_view_rescue_dashboard_and_records(): void
    {
        $user = User::where('role', 'admin')->first();
        $this->assertNotNull($user);

        $this->actingAs($user)->get(route('registro-rescate.dashboard'))->assertOk();
        $this->actingAs($user)->get(route('registro-rescate'))->assertOk();
    }

    public function test_guard_registration_never_exceeds_configured_capacity(): void
    {
        $user = User::where('role', 'comun')->whereNotNull('voluntary_id')->first();
        $leader = Voluntary::where('id', '!=', $user?->voluntary_id)->first();
        $this->assertNotNull($user);
        $this->assertNotNull($leader);

        $schedule = Schedule::create([
            'title' => 'Guardia de prueba con cupo controlado',
            'description' => 'Validación automática de cupos.',
            'type' => 'Guard',
            'start' => now()->toDateString(),
            'end' => now()->addDay()->toDateString(),
            'guard_enabled' => true,
            'guard_capacity' => 1,
            'guard_leader_id' => $leader->id,
        ]);
        Guard::create(['id_event' => $schedule->id, 'id_voluntary' => $leader->id, 'type' => 'leader']);

        $this->actingAs($user)->get(route('guardias.available'))
            ->assertOk()
            ->assertSee('Guardia de prueba con cupo controlado')
            ->assertSee('Guardia completa');

        $this->actingAs($user)->post(route('guardias.join', $schedule))
            ->assertSessionHasErrors('guard');
        $this->assertSame(1, Guard::where('id_event', $schedule->id)->count());
    }

    public function test_only_guard_organizer_or_admin_can_configure_guards(): void
    {
        $operator = User::where('role', 'comun')->first();
        $this->assertNotNull($operator);
        $operator->update(['role' => 'jefe_operaciones']);
        $leader = Voluntary::first();
        $this->assertNotNull($leader);

        $schedule = Schedule::create([
            'title' => 'Guardia restringida', 'description' => 'Prueba', 'type' => 'Guard',
            'start' => now()->toDateString(), 'end' => now()->addDay()->toDateString(),
            'guard_enabled' => false, 'guard_capacity' => 5, 'guard_leader_id' => $leader->id,
        ]);

        $this->actingAs($operator)->put(route('calendario.guard.configure', $schedule), [
            'guard_enabled' => 1, 'guard_capacity' => 5, 'guard_leader_id' => $leader->id,
        ])->assertForbidden();
    }

    public function test_guard_title_is_generated_sequentially_for_each_month(): void
    {
        $admin = User::where('role', 'admin')->first();
        $leader = Voluntary::first();
        $this->assertNotNull($admin);
        $this->assertNotNull($leader);

        $payload = [
            'description' => 'Guardia mensual de prueba',
            'start' => '2035-04-05',
            'end' => '2035-04-05',
            'guard_enabled' => 1,
            'guard_capacity' => 10,
            'guard_leader_id' => $leader->id,
        ];

        $this->actingAs($admin)->postJson(route('calendario.store'), $payload)
            ->assertOk()->assertJsonPath('event.title', 'Guardia N° 1');
        $payload['start'] = $payload['end'] = '2035-04-12';
        unset($payload['guard_leader_id']);
        $this->actingAs($admin)->postJson(route('calendario.store'), $payload)
            ->assertOk()->assertJsonPath('event.title', 'Guardia N° 2');
        $guardWithoutLeader = Schedule::where('title', 'Guardia N° 2')->whereDate('start', '2035-04-12')->first();
        $this->assertNotNull($guardWithoutLeader);
        $this->assertNull($guardWithoutLeader->guard_leader_id);
        $this->assertSame(0, Guard::where('id_event', $guardWithoutLeader->id)->count());
    }
}
