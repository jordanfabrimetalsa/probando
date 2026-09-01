<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(DemoContentSeeder::class);

        $now = now();
        $delegationId = DB::table('delegations')->where('is_national', true)->value('id')
            ?? DB::table('delegations')->where('name', 'Metropolitana')->value('id');
        $voluntaryId = DB::table('voluntaries')->where('document', '12345678')->value('id');
        if (!$voluntaryId) {
            $voluntaryId = DB::table('voluntaries')->insertGetId([
                'delegation_id' => $delegationId, 'document' => '12345678', 'name' => 'Administrador',
                'lastname' => 'Sistema', 'phone' => '912345678', 'birthday' => '2000-01-01',
                'address' => 'Sede nacional', 'profession' => 'Administración', 'gender' => 'M',
                'allergic' => false, 'disease' => false, 'medicine' => false, 'vehicle' => false,
                'license' => false, 'payment' => false, 'blood_type' => 'N', 'type' => 'A',
                'status' => 'A', 'busy' => true, 'created_at' => $now, 'updated_at' => $now,
            ]);
        } else {
            DB::table('voluntaries')->where('id', $voluntaryId)->update([
                'delegation_id' => $delegationId,
                'updated_at' => $now,
            ]);
        }

        DB::table('users')->updateOrInsert(['email' => 'admin@admin.com'], [
            'name' => 'Administrador', 'password' => Hash::make('admin'), 'role' => 'admin',
            'status' => 'A', 'voluntary_id' => $voluntaryId, 'updated_at' => $now, 'created_at' => $now,
        ]);

        $this->call(RescueDashboardDemoSeeder::class);
        $this->call(MountainEquipmentSeeder::class);
        $this->call(DepartureDashboardDemoSeeder::class);
    }
}
