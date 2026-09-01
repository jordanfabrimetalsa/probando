<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RescueDashboardDemoSeeder extends Seeder
{
    public function run(): void
    {
        $delegationId = DB::table('delegations')->where('is_national', true)->value('id')
            ?? DB::table('delegations')->value('id');
        $userId = DB::table('users')->where('role', 'admin')->value('id');
        $voluntaryIds = DB::table('voluntaries')->where('delegation_id', $delegationId)->pluck('id');
        $now = now();

        $operations = [
            ['2026-01-18','Búsqueda de persona','Cajón del Maipo','Parcial','Cerrado','09:10','15:40',1850,32,'Terrestre','Carabineros de Chile'],
            ['2026-02-07','Accidente en montaña','Cerro Provincia','Total','Controlado','07:35','18:20',2440,41,'Camilla terrestre','SAMU'],
            ['2026-03-22','Rescate en altura','Cerro Manquehue','Parcial','Cerrado','14:20','19:05',1260,29,'Cuerdas','Bomberos de Chile'],
            ['2026-04-11','Emergencia médica','Parque Yerba Loca','Parcial','Derivado','11:05','16:30',1980,54,'Ambulancia','SAMU'],
            ['2026-05-03','Persona extraviada','Quebrada de Macul','Monitoreo','Cerrado','17:25','22:10',1050,24,'Terrestre','Carabineros de Chile'],
            ['2026-05-29','Accidente en montaña','Cerro El Plomo','Total','Controlado','06:15','21:45',4380,37,'Helicóptero','FACh'],
            ['2026-06-14','Rescate en nieve/hielo','Valle Nevado','Total','Cerrado','08:00','17:35',3220,31,'Camilla y cuerdas','Carabineros de Chile'],
            ['2026-07-02','Búsqueda de persona','Embalse El Yeso','Parcial','Suspendido','16:40','23:55',2550,46,'Terrestre','ONEMI'],
            ['2026-07-19','Rescate en altura','Cascada de las Ánimas','Total','Controlado','10:25','18:50',1480,27,'Cuerdas','Bomberos de Chile'],
            ['2026-08-05','Emergencia médica','Cerro San Cristóbal','Monitoreo','Derivado','12:15','14:40',820,63,'Ambulancia','SAMU'],
            ['2026-08-17','Accidente en montaña','Monumento Natural El Morado','Total','Cerrado','07:10','20:25',3100,35,'Helicóptero','Carabineros de Chile'],
            ['2026-08-28','Persona extraviada','Santuario Lagunillas','Parcial','Cerrado','18:05','23:20',2150,22,'Terrestre','Bomberos de Chile'],
        ];

        foreach ($operations as $index => [$date,$type,$place,$activation,$status,$call,$demobilization,$altitude,$age,$evacuation,$institution]) {
            $code = 'DEMO-'.str_pad((string) ($index + 1), 3, '0', STR_PAD_LEFT);
            $rescueId = DB::table('rescates')->where('incident_code', $code)->value('id');
            $payload = [
                'fecha_operativo' => $date,
                'hora_llamado' => $call,
                'commandante_incidente' => 'Jefatura Operativa CSA',
                'puesto_comando' => 'Puesto de comando móvil',
                'nivel_activacion' => $activation,
                'objetivos_incidente' => 'Localizar, estabilizar y evacuar de forma segura a la persona afectada.',
                'riesgos_operacionales' => 'Terreno irregular, exposición climática y dificultad de acceso.',
                'plan_comunicaciones' => 'Canal institucional y reporte periódico al puesto de comando.',
                'zona_operaciones' => 'Área de búsqueda y corredor de evacuación señalizado.',
                'estado_cierre' => $status,
                'hora_desmovilizacion' => $demobilization,
                'lecciones_aprendidas' => 'Reforzar coordinación, chequeo de equipos y comunicaciones previas.',
                'tipo_emergencia' => $type,
                'lugar' => $place,
                'nombre_llamado' => 'Central de comunicaciones',
                'telefono' => '+56 9 5555 0000',
                'nombre_completo' => 'Paciente demostrativo '.($index + 1),
                'rut_dni' => null,
                'edad' => $age,
                'sexo' => $index % 2 === 0 ? 'Masculino' : 'Femenino',
                'condicion_fisica' => $index % 3 === 0 ? 'Lesionado estable' : 'Consciente y orientado',
                'lugar_exacto' => $place,
                'altitud' => $altitude,
                'condicion_sanitaria_inicial' => 'Evaluación primaria realizada en terreno.',
                'resumen_acciones' => 'Activación, aproximación, evaluación, estabilización y evacuación coordinada.',
                'metodo_evacuacion' => $evacuation,
                'destino_final_paciente' => $status === 'Derivado' ? 'Centro asistencial' : 'Punto seguro',
                'descripcion_emergencia' => 'Caso de demostración para visualizar los indicadores del dashboard operacional.',
                'observaciones_generales' => 'Registro generado como contenido demostrativo.',
                'id_delegation' => $delegationId,
                'id_usuario' => $userId,
                'updated_at' => $now,
            ];

            if ($rescueId) {
                DB::table('rescates')->where('id', $rescueId)->update($payload);
            } else {
                $rescueId = DB::table('rescates')->insertGetId($payload + [
                    'incident_code' => $code,
                    'created_at' => $now,
                ]);
            }

            DB::table('rescate_bitacora')->updateOrInsert(['rescate_id' => $rescueId], [
                'emergencia_presencial' => 'Confirmada',
                'salida_cuartel' => date('H:i', strtotime($call.' +'.(12 + ($index % 5) * 4).' minutes')),
                'llegada_acceso' => date('H:i', strtotime($call.' +55 minutes')),
                'contacto_grupo' => date('H:i', strtotime($call.' +110 minutes')),
                'evaluacion_sanitaria_inicial' => 'Paciente evaluado y estabilizado.',
                'inicio_descenso' => date('H:i', strtotime($call.' +180 minutes')),
                'regreso_cuartel' => $demobilization,
                'created_at' => $now,
                'updated_at' => $now,
            ]);

            DB::table('rescate_instituciones')->updateOrInsert([
                'rescate_id' => $rescueId,
                'institucion' => $institution,
            ], ['created_at' => $now, 'updated_at' => $now]);

            foreach ($voluntaryIds->take(($index % 3) + 1) as $voluntaryId) {
                DB::table('rescate_voluntarios')->updateOrInsert([
                    'rescate_id' => $rescueId,
                    'voluntario_id' => $voluntaryId,
                ], ['created_at' => $now, 'updated_at' => $now]);
            }
        }
    }
}
