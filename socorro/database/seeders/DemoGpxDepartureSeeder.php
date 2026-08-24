<?php

namespace Database\Seeders;

use App\Models\SendOut;
use Illuminate\Database\Seeder;

class DemoGpxDepartureSeeder extends Seeder
{
    public function run(): void
    {
        SendOut::updateOrCreate(['document_number' => 'GPXDEMO2026'], [
            'name' => 'Ruta', 'lastname' => 'Demostrativa', 'document_type' => '1',
            'email' => 'demo@socorroandino.cl', 'phone' => '912345678', 'region' => 6,
            'destination' => 'Cerro Manquehue', 'route' => 'Acceso Lo Curro - Cumbre Cerro Manquehue',
            'file_path' => 'sendouts/demo-cerro-manquehue.gpx', 'activity' => 0,
            'number_participants' => 2, 'departure_date' => now()->addDay()->setTime(8, 0),
            'return_date' => now()->addDay()->setTime(17, 0), 'active' => true,
            'name_emergency_family' => 'María Demo', 'parentesco_family_emergency' => 'Madre',
            'number_family_emergency' => '912345679', 'name_emergency_family_2' => 'Carlos Demo',
            'parentesco_family_emergency_2' => 'Amigo', 'number_family_emergency_2' => '912345680',
        ]);
    }
}
