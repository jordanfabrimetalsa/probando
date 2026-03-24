<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Rescue;
use App\Models\Voluntary;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf as PDFFacade;

class RescueController extends Controller
{

    public function index(){
        $delegacionId = session('voluntary.delegation_id');
        $voluntaries = Voluntary::where('delegation_id', $delegacionId)->get();
        return view('module.registro_rescate.index', compact('voluntaries'));
    }

    public function registerComun(){
        $delegacionId = session('voluntary.delegation_id');
        $voluntaries = Voluntary::where('delegation_id', $delegacionId)->get();
        return view('module.registro_rescate.register_comun', compact('voluntaries'));
    }

    public function data(){
        try{
            $rescue = DB::table('rescates')->get();
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
            // Primero obtener datos básicos del rescate
            $rescue = DB::table('rescates')->where('id', $id)->first();

            if(!$rescue){
                return response()->json([
                    'status' => 'error',
                    'message' => 'Registro no encontrado'
                ], 404);
            }

            // Intentar obtener datos relacionados solo si las tablas existen
            $voluntaries = [];
            $instituciones = [];
            $xabcde = null;
            $sample = null;

            try {
                // Obtener voluntarios relacionados
                $voluntaries = DB::table('rescate_voluntaries')
                                ->join('voluntaries', 'rescate_voluntaries.voluntary_id', '=', 'voluntaries.id')
                                ->where('rescate_voluntaries.rescate_id', $id)
                                ->select('voluntaries.id', 'voluntaries.name', 'voluntaries.lastname')
                                ->get();
            } catch (Exception $e) {
                // Tabla no existe, continuar sin voluntarios
            }

            try {
                // Obtener instituciones relacionadas
                $instituciones = DB::table('rescate_instituciones')
                                  ->where('rescate_instituciones.rescate_id', $id)
                                  ->pluck('institucion');
            } catch (Exception $e) {
                // Tabla no existe, continuar sin instituciones
            }

            try {
                // Obtener datos XABCDE si existen
                $xabcde = DB::table('rescate_xabcde')
                           ->where('rescate_id', $id)
                           ->first();
            } catch (Exception $e) {
                // Tabla no existe, continuar sin xabcde
            }

            try {
                // Obtener datos SAMPLE si existen
                $sample = DB::table('rescate_sample')
                          ->where('rescate_id', $id)
                          ->first();
            } catch (Exception $e) {
                // Tabla no existe, continuar sin sample
            }


            try {
                // Obtener datos BITACORA si existen
                $bitacora = DB::table('rescate_bitacora')
                            ->where('rescate_id', $id)
                            ->first();
            } catch (Exception $e) {
                // Tabla no existe, continuar sin bitacora
            }

            // Combinar todos los datos
            $rescueData = (array) $rescue;
            $rescueData['voluntaries'] = $voluntaries;
            $rescueData['instituciones'] = $instituciones;
            $rescueData['xabcde'] = $xabcde;
            $rescueData['sample'] = $sample;
            $rescueData['bitacora'] = $bitacora;

            return response()->json([
                'status' => 'success',
                'data' => $rescueData
            ], 200);

        }catch(Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'Error interno: ' . $id . ' -  ' . $e->getMessage()
            ], 500);
        }
    }

public function store(Request $request)
{
    try{
        if ($request->has('fecha_operativo')) {
            $rescateId = DB::transaction(function () use ($request) {
                $now = now();
                $rescateId = DB::table('rescates')->insertGetId([
                    'fecha_operativo' => $request->input('fecha_operativo'),
                    'hora_llamado' => $request->input('hora_llamado'),
                    'tipo_emergencia' => $request->input('tipo_emergencia'),
                    'lugar' => $request->input('lugar'),
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
                    'id_delegation' => session('voluntary.delegation_id'),
                    'id_usuario' => Auth::user()->id,
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

                $materiales = (array) $request->input('material_equipo_utilizado', []);
                $materiales = array_values(array_unique(array_filter($materiales, fn($v) => $v !== null && $v !== '')));
                if (in_array('Otros', $materiales, true)) {
                    $otros = trim((string) $request->input('material_equipo_otros', ''));
                    if ($otros !== '') {
                        $materiales[] = $otros;
                    }
                    $materiales = array_values(array_filter($materiales, fn($v) => $v !== 'Otros'));
                }

                if (!empty($materiales)) {
                    $materialRows = array_map(function ($material) use ($rescateId, $now) {
                        return [
                            'rescate_id' => $rescateId,
                            'material' => $material,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }, $materiales);
                    DB::table('rescate_material_equipo')->insert($materialRows);
                }

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

                $voluntariosIds = (array) $request->input('voluntarios', []);
                $voluntariosIds = array_values(array_unique(array_filter($voluntariosIds, fn($v) => $v !== null && $v !== '')));
                if (!empty($voluntariosIds)) {
                    $voluntarioRows = array_map(function ($voluntarioId) use ($rescateId, $now) {
                        return [
                            'rescate_id' => $rescateId,
                            'voluntario_id' => $voluntarioId,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }, $voluntariosIds);
                    DB::table('rescate_voluntarios')->insert($voluntarioRows);
                }

                $instituciones = (array) $request->input('instituciones', []);
                $instituciones = array_values(array_unique(array_filter($instituciones, fn($v) => $v !== null && $v !== '')));
                if (!empty($instituciones)) {
                    $institucionRows = array_map(function ($institucion) use ($rescateId, $now) {
                        return [
                            'rescate_id' => $rescateId,
                            'institucion' => $institucion,
                            'created_at' => $now,
                            'updated_at' => $now,
                        ];
                    }, $instituciones);
                    DB::table('rescate_instituciones')->insert($institucionRows);
                }

                return $rescateId;
            });

            /* CONSULTAR DATOS PARA EL PDF */
            $rescate = DB::table('rescates')->where('id', $rescateId)->first();
            $xabcde = DB::table('rescate_xabcde')->where('rescate_id', $rescateId)->first();
            $sample = DB::table('rescate_sample')->where('rescate_id', $rescateId)->first();
            $bitacora = DB::table('rescate_bitacora')->where('rescate_id', $rescateId)->first();

            $materiales = DB::table('rescate_material_equipo')
                ->where('rescate_id', $rescateId)
                ->get();

            $voluntarios = DB::table('rescate_voluntarios')
                ->join('voluntaries', 'rescate_voluntarios.voluntario_id', '=', 'voluntaries.id')
                ->where('rescate_voluntarios.rescate_id', $rescateId)
                ->select(
                    'rescate_voluntarios.voluntario_id',
                    'voluntaries.name',
                    'voluntaries.lastname'
                )
                ->get();

            $instituciones = DB::table('rescate_instituciones')
                ->where('rescate_id', $rescateId)
                ->get();

            /* DATOS PARA LA VISTA PDF */
            $data = [
                'rescate' => $rescate,
                'xabcde' => $xabcde,
                'sample' => $sample,
                'bitacora' => $bitacora,
                'materiales' => $materiales,
                'voluntarios' => $voluntarios,
                'instituciones' => $instituciones
            ];

            $nombreArchivo = 'rescate_' . $rescateId . '.pdf';
            $relativePath = 'rescues/' . $nombreArchivo;

            $pdf = PDFFacade::loadView('module.pdf.rescue', $data);
            Storage::disk('public')->put($relativePath, $pdf->output());

            return response()->json([
                'status' => 'success',
                'message' => 'Rescate registrado correctamente',
                'rescate_id' => $rescateId,
                'download_url' => Storage::url($relativePath),
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Datos incompletos'
        ]);

    }catch(\Exception $e){

        return response()->json([
            'status' => 'error',
            'message' => 'Error al registrar rescate: '.$e->getMessage()
        ]);
    }
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
        $rescue =
        DB::table('rescates')
        ->where('id', $id)
        ->first();

        if(!$rescue){
            return response()->json([
                'status' => 'error',
                'message' => 'Rescate no encontrado por: ' . $rescue
            ], 404);
        }

        DB::table('rescates')->where('id', $id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Rescate eliminado correctamente'
        ]);
    }
}
