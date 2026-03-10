<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rescue;
use App\Models\Voluntary;
use Illuminate\Support\Facades\DB;
use Exception;
use PDF;
use Illuminate\Support\Facades\Storage;

class RescueController extends Controller
{
    public function index(){
        $voluntaries = Voluntary::all();
        return view('module.registro_rescate.index', compact('voluntaries'));
    }

    public function registerComun(){
        $voluntaries = Voluntary::all();
        return view('module.registro_rescate.register_comun', compact('voluntaries'));
    }

    public function data(){
        try{
            $rescue = Rescue::all();
            return response()->json($rescue);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function show($id){
        try{
            $rescue = Rescue::join('voluntaries', 'rescue.voluntario_id', '=', 'voluntaries.id')
                            ->select('rescue.*', 'voluntaries.name as voluntary_name', 'voluntaries.lastname as voluntary_lastname')
                            ->find($id);

            if(!$rescue){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Registro no encontrado'
                ], 404);
            }

            return response()->json([
                'status' => 'success',
                'data' => $rescue
            ], 200);

        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error interno: ' . $id . ' -  ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request){
        try{
            if ($request->has('fecha_operativo')) {
                $result = DB::transaction(function () use ($request) {
                    $now = now();

                    $rescateId = DB::table('rescates')->insertGetId([
                        'fecha_operativo' => $request->input('fecha_operativo'),
                        'hora_llamado' => $request->input('hora_llamado'),
                        'tipo_emergencia' => $request->input('tipo_emergencia'),
                        'nombre_llamado' => $request->input('nombre_llamado'),
                        'telefono' => $request->input('telefono'),
                        'nombre_completo' => $request->input('nombre_completo'),
                        'rut_dni' => $request->input('rut_dni'),
                        'edad' => $request->input('edad'),
                        'sexo' => $request->input('sexo'),
                        'estatura' => $request->input('estatura'),
                        'peso' => $request->input('peso'),
                        'telefono_afectado' => $request->input('telefono_afectado'),
                        'condicion_fisica' => $request->input('condicion_fisica'),
                        'lugar_exacto' => $request->input('lugar_exacto'),
                        'latitud' => $request->input('latitud'),
                        'longitud' => $request->input('longitud'),
                        'altitud' => $request->input('altitud'),
                        'ubicacion_vehiculo_rescate' => $request->input('ubicacion_vehiculo_rescate'),
                        'condicion_sanitaria_inicial' => $request->input('condicion_sanitaria_inicial'),
                        'eva_inicial' => $request->input('eva_inicial'),
                        'msc_inicial' => $request->input('msc_inicial'),
                        'estado_emocional_psicologico' => $request->input('estado_emocional_psicologico'),
                        'resumen_acciones' => $request->input('resumen_acciones'),
                        'medicamentos_administrados' => $request->input('medicamentos_administrados'),
                        'metodo_evacuacion' => $request->input('metodo_evacuacion'),
                        'destino_final_paciente' => $request->input('destino_final_paciente'),
                        'descripcion_emergencia' => $request->input('descripcion_emergencia'),
                        'observaciones_generales' => $request->input('observaciones_generales'),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    DB::table('rescate_xabcde')->insert([
                        'rescate_id' => $rescateId,
                        'x_hemorragias' => $request->input('xabcde_x'),
                        'a_via_aerea' => $request->input('xabcde_a'),
                        'b_respiracion' => $request->input('xabcde_b'),
                        'c_circulacion' => $request->input('xabcde_c'),
                        'd_estado_neurologico' => $request->input('xabcde_d'),
                        'e_exposicion' => $request->input('xabcde_e'),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    DB::table('rescate_sample')->insert([
                        'rescate_id' => $rescateId,
                        'signos_sintomas' => $request->input('sample_signos_sintomas'),
                        'alergias' => $request->input('sample_alergias'),
                        'medicamentos' => $request->input('sample_medicamentos'),
                        'patologias_previas' => $request->input('sample_patologias_previas'),
                        'ultima_ingesta' => $request->input('sample_ultima_ingesta'),
                        'eventos_previos' => $request->input('sample_eventos_previos'),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    DB::table('rescate_bitacora')->insert([
                        'rescate_id' => $rescateId,
                        'emergencia_presencial' => $request->input('bitacora_emergencia_presencial'),
                        'salida_cuartel' => $request->input('bitacora_salida_cuartel'),
                        'llegada_acceso' => $request->input('bitacora_llegada_acceso'),
                        'contacto_grupo' => $request->input('bitacora_contacto_grupo'),
                        'evaluacion_sanitaria_inicial' => $request->input('bitacora_evaluacion_sanitaria_inicial'),
                        'inicio_descenso' => $request->input('bitacora_inicio_descenso'),
                        'llegada_extraccion' => $request->input('bitacora_llegada_extraccion'),
                        'traslado_destino_final' => $request->input('bitacora_traslado_destino_final'),
                        'regreso_cuartel' => $request->input('bitacora_regreso_cuartel'),
                        'created_at' => $now,
                        'updated_at' => $now,
                    ]);

                    $materiales = $request->input('material_equipo_utilizado', []);
                    if (!is_array($materiales)) {
                        $materiales = [];
                    }

                    $otros = trim((string) $request->input('material_equipo_otros'));
                    if ($otros !== '') {
                        $materiales[] = $otros;
                    }

                    $materiales = array_values(array_unique(array_filter(array_map('trim', $materiales), fn ($v) => $v !== '')));
                    foreach ($materiales as $material) {
                        DB::table('rescate_material_equipo')->insert([
                            'rescate_id' => $rescateId,
                            'material' => $material,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]);
                    }

                    $voluntarios = $request->input('voluntarios', []);
                    if (!is_array($voluntarios)) {
                        $voluntarios = [];
                    }
                    $voluntarios = array_values(array_unique(array_filter($voluntarios, fn ($v) => (string) $v !== '')));
                    foreach ($voluntarios as $voluntarioId) {
                        DB::table('rescate_voluntarios')->insert([
                            'rescate_id' => $rescateId,
                            'voluntario_id' => $voluntarioId,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]);
                    }

                    $instituciones = $request->input('instituciones', []);
                    if (!is_array($instituciones)) {
                        $instituciones = [];
                    }
                    $instituciones = array_values(array_unique(array_filter(array_map('trim', $instituciones), fn ($v) => $v !== '')));
                    foreach ($instituciones as $institucion) {
                        DB::table('rescate_instituciones')->insert([
                            'rescate_id' => $rescateId,
                            'institucion' => $institucion,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ]);
                    }

                    return $rescateId;
                });

                return response()->json([
                    'status' => 'success',
                    'message' => 'Rescate registrado correctamente',
                    'rescate_id' => $result,
                ]);
            }

            $rescue = new Rescue();
            $rescue->type = $request->type;
            $rescue->place = $request->place;
            $rescue->road = $request->road;
            $rescue->weather = $request->weather;
            $rescue->kilometer_total = $request->kilometer_total;
            $rescue->different_height = $request->different_height;
            $rescue->quantity_people = $request->quantity_people;
            $rescue->quantity_voluntaries = $request->quantity_voluntaries;
            $rescue->helper_external = $request->helper_external;
            $rescue->external_helper = $request->external_helper;

            $rescue->name_accident = $request->name_accident;
            $rescue->phone_accident = $request->phone_accident;
            $rescue->email_accident = $request->email_accident;
            $rescue->address = $request->address;
            $rescue->city = $request->city;
            $rescue->state = $request->state;

            $rescue->allergic = $request->allergic;
            $rescue->disease = $request->disease;
            $rescue->date_call = $request->date_call;
            $rescue->date_start_trek = $request->date_start_trek;
            $rescue->date_middle_trek = $request->date_middle_trek;
            $rescue->date_finish_rescue = $request->date_finish_rescue;
            $rescue->injury = $request->injury;
            $rescue->gravity = $request->gravity;
            $rescue->medical_assistance = $request->medical_assistance;
            $rescue->Stretcher = $request->Stretcher;
            $rescue->type_transport = $request->type_transport;
            $rescue->helicopter = $request->helicopter;
            $rescue->voluntario_id = $request->voluntary_id;
            $rescue->user_id = Auth::user()->id;
            $rescue->situation = $request->situation;
            $rescue->observations = $request->observations;
            $rescue->save();

            $pdf = PDF::loadView('module.pdf.rescue', compact('rescue'));

            $relativePath = "rescues/rescue_{$rescue->id}.pdf"; // dentro de 'public' disk
            Storage::disk('public')->put($relativePath, $pdf->output());

            return response()->json([
                'status' => 'success',
                'message' => 'Rescate registrado correctamente',
                'download_url' => Storage::disk('public')->url($relativePath) // opcional
            ]);
        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function pdf($id)
    {
        $rescue = \App\Models\Rescue::findOrFail($id);
        $path = "rescues/rescue_{$rescue->id}.pdf";

        if (!Storage::disk('public')->exists($path)) {
            $pdf = PDF::loadView('module.pdf.rescue', compact('rescue'));
            Storage::disk('public')->put($path, $pdf->output());
        }

        $absolutePath = \Storage::disk('public')->path($path);

        return response()->file($absolutePath);
    }

    public function update(Request $request, $id){
        try{
            $rescue = Rescue::find($id);
            if($rescue->situation != 'completed'){
                $rescue->type = $request->type_show_hidden;
                $rescue->place = $request->place_show;
                $rescue->road = $request->road_show;
                $rescue->weather = $request->weather_show_hidden;
                $rescue->kilometer_total = $request->kilometer_total_show;
                $rescue->different_height = $request->different_height_show;
                $rescue->quantity_people = $request->quantity_people_show;
                $rescue->quantity_voluntaries = $request->quantity_voluntaries_show;
                $rescue->helper_external = $request->helper_external_show_hidden;
                $rescue->external_helper = $request->external_helper_show_hidden;

                $rescue->name_accident = $request->name_accident_show;
                $rescue->phone_accident = $request->phone_accident_show;
                $rescue->email_accident = $request->email_accident_show;
                $rescue->address = $request->address_show;
                $rescue->city = $request->city_show;
                $rescue->state = $request->state_show;
                $rescue->allergic = $request->allergic_show;
                $rescue->disease = $request->disease_show;

                $rescue->date_call = $request->date_call_show;
                $rescue->date_start_trek = $request->date_start_trek_show;
                $rescue->date_middle_trek = $request->date_middle_trek_show;
                $rescue->date_finish_rescue = $request->date_finish_rescue_show;
                $rescue->injury = $request->injury_show;
                $rescue->gravity = $request->gravity_show;
                $rescue->medical_assistance = $request->medical_assistance_show_hidden;

                $rescue->Stretcher = $request->Stretcher_show_hidden;
                $rescue->type_transport = $request->type_transport_show_hidden;
                $rescue->helicopter = $request->helicopter_show_hidden;
                $rescue->voluntario_id = $request->voluntary_id_show_hidden;
                $rescue->situation = $request->situation_show;
                $rescue->observations = $request->observations_show;
                $rescue->save();

                return response()->json([
                    'status' => 'success',
                    'message' => 'Rescate actualizado correctamente: ' . $request
                ]);
            }else{
                return response()->json([
                    'status' => 'error',
                    'message' => 'No se puede actualizar el rescate, porque ya esta completado.'
                ]);
            }

        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function destroy($id){
        $rescue = Rescue::find($id);

        if(!$rescue){
            return response()->json([
                'status' => 'error',
                'message' => 'Rescate no encontrado por: ' . $rescue
            ], 404);
        }

        $rescue->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Rescate eliminado correctamente'
        ]);
    }
}
