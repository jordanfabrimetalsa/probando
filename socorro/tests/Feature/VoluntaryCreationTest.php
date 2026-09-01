<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class VoluntaryCreationTest extends TestCase
{
    use DatabaseTransactions;

    public function test_voluntary_can_be_created_without_an_image(): void
    {
        $admin = User::where('role', 'admin')->firstOrFail();
        $response = $this->actingAs($admin)->postJson(route('voluntarios.store'), [
            'delegation_id'=>$admin->voluntary->delegation_id, 'document'=>'99111222',
            'name'=>'Voluntario', 'lastname'=>'Sin Foto', 'phone'=>'912345678',
            'birthday'=>'1995-05-10', 'address'=>'Dirección de prueba', 'profession'=>'Rescatista',
            'gender'=>'M', 'allergic'=>0, 'disease'=>0, 'medicine'=>0, 'vehicle'=>0,
            'license'=>0, 'blood_type'=>'O+', 'type'=>'A', 'status'=>'A',
            'rope_technical_level'=>'medium', 'health_level'=>'high', 'stretcher_level'=>'medium',
            'leadership_level'=>'high', 'physical_performance_level'=>'medium', 'snow_ice_level'=>'low',
            'init_voluntary'=>'2026-01-01',
        ]);

        $response->assertCreated()->assertJsonPath('status', 'success');
        $this->assertDatabaseHas('voluntaries', ['document'=>'99111222', 'name'=>'Voluntario']);
    }

    public function test_medical_details_are_required_when_the_answer_is_yes(): void
    {
        $admin = User::where('role', 'admin')->firstOrFail();

        $response = $this->actingAs($admin)->postJson(route('voluntarios.store'), [
            'delegation_id'=>$admin->voluntary->delegation_id, 'document'=>'99111223',
            'name'=>'Voluntario', 'lastname'=>'Con Alergia', 'phone'=>'912345678',
            'birthday'=>'1995-05-10', 'address'=>'Dirección de prueba', 'profession'=>'Rescatista',
            'gender'=>'M', 'allergic'=>1, 'disease'=>1, 'medicine'=>0, 'vehicle'=>0,
            'license'=>0, 'blood_type'=>'O+', 'type'=>'A', 'status'=>'A',
            'rope_technical_level'=>'medium', 'health_level'=>'high', 'stretcher_level'=>'medium',
            'leadership_level'=>'high', 'physical_performance_level'=>'medium', 'snow_ice_level'=>'low',
            'init_voluntary'=>'2026-01-01',
        ]);

        $response->assertUnprocessable()
            ->assertJsonValidationErrors(['allergy_details', 'disease_details']);
    }
}
