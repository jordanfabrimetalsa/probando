<div class="modal fade" id="ShowModal" tabindex="-1" aria-labelledby="ShowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content modal-extra-background">
        <div class="modal-header">
          <h5 class="modal-title" id="ShowModalLabel"><i class="fa-solid fa-map-location-dot"></i> Detalles del Rescate</h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formRescueUpdate" class="form" method="POST">
            @method('PUT')
            @csrf
            <input type="hidden" name="id_show" id="id_show">

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
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>
