<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RescueDashboardTest extends TestCase
{
    use DatabaseTransactions;

    public function test_authorized_user_can_render_rescue_dashboard_and_apply_filters(): void
    {
        $admin = User::where('role', 'admin')->firstOrFail();

        $this->actingAs($admin)
            ->get(route('registro-rescate.dashboard', [
                'from' => '2026-01-01',
                'to' => '2026-12-31',
                'status' => 'Cerrado',
            ]))
            ->assertOk()
            ->assertSee('Dashboard de rescates')
            ->assertSee('Evolución mensual')
            ->assertSee('Operaciones recientes');
    }

    public function test_rescue_dashboard_rejects_an_invalid_date_range(): void
    {
        $admin = User::where('role', 'admin')->firstOrFail();

        $this->actingAs($admin)
            ->get(route('registro-rescate.dashboard', [
                'from' => '2026-12-31',
                'to' => '2026-01-01',
            ]))
            ->assertSessionHasErrors('to');
    }
}
