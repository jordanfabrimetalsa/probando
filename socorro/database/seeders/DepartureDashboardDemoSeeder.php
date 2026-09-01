<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DepartureDashboardDemoSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $records = [
            ['DEMOAV001','Camila','Rojas',6,'Cerro Provincia','Ruta normal',0,4,'2026-03-14 07:00:00','2026-03-14 19:30:00',false],
            ['DEMOAV002','Diego','Muñoz',5,'Cerro La Campana','Sendero Andinista',0,3,'2026-04-18 06:30:00','2026-04-18 18:00:00',false],
            ['DEMOAV003','Valentina','Soto',6,'Cerro El Plomo','Federación - Refugio Agostini',5,6,'2026-05-22 05:00:00','2026-05-23 20:00:00',false],
            ['DEMOAV004','Matías','Silva',13,'Volcán Osorno','Ruta norte',4,2,'2026-06-11 06:00:00','2026-06-11 17:00:00',false],
            ['DEMOAV005','Fernanda','Pérez',14,'Cerro Castillo','Circuito Las Horquetas',0,5,'2026-07-09 08:00:00','2026-07-11 18:30:00',false],
            ['DEMOAV006','Tomás','Contreras',6,'Cajón del Maipo','Sector Baños Morales',1,4,'2026-08-30 08:00:00','2026-08-31 19:00:00',true],
            ['DEMOAV007','Antonia','Vargas',6,'Cerro Manquehue','Sendero Los Trapenses',0,3,'2026-09-01 07:30:00','2026-09-01 15:30:00',true],
            ['DEMOAV008','Sebastián','Morales',5,'Cerro Aconcagua','Ruta normal Plaza de Mulas',3,5,'2026-09-01 05:00:00','2026-09-03 20:00:00',true],
        ];

        foreach ($records as $index => [$document,$name,$lastname,$region,$destination,$route,$activity,$participants,$departure,$return,$active]) {
            DB::table('notice_departure')->updateOrInsert(['document_number'=>$document], [
                'name'=>$name,'lastname'=>$lastname,'document_type'=>'1','email'=>strtolower($name).'.demo@example.com',
                'phone'=>'9123400'.str_pad((string)$index,2,'0',STR_PAD_LEFT),'region'=>$region,
                'destination'=>$destination,'route'=>$route,'file_path'=>null,'activity'=>$activity,
                'number_participants'=>$participants,'departure_date'=>$departure,'return_date'=>$return,'active'=>$active,
                'name_emergency_family'=>'Contacto principal','parentesco_family_emergency'=>'Amigo','number_family_emergency'=>'987650001',
                'name_emergency_family_2'=>'Contacto secundario','parentesco_family_emergency_2'=>'Hermano','number_family_emergency_2'=>'987650002',
                'created_at'=>$now,'updated_at'=>$now,
            ]);
        }
    }
}
