<?php

namespace Tests\Feature;

use App\Models\Delegation;
use App\Models\FinanceCategory;
use App\Models\FinanceTransaction;
use App\Models\User;
use App\Models\Voluntary;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class DelegationIsolationTest extends TestCase
{
    use DatabaseTransactions;

    private function regionalUser(): array
    {
        $nationalUser = User::where('role', 'admin')->firstOrFail();
        $regionalDelegation = Delegation::where('is_national', false)->firstOrFail();
        $voluntary = $nationalUser->voluntary->replicate();
        $voluntary->delegation_id = $regionalDelegation->id;
        $voluntary->document = 'REG'.random_int(100000, 999999);
        $voluntary->busy = true;
        $voluntary->save();
        $user = User::create(['name'=>'Administrador regional','email'=>'regional-isolation@example.com','password'=>Hash::make('password'),'role'=>'admin','status'=>'A','voluntary_id'=>$voluntary->id]);
        return [$user, $voluntary, $nationalUser];
    }

    public function test_regional_user_only_sees_voluntaries_from_own_delegation(): void
    {
        [$regionalUser, $regionalVoluntary, $nationalUser] = $this->regionalUser();

        $response = $this->actingAs($regionalUser)->getJson(route('voluntarios.data'))->assertOk();
        $visibleIds = collect($response->json())->pluck('id');
        $this->assertTrue($visibleIds->contains($regionalVoluntary->id));
        $this->assertFalse($visibleIds->contains($nationalUser->voluntary_id));
        $this->actingAs($regionalUser)->get(route('roles.index'))->assertForbidden();
    }

    public function test_finances_are_isolated_and_national_can_see_all(): void
    {
        [$regionalUser, $regionalVoluntary, $nationalUser] = $this->regionalUser();
        $category = FinanceCategory::where('system_key', 'membership_dues')->firstOrFail();
        FinanceTransaction::create(['finance_category_id'=>$category->id,'user_id'=>$regionalUser->id,'voluntary_id'=>$regionalVoluntary->id,'transaction_date'=>now(),'amount'=>1000,'counterparty'=>'Regional','description'=>'Movimiento regional']);
        FinanceTransaction::create(['finance_category_id'=>$category->id,'user_id'=>$nationalUser->id,'voluntary_id'=>$nationalUser->voluntary_id,'transaction_date'=>now(),'amount'=>2000,'counterparty'=>'Nacional','description'=>'Movimiento nacional']);

        $this->actingAs($regionalUser)->get(route('finances.index'))->assertOk()->assertSee('Movimiento regional')->assertDontSee('Movimiento nacional');
        $this->actingAs($nationalUser)->get(route('finances.index'))->assertOk()->assertSee('Movimiento regional')->assertSee('Movimiento nacional');
    }
}
