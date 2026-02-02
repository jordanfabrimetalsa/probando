<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $regions = [
            'Arica y Parinacota',
            'Tarapacá',
            'Antofagasta',
            'Atacama',
            'Coquimbo',
            'Valparaíso',
            'Metropolitana',
            'O Higgins',
            'Maule',
            'Ñuble',
            'Biobío',
            'Araucanía',
            'Los Ríos',
            'Los Lagos',
            'Aysén',
            'Magallanes'
        ];

        foreach ($regions as $region) {
            DB::table('regions')->insert([
                'name' => $region,
                'active' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        /* php artisan db:seed --class=RegionSeeder */
    }
}
