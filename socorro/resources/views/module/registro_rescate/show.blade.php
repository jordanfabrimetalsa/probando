<div class="modal fade rescue-detail-modal" id="ShowModal" tabindex="-1" aria-labelledby="ShowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
      <div class="modal-content modal-extra-background">
        <div class="modal-header rescue-detail__header">
          <div><span>REGISTRO OPERACIONAL</span><h5 class="modal-title" id="ShowModalLabel"><i class="fa-solid fa-shield-halved"></i> Detalle del rescate</h5></div>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="rescue-detail__hero">
            <div>
                <span class="rescue-detail__code" id="incident_code_show">CSA</span>
                <h3 id="incident_title_show">Incidente de rescate</h3>
                <p><i class="fa-solid fa-location-dot"></i> <span id="incident_location_show">Ubicación no informada</span></p>
            </div>
            <div class="rescue-detail__hero-meta">
                <span><small>FECHA</small><strong id="incident_date_show">—</strong></span>
                <span><small>NIVEL</small><strong id="incident_level_show">—</strong></span>
                <span><small>ESTADO</small><strong id="incident_status_show">—</strong></span>
            </div>
        </div>
        <div class="modal-body rescue-detail__body">
          <form id="formRescueUpdate" class="form" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="id_show" id="id_show">

            <div class="border mb-4 rescue-detail__command">
                <div class="row p-2">
                    <h5 class="modal-title mb-2">Comando del incidente</h5>
                    <div class="mb-3 col-lg-4 col-md-6 col-sm-12"><label>Comandante</label><input id="commandante_incidente_show" class="form-control" readonly></div>
                    <div class="mb-3 col-lg-4 col-md-6 col-sm-12"><label>Puesto de comando</label><input id="puesto_comando_show" class="form-control" readonly></div>
                    <div class="mb-3 col-lg-4 col-md-6 col-sm-12"><label>Desmovilización</label><input id="hora_desmovilizacion_show" class="form-control" readonly></div>
                    <div class="mb-3 col-lg-6 col-md-12 col-sm-12"><label>Objetivos operacionales</label><textarea id="objetivos_incidente_show" class="form-control" readonly></textarea></div>
                    <div class="mb-3 col-lg-6 col-md-12 col-sm-12"><label>Riesgos y controles</label><textarea id="riesgos_operacionales_show" class="form-control" readonly></textarea></div>
                    <div class="mb-3 col-lg-6 col-md-12 col-sm-12"><label>Plan de comunicaciones</label><textarea id="plan_comunicaciones_show" class="form-control" readonly></textarea></div>
                    <div class="mb-3 col-lg-6 col-md-12 col-sm-12"><label>Zonificación operacional</label><textarea id="zona_operaciones_show" class="form-control" readonly></textarea></div>
                </div>
            </div>

            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2">1.- Datos generales del operativo</h5>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Fecha del Operativo</label>
                        <input type="date" name="fecha_operativo_show" id="fecha_operativo_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Hora del llamado de emergencia</label>
                        <input type="time" name="hora_llamado_show" id="hora_llamado_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Lugar de Emergencia</label>
                        <input type="text" name="lugar_show" id="lugar_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Tipo de Emergencia</label>
                        <input type="text" name="tipo_emergencia_show" id="tipo_emergencia_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Nombre de quien realiza el llamado</label>
                        <input type="text" name="nombre_llamado_show" id="nombre_llamado_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Teléfono</label>
                        <input type="text" name="telefono_show" id="telefono_show" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2">2.- Información de la persona lesionada/afectada</h5>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Nombre Completo</label>
                        <input type="text" name="nombre_completo_show" id="nombre_completo_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>RUT/DNI</label>
                        <input type="text" name="rut_dni_show" id="rut_dni_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Edad</label>
                        <input type="number" name="edad_show" id="edad_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Sexo</label>
                        <input type="text" name="sexo_show" id="sexo_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Estatura aproximada (cm)</label>
                        <input type="number" name="estatura_show" id="estatura_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Peso aproximado (kg)</label>
                        <input type="number" name="peso_show" id="peso_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Teléfono</label>
                        <input type="text" name="telefono_afectado_show" id="telefono_afectado_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Condición física aparente</label>
                        <input type="text" name="condicion_fisica_show" id="condicion_fisica_show" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2">3.- Ubicación</h5>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Lugar exacto del incidente</label>
                        <input type="text" name="lugar_exacto_show" id="lugar_exacto_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Latitud</label>
                        <input type="text" name="latitud_show" id="latitud_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Longitud</label>
                        <input type="text" name="longitud_show" id="longitud_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Altitud (MSNMM)</label>
                        <input type="text" name="altitud_show" id="altitud_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                        <label>Ubicación de vehículo/s de rescate</label>
                        <input type="text" name="ubicacion_vehiculo_rescate_show" id="ubicacion_vehiculo_rescate_show" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2">4.- Situación inicial</h5>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Condición sanitaria inicial</label>
                        <textarea name="condicion_sanitaria_inicial_show" id="condicion_sanitaria_inicial_show" class="form-control" readonly></textarea>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Evaluación EVA</label>
                        <textarea name="eva_inicial_show" id="eva_inicial_show" class="form-control" readonly></textarea>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Evaluación MSC</label>
                        <textarea name="msc_inicial_show" id="msc_inicial_show" class="form-control" readonly></textarea>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Estado emocional/psicológico</label>
                        <input type="text" name="estado_emocional_psicologico_show" id="estado_emocional_psicologico_show" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2">5.- Evaluación primaria (XABCDE)</h5>
                    <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
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
                                    <td><input type="text" name="xabcde_x_show" id="xabcde_x_show" class="form-control" readonly></td>
                                </tr>
                                <tr>
                                    <td>A - Via Aérea</td>
                                    <td><input type="text" name="xabcde_a_show" id="xabcde_a_show" class="form-control" readonly></td>
                                </tr>
                                <tr>
                                    <td>B - Respiración</td>
                                    <td><input type="text" name="xabcde_b_show" id="xabcde_b_show" class="form-control" readonly></td>
                                </tr>
                                <tr>
                                    <td>C - Circulación</td>
                                    <td><input type="text" name="xabcde_c_show" id="xabcde_c_show" class="form-control" readonly></td>
                                </tr>
                                <tr>
                                    <td>D - Estado Neurológico</td>
                                    <td><input type="text" name="xabcde_d_show" id="xabcde_d_show" class="form-control" readonly></td>
                                </tr>
                                <tr>
                                    <td>E - Exposición</td>
                                    <td><input type="text" name="xabcde_e_show" id="xabcde_e_show" class="form-control" readonly></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2">6.- Evaluación Secundaria (SAMPLE)</h5>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Signos y Síntomas</label>
                        <input type="text" name="sample_signos_sintomas_show" id="sample_signos_sintomas_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Alergias</label>
                        <input type="text" name="sample_alergias_show" id="sample_alergias_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Medicamentos</label>
                        <input type="text" name="sample_medicamentos_show" id="sample_medicamentos_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Patologías previas</label>
                        <input type="text" name="sample_patologias_previas_show" id="sample_patologias_previas_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Última ingesta</label>
                        <input type="text" name="sample_ultima_ingesta_show" id="sample_ultima_ingesta_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Eventos previos</label>
                        <input type="text" name="sample_eventos_previos_show" id="sample_eventos_previos_show" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2">7.- Plan de Acción y Ejecución</h5>
                    <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                        <label>Resumen de acciones tomadas</label>
                        <textarea name="resumen_acciones_show" id="resumen_acciones_show" class="form-control" readonly></textarea>
                    </div>
                    <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                        <label>Medicamentos administrados</label>
                        <textarea name="medicamentos_administrados_show" id="medicamentos_administrados_show" class="form-control" readonly></textarea>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Método de evacuación</label>
                        <input type="text" name="metodo_evacuacion_show" id="metodo_evacuacion_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                        <label>Destino final del paciente</label>
                        <input type="text" name="destino_final_paciente_show" id="destino_final_paciente_show" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2">8.- Bitácora</h5>
                    <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                        <label>Emergencia Presencial</label>
                        <textarea name="bitacora_emergencia_presencial_show" id="bitacora_emergencia_presencial_show" class="form-control" readonly></textarea>
                    </div>
                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                        <label>Salida del Cuartel/Base</label>
                        <input type="time" name="bitacora_salida_cuartel_show" id="bitacora_salida_cuartel_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                        <label>Llegada al punto de acceso</label>
                        <input type="time" name="bitacora_llegada_acceso_show" id="bitacora_llegada_acceso_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                        <label>Contacto con el grupo</label>
                        <input type="time" name="bitacora_contacto_grupo_show" id="bitacora_contacto_grupo_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                        <label>Evaluación sanitaria inicial</label>
                        <textarea name="bitacora_evaluacion_sanitaria_inicial_show" id="bitacora_evaluacion_sanitaria_inicial_show" class="form-control" readonly></textarea>
                    </div>
                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                        <label>Inicio del descenso</label>
                        <input type="time" name="bitacora_inicio_descenso_show" id="bitacora_inicio_descenso_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                        <label>Llegada al punto de extracción</label>
                        <input type="time" name="bitacora_llegada_extraccion_show" id="bitacora_llegada_extraccion_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                        <label>Traslado al destino final</label>
                        <input type="time" name="bitacora_traslado_destino_final_show" id="bitacora_traslado_destino_final_show" class="form-control" readonly>
                    </div>
                    <div class="mb-3 col-lg-4 col-md-4 col-sm-12">
                        <label>Regreso al cuartel/base</label>
                        <input type="time" name="bitacora_regreso_cuartel_show" id="bitacora_regreso_cuartel_show" class="form-control" readonly>
                    </div>
                </div>
            </div>

            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2">11.- Descripción de la emergencia</h5>
                    <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                        <textarea name="descripcion_emergencia_show" id="descripcion_emergencia_show" class="form-control" readonly></textarea>
                    </div>
                </div>
            </div>

            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2">12.- Observaciones generales y recomendaciones</h5>
                    <div class="mb-3 col-lg-12 col-md-12 col-sm-12">
                        <textarea name="observaciones_generales_show" id="observaciones_generales_show" class="form-control" readonly></textarea>
                    </div>
                </div>
            </div>
            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2">Recursos y coordinación</h5>
                    <div class="mb-3 col-lg-4 col-md-12"><label>Equipo interviniente</label><div class="rescue-detail__pills" id="rescue_volunteers_show"></div></div>
                    <div class="mb-3 col-lg-4 col-md-12"><label>Instituciones participantes</label><div class="rescue-detail__pills" id="rescue_institutions_show"></div></div>
                    <div class="mb-3 col-lg-4 col-md-12"><label>Material utilizado</label><div class="rescue-detail__pills" id="rescue_materials_show"></div></div>
                    <div class="mb-3 col-12"><label>Lecciones aprendidas</label><div class="rescue-detail__narrative" id="lecciones_aprendidas_show">No informado</div></div>
                </div>
            </div>
          </form>
        </div>
        <div class="modal-footer rescue-detail__footer">
          <span><i class="fa-solid fa-mountain-sun"></i> Cuerpo de Socorro Andino de Chile</span>
          <a href="#" target="_blank" class="btn btn-dark" id="rescuePdfLink"><i class="fa-solid fa-file-pdf me-2"></i>Abrir informe PDF</a>
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>

<style>
.rescue-detail-modal .modal-dialog{height:calc(100vh - 2rem);max-height:calc(100vh - 2rem);margin-top:1rem;margin-bottom:1rem}.rescue-detail-modal .modal-content{height:100%;border:0!important;border-radius:18px!important}.rescue-detail__header{padding:16px 22px!important}.rescue-detail__header>div>span{color:#ea4e1a;font-size:.58rem;font-weight:800;letter-spacing:.12em}.rescue-detail__header h5{margin-top:3px}.rescue-detail__header h5 i{margin-right:7px;color:#176985}.rescue-detail__hero{display:flex;align-items:flex-end;justify-content:space-between;gap:24px;padding:28px 32px;background:linear-gradient(135deg,#082f40,#176985);color:#fff}.rescue-detail__code{display:inline-block;margin-bottom:8px;padding:5px 8px;border-radius:5px;background:#ea4e1a;font-size:.62rem;font-weight:800;letter-spacing:.08em}.rescue-detail__hero h3{margin:0 0 8px;color:#fff;font-size:1.55rem}.rescue-detail__hero p{margin:0;color:#c9dce4;font-size:.74rem}.rescue-detail__hero p i{margin-right:5px;color:#ff8b63}.rescue-detail__hero-meta{display:flex;gap:8px}.rescue-detail__hero-meta>span{min-width:100px;padding:10px 12px;border:1px solid rgba(255,255,255,.16);border-radius:8px;background:rgba(255,255,255,.08)}.rescue-detail__hero-meta small{display:block;margin-bottom:3px;color:#a9c4ce;font-size:.53rem;font-weight:700;letter-spacing:.08em}.rescue-detail__hero-meta strong{color:#fff;font-size:.72rem}.rescue-detail__body{padding:22px!important;background:#eef3f5}.rescue-detail__body form>.border{margin-bottom:16px!important;padding:4px 12px 0;border:1px solid #d7e3e7!important;border-radius:12px;background:#fff;box-shadow:0 3px 12px rgba(12,52,67,.035)}.rescue-detail__body form>.border>.row>h5{display:flex;align-items:center;margin:0 0 16px!important;padding:13px 4px 12px;border-bottom:1px solid #e5ecef;color:#173744;font-size:.9rem}.rescue-detail__body form>.border>.row>h5:before{content:'';width:4px;height:19px;margin-right:9px;border-radius:4px;background:#ea4e1a}.rescue-detail__body .row>[class*="col-"]{padding:10px 12px!important}.rescue-detail__body .row>[class*="col-"]:not(:has(table)){border:1px solid #e2eaed;border-radius:8px;background:#f8fafb}.rescue-detail__body label{display:block;margin-bottom:5px;color:#71858e!important;font-size:.59rem!important;font-weight:800!important;letter-spacing:.04em;text-transform:uppercase}.rescue-detail__body .form-control[readonly]{min-height:22px!important;padding:0!important;border:0!important;background:transparent!important;color:#24434f;font-size:.78rem;font-weight:600;box-shadow:none!important}.rescue-detail__body textarea.form-control[readonly]{min-height:45px!important;line-height:1.55;resize:none}.rescue-detail__body table{margin:0}.rescue-detail__body table .form-control[readonly]{font-weight:500}.rescue-detail__command{border-top:3px solid #176985!important}.rescue-detail__pills{display:flex;flex-wrap:wrap;gap:5px}.rescue-detail__pills span{padding:5px 8px;border-radius:10px;background:#e4f0f4;color:#17536a;font-size:.62rem;font-weight:700}.rescue-detail__narrative{color:#294955;font-size:.76rem;line-height:1.6;white-space:pre-line}.rescue-detail__footer{justify-content:flex-end!important}.rescue-detail__footer>span{margin-right:auto;color:#71858d;font-size:.65rem}.rescue-detail__footer>span i{margin-right:5px;color:#ea4e1a}
@media(max-width:767.98px){.rescue-detail-modal .modal-dialog{height:calc(100dvh - 1rem);max-height:calc(100dvh - 1rem);margin:.5rem}.rescue-detail__hero{align-items:flex-start;flex-direction:column;padding:22px}.rescue-detail__hero-meta{width:100%;overflow-x:auto}.rescue-detail__hero-meta>span{min-width:90px}.rescue-detail__body{padding:12px!important}.rescue-detail__footer>span{display:none}.rescue-detail__footer .btn{flex:1}}
</style>
