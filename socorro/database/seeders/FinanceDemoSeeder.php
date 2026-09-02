<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FinanceDemoSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $user = DB::table('users')->where('role', 'admin')->first();
        $delegationId = $user
            ? DB::table('voluntaries')->where('id', $user->voluntary_id)->value('delegation_id')
            : DB::table('delegations')->where('is_national', true)->value('id');
        $voluntaryId = $user?->voluntary_id;

        $categoryData = [
            ['Cuotas','income','#176985','membership_dues',true],
            ['Donaciones','income','#2E7D32',null,false],
            ['Aportes institucionales','income','#1565C0',null,false],
            ['Actividades de recaudación','income','#6A1B9A',null,false],
            ['Equipamiento','expense','#EA4E1A',null,false],
            ['Combustible y transporte','expense','#EF6C00',null,false],
            ['Capacitación','expense','#C62828',null,false],
            ['Mantención de sede','expense','#546E7A',null,false],
            ['Comunicaciones','expense','#00838F',null,false],
        ];
        foreach ($categoryData as [$name,$type,$color,$systemKey,$isSystem]) {
            DB::table('finance_categories')->updateOrInsert(['name'=>$name,'type'=>$type], [
                'color'=>$color,'active'=>true,'system_key'=>$systemKey,'is_system'=>$isSystem,
                'created_at'=>$now,'updated_at'=>$now,
            ]);
        }
        $categories = DB::table('finance_categories')->get()->keyBy(fn ($category) => $category->name.'|'.$category->type);

        $transactions = [
            ['2026-01-08','Cuotas','income',15000,'Voluntario CSA','Cuota mensual enero','Socio activo'],
            ['2026-01-20','Donaciones','income',180000,'Donante particular','Donación para operaciones','Aporte anónimo'],
            ['2026-01-25','Equipamiento','expense',95000,'Proveedor técnico','Compra de mosquetones','Orden de compra'],
            ['2026-02-05','Cuotas','income',15000,'Voluntario CSA','Cuota mensual febrero','Socio activo'],
            ['2026-02-16','Combustible y transporte','expense',72000,'Estación de servicio','Combustible vehículo operativo','Carga mensual'],
            ['2026-02-25','Aportes institucionales','income',350000,'Municipalidad','Aporte para prevención','Convenio local'],
            ['2026-03-07','Actividades de recaudación','income',245000,'Comunidad','Jornada solidaria de montaña','Actividad pública'],
            ['2026-03-12','Capacitación','expense',130000,'Instructor externo','Curso de rescate técnico','Formación anual'],
            ['2026-03-22','Comunicaciones','expense',48000,'Proveedor telecomunicaciones','Planes de radio y datos','Servicio mensual'],
            ['2026-04-05','Cuotas','income',15000,'Voluntario CSA','Cuota mensual abril','Socio activo'],
            ['2026-04-14','Mantención de sede','expense',89000,'Ferretería local','Reparaciones menores de sede','Materiales'],
            ['2026-04-28','Donaciones','income',125000,'Club de montaña','Donación de apoyo operativo','Transferencia'],
            ['2026-05-03','Aportes institucionales','income',500000,'Gobierno regional','Aporte para equipamiento invernal','Proyecto invierno'],
            ['2026-05-11','Equipamiento','expense',275000,'Proveedor de montaña','Compra de cuerdas técnicas','Orden de compra'],
            ['2026-05-19','Combustible y transporte','expense',84000,'Estación de servicio','Traslado a entrenamiento','Vehículo institucional'],
            ['2026-06-04','Cuotas','income',15000,'Voluntario CSA','Cuota mensual junio','Socio activo'],
            ['2026-06-15','Capacitación','expense',165000,'Centro de formación','Curso de primeros auxilios','Certificación'],
            ['2026-06-27','Actividades de recaudación','income',310000,'Participantes','Corrida solidaria CSA','Recaudación'],
            ['2026-07-06','Donaciones','income',210000,'Empresa colaboradora','Donación para comunicaciones','Responsabilidad social'],
            ['2026-07-13','Comunicaciones','expense',56000,'Proveedor telecomunicaciones','Renovación de equipos radiales','Servicio técnico'],
            ['2026-07-24','Mantención de sede','expense',118000,'Servicio de mantención','Mantención preventiva de sede','Trabajo realizado'],
            ['2026-08-02','Cuotas','income',15000,'Voluntario CSA','Cuota mensual agosto','Socio activo'],
            ['2026-08-12','Equipamiento','expense',340000,'Proveedor de montaña','Compra de material de nieve','Temporada invernal'],
            ['2026-08-26','Aportes institucionales','income',420000,'Fundación colaboradora','Aporte para rescate y prevención','Convenio anual'],
        ];

        foreach ($transactions as $index => [$date,$category,$type,$amount,$counterparty,$description,$notes]) {
            $reference = 'DEMO-FIN-'.str_pad((string)($index + 1), 3, '0', STR_PAD_LEFT);
            $categoryRecord = $categories[$category.'|'.$type];
            DB::table('finance_transactions')->updateOrInsert(['reference'=>$reference], [
                'finance_category_id'=>$categoryRecord->id,'user_id'=>$user?->id,
                'voluntary_id'=>$categoryRecord->system_key === 'membership_dues' ? $voluntaryId : null,
                'delegation_id'=>$delegationId,'transaction_date'=>$date,'amount'=>$amount,
                'counterparty'=>$counterparty,'description'=>$description,'notes'=>$notes,
                'created_at'=>$now,'updated_at'=>$now,
            ]);
        }
    }
}
