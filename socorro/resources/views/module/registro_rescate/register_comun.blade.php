@extends('layout.main')

@section('title', 'Registro de Rescate')

@section('content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-map-location-dot"></i> Registro
                                de Rescate</h6>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form id="formRescue" class="form" method="POST">
                            @csrf
                            <div class="row p-2">
                                <h5 class="modal-title mb-2">1.- Datos generales del operativo</h5>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Fecha del Operativo</label>
                                    <input type="date" name="fecha_operativo" id="fecha_operativo"
                                        value="{{ old('fecha_operativo') }}" class="form-control"
                                        placeholder="Fecha del Operativo" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Hora del llamado de emergencia</label>
                                    <input type="time" name="hora_llamado" id="hora_llamado"
                                        value="{{ old('hora_llamado') }}" class="form-control"
                                        placeholder="Hora del llamado de emergencia" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Lugar de Emergencia</label>
                                    <input type="text" name="lugar" id="lugar" value="{{ old('lugar') }}"
                                        class="form-control" placeholder="Lugar de Emergencia" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label for="type" class="form-label">Tipo de Emergencia</label>
                                    <select class="form-select border border-gray p-2" aria-label="Default select example"
                                        name="tipo_emergencia" id="tipo_emergencia" required>
                                        <option selected disabled>Seleccione el Tipo</option>
                                        <option value="Rescate en Altura">Rescate en Altura</option>
                                        <option value="Persona Lesionada">Persona Lesionada</option>
                                        <option value="Persona Extraviada">Persona Extraviada</option>
                                        <option value="Varada">Varada (sin ver ruta de regreso)</option>
                                        <option value="Recuperacion">Recuperación</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Nombre de quien realiza el llamado</label>
                                    <input type="text" name="nombre_llamado" id="nombre_llamado"
                                        value="{{ old('nombre_llamado') }}" class="form-control"
                                        placeholder="Nombre de quien realiza el llamado" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Telefono</label>
                                    <input type="text" name="telefono" id="telefono" class="form-control"
                                        value="{{ old('telefono') }}" required>
                                </div>
                            </div>

                            <div class="row p-2">
                                <h5 class="modal-title mb-2">2.- Información de la persona lesionada/afectada</h5>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Nombre Completo</label>
                                    <input type="text" name="nombre_completo" id="nombre_completo"
                                        value="{{ old('nombre_completo') }}" class="form-control"
                                        placeholder="Nombre Completo" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>RUT/DNI</label>
                                    <input type="text" name="rut_dni" id="rut_dni" value="{{ old('rut_dni') }}"
                                        class="form-control" placeholder="Rut/DNI" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Edad</label>
                                    <input type="number" name="edad" id="edad" value="{{ old('edad') }}"
                                        class="form-control" placeholder="Edad" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Sexo</label>
                                    <select class="form-select border border-gray p-2" aria-label="Default select example"
                                        name="sexo" id="sexo" required>
                                        <option selected disabled>Seleccione el Sexo</option>
                                        <option value="masculino">Masculino</option>
                                        <option value="femenino">Femenino</option>
                                        <option value="otro">Otro</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Estatura aproximada (cm)</label>
                                    <input type="number" name="estatura" id="estatura" value="{{ old('estatura') }}"
                                        class="form-control" placeholder="Estatura" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Peso aproximado (kg)</label>
                                    <input type="number" name="peso" id="peso" value="{{ old('peso') }}"
                                        class="form-control" placeholder="Peso" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Telefono</label>
                                    <input type="text" name="telefono_afectado" id="telefono_afectado"
                                        class="form-control" value="{{ old('telefono_afectado', '+569') }}" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Condición física aparente al momento del encuentro</label>
                                    <select class="form-select border border-gray p-2" aria-label="Default select example"
                                        name="condicion_fisica" id="condicion_fisica" required>
                                        <option selected disabled>Seleccione la Condición Física</option>
                                        <option value="Consciente">Consciente</option>
                                        <option value="Inconsciente">Inconsciente</option>
                                        <option value="Fellecido">Fellecido</option>
                                        <option value="Dolor visible">Dolor visible</option>
                                        <option value="Lesión expuesta">Lesión expuesta</option>
                                        <option value="Buen estado de salud">Buen estado de salud</option>
                                        <option value="Nevioso">Nevioso</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row p-2">
                                <h5 class="modal-title mb-2">3.- Ubicación</h5>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Lugar exacto del incidente</label>
                                    <input type="text" name="lugar_exacto" id="lugar_exacto"
                                        value="{{ old('lugar_exacto') }}" class="form-control"
                                        placeholder="Lugar exacto" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Latitud</label>
                                    <input type="text" name="latitud" id="latitud" value="{{ old('latitud') }}"
                                        class="form-control" placeholder="Latitud" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Longitud</label>
                                    <input type="text" name="longitud" id="longitud" value="{{ old('longitud') }}"
                                        class="form-control" placeholder="Longitud" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Altitud(MSNM)</label>
                                    <input type="text" name="altitud" id="altitud" value="{{ old('altitud') }}"
                                        class="form-control" placeholder="Altitud" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Ubicación de vehículo/s de rescate</label>
                                    <input type="text" name="ubicacion_vehiculo_rescate"
                                        id="ubicacion_vehiculo_rescate" value="{{ old('ubicacion_vehiculo_rescate') }}"
                                        class="form-control" placeholder="Ubicación de vehículo/s de rescate">
                                </div>
                            </div>



                            <div class="row p-2">
                                <h5 class="modal-title mb-2">4.- Situación inicial</h5>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Condición sanitaria inicial reportada</label>
                                    <textarea name="condicion_sanitaria_inicial" id="condicion_sanitaria_inicial" class="form-control"
                                        placeholder="Condición sanitaria inicial" required>{{ old('condicion_sanitaria_inicial') }}</textarea>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Evaluación EVA</label>
                                    <textarea name="eva_inicial" id="eva_inicial" class="form-control" placeholder="Evaluación EVA">{{ old('eva_inicial') }}</textarea>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Evaluación MSC</label>
                                    <textarea name="msc_inicial" id="msc_inicial" class="form-control" placeholder="Evaluación MSC">{{ old('msc_inicial') }}</textarea>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Estado emocional/psicologico</label>
                                    <select class="form-select border border-gray p-2" aria-label="Default select example"
                                        name="estado_emocional_psicologico" id="estado_emocional_psicologico" required>
                                        <option selected disabled>Seleccione el Estado Emocional/Psicologico</option>
                                        <option value="Tranquilo">Tranquilo</option>
                                        <option value="Ansioso">Ansioso</option>
                                        <option value="Alterado">Alterado</option>
                                        <option value="Desorientado">Desorientado</option>
                                    </select>
                                </div>
                            </div>


                            <div class="row p-2">
                                <h5 class="modal-title mb-2">5.- Evaluación primaria (XABCDE)</h5>
                                <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                    <label>Condición sanitaria inicial reportada</label>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Parámetro</th>
                                                <th>Observaciones</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>X - Hemorragias Externas</td>
                                                <td><input type="text" name="xabcde_x" id="xabcde_x"
                                                        class="form-control" value="{{ old('xabcde_x') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>A - Via Aérea</td>
                                                <td><input type="text" name="xabcde_a" id="xabcde_a"
                                                        class="form-control" value="{{ old('xabcde_a') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>B - Respiración</td>
                                                <td><input type="text" name="xabcde_b" id="xabcde_b"
                                                        class="form-control" value="{{ old('xabcde_b') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>C - Circulación</td>
                                                <td><input type="text" name="xabcde_c" id="xabcde_c"
                                                        class="form-control" value="{{ old('xabcde_c') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>D - Estado Neurológico</td>
                                                <td><input type="text" name="xabcde_d" id="xabcde_d"
                                                        class="form-control" value="{{ old('xabcde_d') }}">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>E - Exposición</td>
                                                <td><input type="text" name="xabcde_e" id="xabcde_e"
                                                        class="form-control" value="{{ old('xabcde_e') }}">
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row p-2">
                                <h5 class="modal-title mb-2">6.- Evaluación Secundaria (SAMPLE)</h5>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Signos y Síntomas</label>
                                    <input type="text" class="form-control" name="sample_signos_sintomas"
                                        id="sample_signos_sintomas" value="{{ old('sample_signos_sintomas') }}" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Alergias</label>
                                    <input type="text" class="form-control" name="sample_alergias"
                                        id="sample_alergias" value="{{ old('sample_alergias') }}" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Medicamentos</label>
                                    <input type="text" class="form-control" name="sample_medicamentos"
                                        id="sample_medicamentos" value="{{ old('sample_medicamentos') }}" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Patalogías previas</label>
                                    <input type="text" class="form-control" name="sample_patologias_previas"
                                        id="sample_patologias_previas" value="{{ old('sample_patologias_previas') }}"
                                        required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Ultima ingesta</label>
                                    <input type="text" class="form-control" name="sample_ultima_ingesta"
                                        id="sample_ultima_ingesta" value="{{ old('sample_ultima_ingesta') }}" required>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label>Eventos previos</label>
                                    <input type="text" class="form-control" name="sample_eventos_previos"
                                        id="sample_eventos_previos" value="{{ old('sample_eventos_previos') }}" required>
                                </div>
                            </div>


                            <div class="row p-2">
                                <h5 class="modal-title mb-2">7.- Plan de Acción y Ejecución</h5>
                                <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                    <label>Resumen de acciones tomadas</label>
                                    <textarea name="resumen_acciones" id="resumen_acciones" class="form-control"
                                        placeholder="Resumen de acciones tomadas" required>{{ old('resumen_acciones') }}</textarea>
                                </div>
                                <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                    <label>Material y equipo utilizado</label>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="material_equipo_bendas" name="material_equipo_utilizado[]"
                                                    value="Bendas">
                                                <label class="form-check-label">Bendas</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="material_equipo_casco" name="material_equipo_utilizado[]"
                                                    value="Casco">
                                                <label class="form-check-label">Casco</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="material_equipo_ferula" name="material_equipo_utilizado[]"
                                                    value="Férula">
                                                <label class="form-check-label">Férula</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="material_equipo_arnes" name="material_equipo_utilizado[]"
                                                    value="Arnés">
                                                <label class="form-check-label">Arnés</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="material_equipo_botiquin" name="material_equipo_utilizado[]"
                                                    value="Botiquín">
                                                <label class="form-check-label">Botiquín</label>
                                            </div>
                                        </div>
                                        <div class="col-lg-2 col-md-2 col-sm-12">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="material_equipo_otros_check" name="material_equipo_utilizado[]"
                                                    value="Otros">
                                                <label class="form-check-label">Otros:</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12">
                                            <input type="text" class="form-control" name="material_equipo_otros"
                                                id="material_equipo_otros" value="{{ old('material_equipo_otros') }}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                            <label>Medicamentos administrados(Medicamento-Dosis-Hora)</label>
                                            <textarea name="medicamentos_administrados" id="medicamentos_administrados" class="form-control"
                                                placeholder="Medicamentos administrados">{{ old('medicamentos_administrados') }}</textarea>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Método de evacuación</label>
                                            <select class="form-select border border-gray p-2"
                                                aria-label="Default select example" name="metodo_evacuacion"
                                                id="metodo_evacuacion">
                                                <option selected>Seleccione el Método de Evacuación</option>
                                                <option value="A pie">A pie</option>
                                                <option value="Camilla">Camilla</option>
                                                <option value="Vehículo 4x4">Vehículo 4x4</option>
                                                <option value="Helicóptero">Helicóptero</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Destino final del paciente</label>
                                            <select class="form-select border border-gray p-2"
                                                aria-label="Default select example" name="destino_final_paciente"
                                                id="destino_final_paciente">
                                                <option selected>Seleccione el Destino Final del Paciente</option>
                                                <option value="Ambulancia">Ambulancia</option>
                                                <option value="Traslado particular">Traslado particular</option>
                                                <option value="Traslado a comisaría por servicio médico legal">Traslado a
                                                    comisaría por servicio médico legal</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row p-2">
                                        <h5 class="modal-title mb-2">8.- Bitacora</h5>
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                            <label>Emergencia Presencial</label>
                                            <textarea name="bitacora_emergencia_presencial" id="bitacora_emergencia_presencial" class="form-control"
                                                placeholder="Emergencia Presencial" required>{{ old('bitacora_emergencia_presencial') }}</textarea>
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <label>Salida del Cuartel/Base</label>
                                            <input class="form-control" type="time" name="bitacora_salida_cuartel"
                                                id="bitacora_salida_cuartel" value="{{ old('bitacora_salida_cuartel') }}"
                                                required>
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <label>Llegada al punto de acceso</label>
                                            <input class="form-control" type="time" name="bitacora_llegada_acceso"
                                                id="bitacora_llegada_acceso" value="{{ old('bitacora_llegada_acceso') }}"
                                                required>
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <label>Contacto con el grupo</label>
                                            <input class="form-control" type="time" name="bitacora_contacto_grupo"
                                                id="bitacora_contacto_grupo" value="{{ old('bitacora_contacto_grupo') }}"
                                                required>
                                        </div>
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                            <label>Evaluacion sanitaria inicial</label>
                                            <textarea name="bitacora_evaluacion_sanitaria_inicial" id="bitacora_evaluacion_sanitaria_inicial"
                                                class="form-control" placeholder="Evaluación sanitaria inicial">{{ old('bitacora_evaluacion_sanitaria_inicial') }}</textarea>
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <label>Inicio del descenso</label>
                                            <input class="form-control" type="time" name="bitacora_inicio_descenso"
                                                id="bitacora_inicio_descenso"
                                                value="{{ old('bitacora_inicio_descenso') }}" required>
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <label>Llegada al punto de extracción</label>
                                            <input class="form-control" type="time" name="bitacora_llegada_extraccion"
                                                id="bitacora_llegada_extraccion"
                                                value="{{ old('bitacora_llegada_extraccion') }}" required>
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <label>Traslado al destino final</label>
                                            <input class="form-control" type="time"
                                                name="bitacora_traslado_destino_final"
                                                id="bitacora_traslado_destino_final"
                                                value="{{ old('bitacora_traslado_destino_final') }}" required>
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <label>Regreso al cuartel/base</label>
                                            <input class="form-control" type="time" name="bitacora_regreso_cuartel"
                                                id="bitacora_regreso_cuartel"
                                                value="{{ old('bitacora_regreso_cuartel') }}" required>
                                        </div>
                                    </div>

                                    <div class="row p-2">
                                        <h5 class="modal-title mb-2">9.- Equipo Interviniente</h5>
                                        <div class="mb-3 col-lg-8 col-md-8 col-sm-12">
                                            <label>Voluntarios</label>
                                            <div id="voluntarySelectContainerVolunteers">
                                                <div class="row g-2 align-items-end voluntary-select-item">
                                                    <div class="col-12">
                                                        <select class="form-select form-select-sm border border-gray p-2"
                                                            name="voluntarios[]" id="voluntario_0">
                                                            <option selected value="">Seleccione voluntario
                                                            </option>
                                                            @foreach ($voluntaries as $voluntary)
                                                                <option value="{{ $voluntary->id }}">
                                                                    {{ $voluntary->name }} {{ $voluntary->lastname }} - {{ $voluntary->type == 'A' ? 'Aspirante' : 'Voluntario' }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <div class="d-grid">
                                                <label>Acción</label>
                                                <button type="button" class="btn btn-dark" id="btnAddVolunteer">
                                                    <i class="fa-solid fa-circle-plus"></i> Agregar voluntario
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row p-2">
                                        <h5 class="modal-title mb-2">10.- Participación de otras instituciones</h5>
                                        <div class="mb-3 col-lg-8 col-md-8 col-sm-12">
                                            <label>Institución</label>
                                            <div id="institutionSelectContainer">
                                                <div class="row g-2 align-items-end voluntary-select-item">
                                                    <div class="col-12">
                                                        <select class="form-select form-select-sm border border-gray p-2"
                                                            name="instituciones[]" id="institucion_0">
                                                            <option selected value="">Seleccione institución</option>
                                                            <option value="GOPE">GOPE</option>
                                                            <option value="Carabineros">Carabineros</option>
                                                            <option value="UNIREM">UNIREM</option>
                                                            <option value="Bomberos">Bomberos</option>
                                                            <option value="Conaf">Conaf</option>
                                                            <option value="Municipal">Municipal</option>
                                                            <option value="Rio Montaña">Rio Montaña</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                                            <div class="d-grid">
                                                <label>Acción</label>
                                                <button type="button" class="btn btn-dark" id="btnAddInstitution">
                                                    <i class="fa-solid fa-circle-plus"></i> Agregar institución
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row p-2">
                                        <h5 class="modal-title mb-2">11.- Descripción de la emergencia</h5>
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                            <textarea name="descripcion_emergencia" id="descripcion_emergencia" class="form-control"
                                                placeholder="Descripción de la emergencia" required>{{ old('descripcion_emergencia') }}</textarea>
                                        </div>
                                    </div>

                                    <div class="row p-2">
                                        <h5 class="modal-title mb-2">12.- Observaciones generales y recomendaciones</h5>
                                        <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                                            <textarea name="observaciones_generales" id="observaciones_generales" class="form-control"
                                                placeholder="Observaciones generales y recomendaciones">{{ old('observaciones_generales') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i>
                                Guardar Rescate</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('script')
        <script>
            $(document).ready(function() {
                let volunteerSelectIndex = 1;
                let institutionSelectIndex = 1;

                const voluntaryOptionsHtml = `
                <option selected value="">Seleccione voluntario</option>
                @foreach ($voluntaries as $voluntary)
                    <option value="{{ $voluntary->id }}">{{ $voluntary->name }} {{ $voluntary->lastname }}</option>
                @endforeach
            `;

                const institutionOptionsHtml = `
                <option selected value="">Seleccione institución</option>
                <option value="GOPE">GOPE</option>
                <option value="Carabineros">Carabineros</option>
                <option value="UNIREM">UNIREM</option>
                <option value="Bomberos">Bomberos</option>
                <option value="Conaf">Conaf</option>
                <option value="Municipal">Municipal</option>
                <option value="Rio Montaña">Rio Montaña</option>
            `;

                $('#btnAddVolunteer').on('click', function() {
                    const selectId = `voluntario_${volunteerSelectIndex++}`;
                    const item = `
                    <div class="row g-2 align-items-end voluntary-select-item mt-2">
                        <div class="col-12 col-md-10">
                            <select class="form-select form-select-sm border border-gray p-2" name="voluntarios[]" id="${selectId}">
                                ${voluntaryOptionsHtml}
                            </select>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="d-grid">
                                <button type="button" class="btn btn-outline-danger btn-sm btnRemoveSelect">Quitar</button>
                            </div>
                        </div>
                    </div>
                `;
                    $('#voluntarySelectContainerVolunteers').append(item);
                });

                $('#btnAddInstitution').on('click', function() {
                    const selectId = `institucion_${institutionSelectIndex++}`;
                    const item = `
                    <div class="row g-2 align-items-end voluntary-select-item mt-2">
                        <div class="col-12 col-md-10">
                            <select class="form-select form-select-sm border border-gray p-2" name="instituciones[]" id="${selectId}">
                                ${institutionOptionsHtml}
                            </select>
                        </div>
                        <div class="col-12 col-md-2">
                            <div class="d-grid">
                                <button type="button" class="btn btn-outline-danger btn-sm btnRemoveSelect">Quitar</button>
                            </div>
                        </div>
                    </div>
                `;
                    $('#institutionSelectContainer').append(item);
                });

                $(document).on('click', '.btnRemoveSelect', function() {
                    $(this).closest('.voluntary-select-item').remove();
                });

            });

            $('#formRescue').submit(function(e) {
                e.preventDefault();
                let formData = $(this).serialize();

                $.ajax({
                    url: '{{ route('registro-rescate.store') }}',
                    type: 'POST',
                    data: formData,
                    success: function(response) {
                        // Mostrar mensaje desde el backend
                        Swal.fire({
                            icon: response.status === 'success' ? 'success' : 'warning',
                            title: response.status === 'success' ? 'Éxito' : 'Aviso',
                            text: response.message,
                        });

                        if (response.status === 'success') {
                            if (response.download_url) {
                                window.open(response.download_url, '_blank');
                            }
                            $('#formRescue')[0].reset();
                        }
                    },
                    error: function(xhr) {
                        let msg = 'Error al registrar rescate';
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg += ': ' + xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: msg,
                        });
                        $('#CreateModal').modal('hide');
                    }
                });
            });
        </script>
    @endpush
