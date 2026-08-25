@extends('layout.main')

@section('title', 'Registro de Rescate')

@section('content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 rescue-form-hero">
                        <div class="bg-gradient-dark border-radius-lg p-4">
                            <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
                                <div>
                                    <span class="rescue-eyebrow">SISTEMA DE COMANDO DE INCIDENTES</span>
                                    <h4 class="text-white mb-1"><i class="fa-solid fa-shield-halved me-2"></i>Ficha operativa de rescate</h4>
                                    <p class="mb-0">Registro clínico, operacional y de cierre para trazabilidad institucional.</p>
                                </div>
                                <div class="rescue-form-status"><i class="fa-regular fa-pen-to-square"></i><span>Borrador en curso<small>Complete los campos obligatorios</small></span></div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <form id="formRescue" class="form" method="POST" novalidate>
                            @csrf
                            <div class="rescue-wizard" id="rescueWizard">
                                <div class="rescue-wizard__top">
                                    <div><span class="rescue-wizard__counter" id="rescueWizardCounter">Paso 1</span><h5 id="rescueWizardTitle">Información del incidente</h5></div>
                                    <strong id="rescueWizardPercent">0%</strong>
                                </div>
                                <div class="rescue-wizard__progress"><span id="rescueWizardProgress"></span></div>
                                <div class="rescue-wizard__steps" id="rescueWizardIndicators" aria-label="Progreso del formulario"></div>
                            </div>
                            <div id="rescueWizardStage"></div>
                            <div class="row p-2 rescue-command-section">
                                <h5 class="modal-title mb-2">0.- Comando y organización del incidente</h5>
                                <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                                    <label for="incident_code">Código del incidente</label>
                                    <input type="text" name="incident_code" id="incident_code" value="{{ old('incident_code') }}"
                                        class="form-control" placeholder="Automático si se deja vacío" maxlength="40">
                                </div>
                                <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                                    <label for="commandante_incidente">Comandante del incidente <span class="text-danger">*</span></label>
                                    <input type="text" name="commandante_incidente" id="commandante_incidente"
                                        value="{{ old('commandante_incidente', trim((auth()->user()->name ?? '') . ' ' . (auth()->user()->lastname ?? ''))) }}"
                                        class="form-control" placeholder="Nombre y cargo" required maxlength="255">
                                </div>
                                <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                                    <label for="nivel_activacion">Nivel de activación <span class="text-danger">*</span></label>
                                    <select name="nivel_activacion" id="nivel_activacion" class="form-select" required>
                                        <option value="">Seleccione el nivel</option>
                                        <option value="Monitoreo">Monitoreo</option>
                                        <option value="Parcial">Activación parcial</option>
                                        <option value="Total">Activación total</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label for="puesto_comando">Puesto de comando</label>
                                    <input type="text" name="puesto_comando" id="puesto_comando" value="{{ old('puesto_comando') }}"
                                        class="form-control" placeholder="Base, acceso o coordenadas">
                                </div>
                                <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                    <label for="zona_operaciones">Zonificación operacional</label>
                                    <input type="text" name="zona_operaciones" id="zona_operaciones" value="{{ old('zona_operaciones') }}"
                                        class="form-control" placeholder="Zona caliente, tibia, segura y accesos">
                                </div>
                                <div class="mb-3 col-lg-6 col-md-12 col-sm-12">
                                    <label for="objetivos_incidente">Objetivos operacionales <span class="text-danger">*</span></label>
                                    <textarea name="objetivos_incidente" id="objetivos_incidente" class="form-control" rows="3"
                                        placeholder="Objetivos concretos y prioridades del período operacional" required>{{ old('objetivos_incidente') }}</textarea>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-12 col-sm-12">
                                    <label for="riesgos_operacionales">Riesgos y medidas de control <span class="text-danger">*</span></label>
                                    <textarea name="riesgos_operacionales" id="riesgos_operacionales" class="form-control" rows="3"
                                        placeholder="Terreno, clima, exposición, EPP y medidas preventivas" required>{{ old('riesgos_operacionales') }}</textarea>
                                </div>
                                <div class="mb-3 col-lg-6 col-md-12 col-sm-12">
                                    <label for="plan_comunicaciones">Plan de comunicaciones</label>
                                    <textarea name="plan_comunicaciones" id="plan_comunicaciones" class="form-control" rows="2"
                                        placeholder="Canal, frecuencia, indicativos y medio alternativo">{{ old('plan_comunicaciones') }}</textarea>
                                </div>
                                <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                                    <label for="estado_cierre">Estado al cierre <span class="text-danger">*</span></label>
                                    <select name="estado_cierre" id="estado_cierre" class="form-select" required>
                                        <option value="">Seleccione estado</option>
                                        <option value="Controlado">Controlado</option>
                                        <option value="Cerrado">Cerrado</option>
                                        <option value="Derivado">Derivado a otra institución</option>
                                        <option value="Suspendido">Suspendido</option>
                                    </select>
                                </div>
                                <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                                    <label for="hora_desmovilizacion">Hora de desmovilización</label>
                                    <input type="time" name="hora_desmovilizacion" id="hora_desmovilizacion"
                                        value="{{ old('hora_desmovilizacion') }}" class="form-control">
                                </div>
                                <div class="mb-0 col-12">
                                    <label for="lecciones_aprendidas">Lecciones aprendidas y acciones de mejora</label>
                                    <textarea name="lecciones_aprendidas" id="lecciones_aprendidas" class="form-control" rows="3"
                                        placeholder="Aspectos que funcionaron, brechas detectadas y acciones de seguimiento">{{ old('lecciones_aprendidas') }}</textarea>
                                </div>
                            </div>
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

                            <div class="rescue-submit-bar">
                                <div><i class="fa-solid fa-circle-info"></i><span>Al finalizar se generará automáticamente el informe PDF institucional.</span></div>
                                <div class="rescue-wizard__actions">
                                    <button type="button" class="btn btn-outline-secondary" id="rescueWizardPrevious"><i class="fa-solid fa-arrow-left me-2"></i>Anterior</button>
                                    <button type="button" class="btn btn-dark" id="rescueWizardNext">Siguiente<i class="fa-solid fa-arrow-right ms-2"></i></button>
                                    <button type="submit" class="btn btn-dark d-none" id="btnSubmitRescue"><i class="fa-solid fa-file-circle-check me-2"></i>Guardar y generar informe</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('styles')
        <style>
            .rescue-form-hero p{color:#c8dce4;font-size:.78rem}.rescue-eyebrow{display:block;margin-bottom:7px;color:#ff8b63;font-size:.62rem;font-weight:800;letter-spacing:.13em}.rescue-form-status{display:flex;align-items:center;gap:10px;padding:10px 14px;border:1px solid rgba(255,255,255,.18);border-radius:10px;color:#fff;background:rgba(255,255,255,.08);font-size:.73rem;font-weight:700}.rescue-form-status i{color:#ff8b63;font-size:1.05rem}.rescue-form-status span{display:flex;flex-direction:column}.rescue-form-status small{margin-top:2px;color:#bcd0d8;font-size:.59rem;font-weight:500}
            #formRescue{counter-reset:rescue-section}#formRescue>.row.p-2{position:relative;margin:0 0 18px!important;padding:24px!important;border:1px solid #dbe6ea;border-radius:13px;background:#fff;box-shadow:0 4px 16px rgba(13,58,74,.035)}#formRescue>.row.p-2>h5{display:flex;align-items:center;margin-bottom:22px!important;padding-bottom:15px;border-bottom:1px solid #e5ecef;color:#173744;font-size:.95rem;font-weight:750}#formRescue>.row.p-2>h5:before{content:'';display:block;width:4px;height:22px;margin-right:10px;border-radius:4px;background:#ea4e1a}.rescue-command-section{border-top:3px solid #176985!important;background:linear-gradient(180deg,#fafdfe,#fff 90px)!important}#formRescue label{margin-bottom:7px;color:#3e5965;font-size:.72rem;font-weight:700}#formRescue textarea.form-control{min-height:88px;resize:vertical}#formRescue .table{overflow:hidden;border:1px solid #dde7eb;border-radius:9px}#formRescue .table td:first-child{width:28%;color:#214654;font-weight:700}#formRescue .form-check{height:100%;padding:10px 10px 10px 34px;border:1px solid #e0e9ec;border-radius:8px;background:#f8fafb}.rescue-submit-bar{position:sticky;z-index:5;bottom:10px;display:flex;align-items:center;justify-content:space-between;gap:20px;margin-top:24px;padding:14px 18px;border:1px solid #cbdce2;border-radius:12px;background:rgba(255,255,255,.94);box-shadow:0 12px 35px rgba(5,40,54,.16);backdrop-filter:blur(12px)}.rescue-submit-bar>div{display:flex;align-items:center;gap:9px;color:#607983;font-size:.7rem}.rescue-submit-bar>div i{color:#176985}.rescue-submit-bar .btn{padding:11px 17px}
            .rescue-wizard{margin-bottom:20px;padding:18px 20px;border:1px solid #d6e3e8;border-radius:13px;background:#fff;box-shadow:0 5px 18px rgba(12,57,73,.05)}.rescue-wizard__top{display:flex;align-items:flex-end;justify-content:space-between;gap:15px}.rescue-wizard__counter{color:#ea4e1a;font-size:.62rem;font-weight:800;letter-spacing:.1em;text-transform:uppercase}.rescue-wizard__top h5{margin:3px 0 0;color:#173744;font-size:1rem}.rescue-wizard__top>strong{color:#176985;font-size:.78rem}.rescue-wizard__progress{height:6px;margin:13px 0;border-radius:10px;background:#e5edf0}.rescue-wizard__progress span{display:block;width:0;height:100%;border-radius:10px;background:linear-gradient(90deg,#176985,#ea4e1a);transition:width .25s ease}.rescue-wizard__steps{display:flex;gap:6px;overflow-x:auto;padding-bottom:2px;scrollbar-width:thin}.rescue-wizard__indicator{display:grid;flex:0 0 26px;height:26px;place-items:center;border:1px solid #d6e2e6;border-radius:50%;background:#f6f9fa;color:#78909a;font-size:.61rem;font-weight:800}.rescue-wizard__indicator.is-current{border-color:#176985;background:#176985;color:#fff}.rescue-wizard__indicator.is-complete{border-color:#add6c0;background:#e7f6ed;color:#16824a}.rescue-wizard-step{display:none!important;position:relative;margin:0!important;padding:24px!important;border:1px solid #dbe6ea;border-radius:13px;background:#fff;box-shadow:0 4px 16px rgba(13,58,74,.035)}.rescue-wizard-step.is-active{display:flex!important}.rescue-wizard-step>h5{display:flex;align-items:center;margin-bottom:22px!important;padding-bottom:15px;border-bottom:1px solid #e5ecef;color:#173744;font-size:.95rem;font-weight:750}.rescue-wizard-step>h5:before{content:'';display:block;width:4px;height:22px;margin-right:10px;border-radius:4px;background:#ea4e1a}.rescue-wizard__actions{display:flex!important;gap:8px}.rescue-wizard__actions .btn i{color:inherit}.rescue-wizard-step.was-validated :invalid{border-color:#dc3545!important}.rescue-wizard-step.was-validated :valid{border-color:#198754!important}
            @media(max-width:767.98px){#formRescue>.row.p-2,.rescue-wizard-step{padding:18px!important}.rescue-submit-bar{align-items:stretch;flex-direction:column}.rescue-submit-bar .btn{flex:1}.rescue-wizard__actions{width:100%}.rescue-form-status{display:none}}
        </style>
    @endpush

    @push('script')
        <script>
            let rescueWizardSteps = $();
            let rescueWizardIndex = 0;

            function initializeRescueWizard() {
                const seen = new Set();
                const steps = [];
                $('#formRescue h5.modal-title').each(function() {
                    const step = $(this).closest('.row.p-2')[0];
                    if (step && !seen.has(step)) {
                        seen.add(step);
                        steps.push(step);
                    }
                });
                rescueWizardSteps = $(steps);
                rescueWizardSteps.each(function(index) {
                    $(this).addClass('rescue-wizard-step').attr('data-wizard-step', index).detach().appendTo('#rescueWizardStage');
                    $('#rescueWizardIndicators').append('<span class="rescue-wizard__indicator" data-step="' + index + '">' + (index + 1) + '</span>');
                });
                showRescueWizardStep(0, false);
            }

            function rescueWizardStepTitle(index) {
                return rescueWizardSteps.eq(index).find('> h5').first().text().trim().replace(/^\d+\.-\s*/, '');
            }

            function showRescueWizardStep(index, scroll = true) {
                if (!rescueWizardSteps.length) return;
                rescueWizardIndex = Math.max(0, Math.min(index, rescueWizardSteps.length - 1));
                rescueWizardSteps.removeClass('is-active').eq(rescueWizardIndex).addClass('is-active');
                const percent = Math.round(((rescueWizardIndex + 1) / rescueWizardSteps.length) * 100);
                $('#rescueWizardCounter').text('Paso ' + (rescueWizardIndex + 1) + ' de ' + rescueWizardSteps.length);
                $('#rescueWizardTitle').text(rescueWizardStepTitle(rescueWizardIndex));
                $('#rescueWizardPercent').text(percent + '%');
                $('#rescueWizardProgress').css('width', percent + '%');
                $('.rescue-wizard__indicator').removeClass('is-current is-complete').each(function(i) {
                    $(this).toggleClass('is-current', i === rescueWizardIndex).toggleClass('is-complete', i < rescueWizardIndex);
                });
                $('#rescueWizardPrevious').prop('disabled', rescueWizardIndex === 0);
                const isLast = rescueWizardIndex === rescueWizardSteps.length - 1;
                $('#rescueWizardNext').toggleClass('d-none', isLast);
                $('#btnSubmitRescue').toggleClass('d-none', !isLast);
                if (scroll) document.getElementById('rescueWizard')?.scrollIntoView({behavior: 'smooth', block: 'start'});
            }

            function validateCurrentRescueStep() {
                const step = rescueWizardSteps.eq(rescueWizardIndex);
                let firstInvalid = null;
                step.find(':input[required]').each(function() {
                    if (!this.checkValidity() && !firstInvalid) firstInvalid = this;
                });
                step.toggleClass('was-validated', Boolean(firstInvalid));
                if (firstInvalid) {
                    firstInvalid.reportValidity();
                    firstInvalid.focus();
                    return false;
                }
                return true;
            }

            $(document).ready(function() {
                let volunteerSelectIndex = 1;
                let institutionSelectIndex = 1;
                initializeRescueWizard();
                $('#rescueWizardNext').on('click', function() {
                    if (validateCurrentRescueStep()) showRescueWizardStep(rescueWizardIndex + 1);
                });
                $('#rescueWizardPrevious').on('click', function() {
                    showRescueWizardStep(rescueWizardIndex - 1);
                });

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
                $('#formRescue .is-invalid').removeClass('is-invalid');
                let formData = $(this).serialize();
                const button = $('#btnSubmitRescue');
                button.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Generando informe...');

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
                            rescueWizardSteps.removeClass('was-validated');
                            showRescueWizardStep(0);
                        }
                    },
                    error: function(xhr) {
                        let msg = 'No fue posible registrar el rescate.';
                        const errors = xhr.responseJSON?.errors || {};
                        const firstField = Object.keys(errors)[0];
                        if (firstField) {
                            const field = $('#formRescue [name="' + firstField + '"], #formRescue [name="' + firstField.replace('.0', '[]') + '"]').first();
                            field.addClass('is-invalid');
                            const failedStep = Number(field.closest('.rescue-wizard-step').attr('data-wizard-step'));
                            if (!Number.isNaN(failedStep)) showRescueWizardStep(failedStep);
                            field[0]?.scrollIntoView({behavior: 'smooth', block: 'center'});
                            msg = errors[firstField][0];
                        }
                        if (xhr.responseJSON && xhr.responseJSON.message) {
                            msg = firstField ? msg : xhr.responseJSON.message;
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: msg,
                        });
                    },
                    complete: function() {
                        button.prop('disabled', false).html('<i class="fa-solid fa-file-circle-check me-2"></i>Guardar y generar informe');
                    }
                });
            });
        </script>
    @endpush
