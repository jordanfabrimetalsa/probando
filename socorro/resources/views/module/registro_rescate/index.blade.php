@extends('layout.main')

@section('title', 'Registro de Rescate')

@section('content')
  <div class="container-fluid py-2">
      <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-map-location-dot"></i> Administración de los Rescates</h6>
                </div>
              </div>
              <div class="card-body p-4">
                <div class="w-100 p-2 mb-4">
                  <table id="datatableRescue" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                    <thead class="bg-gradient-dark text-center">
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombre</th>
                        <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Tipo</th>
                        <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Lugar</th>
                        <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Fecha</th>
                        <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Acciones</th>
                      </tr>
                    </thead>
                    <tbody class="text-center">
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
        @include('module.registro_rescate.create')
        @include('module.registro_rescate.show')
      </div>
  </div>
@endsection

@push('script')
<script>
    var datatableRescue;

    $(document).ready(function(){
      datatableRescue = $('#datatableRescue').DataTable({
        ajax: {
          url: '{{ route("registro-rescate.data") }}',
          dataSrc: ''
        },
        columns: [
          { data: 'nombre_completo',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'tipo_emergencia',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
           },
          { data: 'lugar',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'fecha_operativo',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+moment(data).format('DD/MM/YYYY')+'</p>'
            }
          },
          {
                  data: null,
                  orderable: false,
                  searchable: false,
                  render: function(data, type, row) {
                    return `
                      <a href="javascript:;" class="btn btn-info text-white" onclick="showRescue(${data.id})" data-bs-toggle="modal" data-bs-target="#ShowModal">
                        <i class="fa-solid fa-map-location-dot"></i>
                      </a>
                      <a href="{{ url('registro-rescate/pdf') }}/${data.id}" target="_blank" class="btn btn-dark text-white" title="Abrir informe SCI">
                        <i class="fa-solid fa-file-pdf"></i>
                      </a>
                      <a onclick="deleteRescue(${data.id})" class="btn btn-danger text-white">
                        <i class="fa-solid fa-trash"></i>
                      </a>
                      `;
                  }
                }
        ],
        buttons: [
          {
            extend: 'excelHtml5',
            text: '<i class="fa-solid fa-file-excel"></i>',
            className: 'btn btn-success me-2'
          },
          {
            extend: 'print',
            text: '<i class="fa-solid fa-print"></i>',
            className: 'btn btn-primary me-2'
          },
          {
            extend: 'csvHtml5',
            text: '<i class="fa-solid fa-file-csv"></i>',
            className: 'btn btn-success me-2'
          },
          {
            extend: 'pdfHtml5',
            text: '<i class="fa-solid fa-file-pdf"></i>',
            className: 'btn btn-danger me-2'
          }
        ],
        language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "<i class='fa-solid fa-magnifying-glass'></i>",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
        },
        dom:
          "<'row mb-2'<'col-md-6 d-flex align-items-center'B><'col-md-6'f>>" +
          "<'row'<'col-12'tr>>" +
          "<'row mt-2'<'col-md-6'i><'col-md-6'p>>",
        responsive:{
          details:{
            type: 'inline'
          }
        },
        order: [[3, 'asc']],
      });

    });

    $('#formRescueUpdate').submit(function(e){
        e.preventDefault();

        // Copiar valores actuales de selects deshabilitados a inputs hidden antes de serializar
        $('#type_show_hidden').val($('#type_show').val());
        $('#weather_show_hidden').val($('#weather_show').val());
        $('#helper_external_show_hidden').val($('#helper_external_show').val());
        $('#external_helper_show_hidden').val($('#external_helper_show').val());
        $('#Stretcher_show_hidden').val($('#Stretcher_show').val());
        $('#type_transport_show_hidden').val($('#type_transport_show').val());
        $('#helicopter_show_hidden').val($('#helicopter_show').val());
        $('#voluntary_id_show_hidden').val($('#voluntary_id_show').val());

        let formData = $(this).serialize();
        let id = $('#id_show').val();

        $.ajax({
            url: '{{ url("registro-rescate/update") }}/' + id,
            type: 'POST',
            data: formData,
            success:function(response){
              Swal.fire({
                  icon: 'success',
                  title: 'Éxito.',
                  text: response.message,
              });
                $('#ShowModal').modal('hide');
                $('#formRescueUpdate')[0].reset();
                datatableRescue.ajax.reload();
            },
            error:function(error){
              Swal.fire({
                  icon: 'error',
                  title: 'Error.',
                  text: 'Error al editar rescate',
              });
              $('#ShowModal').modal('hide');
            }
        });
    });

    function showRescue(id){
      $.ajax({
        url: 'registro-rescate/show/' + id,
        type: 'GET',
        success:function(response){
          console.log(response.data);
          const rescue = response.data;
          const displayValue = value => value === null || value === undefined || value === '' ? 'No informado' : value;
          $('#incident_code_show').text(displayValue(rescue.incident_code || ('CSA-' + rescue.id)));
          $('#incident_title_show').text(displayValue(rescue.tipo_emergencia));
          $('#incident_location_show').text(displayValue(rescue.lugar_exacto || rescue.lugar));
          $('#incident_date_show').text(rescue.fecha_operativo ? moment(rescue.fecha_operativo).format('DD/MM/YYYY') : '—');
          $('#incident_level_show').text(displayValue(rescue.nivel_activacion));
          $('#incident_status_show').text(displayValue(rescue.estado_cierre));
          $('#commandante_incidente_show').val(displayValue(rescue.commandante_incidente));
          $('#puesto_comando_show').val(displayValue(rescue.puesto_comando));
          $('#hora_desmovilizacion_show').val(displayValue(rescue.hora_desmovilizacion));
          $('#objetivos_incidente_show').val(displayValue(rescue.objetivos_incidente));
          $('#riesgos_operacionales_show').val(displayValue(rescue.riesgos_operacionales));
          $('#plan_comunicaciones_show').val(displayValue(rescue.plan_comunicaciones));
          $('#zona_operaciones_show').val(displayValue(rescue.zona_operaciones));
          $('#rescuePdfLink').attr('href', '{{ url("registro-rescate/pdf") }}/' + rescue.id);
          const pills = values => values && values.length
            ? values.map(value => '<span>' + $('<div>').text(value).html() + '</span>').join('')
            : '<span>Sin registros</span>';
          $('#rescue_volunteers_show').html(pills((rescue.voluntaries || []).map(v => ((v.name || '') + ' ' + (v.lastname || '')).trim())));
          $('#rescue_institutions_show').html(pills(rescue.instituciones || []));
          $('#rescue_materials_show').html(pills(rescue.materiales || []));
          $('#lecciones_aprendidas_show').text(displayValue(rescue.lecciones_aprendidas));

          // Datos generales del operativo
          $('#fecha_operativo_show').val(response.data.fecha_operativo);
          $('#hora_llamado_show').val(response.data.hora_llamado);
          $('#lugar_show').val(response.data.lugar);
          $('#tipo_emergencia_show').val(response.data.tipo_emergencia);
          $('#nombre_llamado_show').val(response.data.nombre_llamado);
          $('#telefono_show').val(response.data.telefono);

          // Información de la persona lesionada/afectada
          $('#nombre_completo_show').val(response.data.nombre_completo);
          $('#rut_dni_show').val(response.data.rut_dni);
          $('#edad_show').val(response.data.edad);
          $('#sexo_show').val(response.data.sexo);
          $('#estatura_show').val(response.data.estatura);
          $('#peso_show').val(response.data.peso);
          $('#telefono_afectado_show').val(response.data.telefono_afectado);
          $('#condicion_fisica_show').val(response.data.condicion_fisica);

          // Ubicación
          $('#lugar_exacto_show').val(response.data.lugar_exacto);
          $('#latitud_show').val(response.data.latitud);
          $('#longitud_show').val(response.data.longitud);
          $('#altitud_show').val(response.data.altitud);
          $('#ubicacion_vehiculo_rescate_show').val(response.data.ubicacion_vehiculo_rescate);

          // Situación inicial
          $('#condicion_sanitaria_inicial_show').val(response.data.condicion_sanitaria_inicial);
          $('#eva_inicial_show').val(response.data.eva_inicial);
          $('#msc_inicial_show').val(response.data.msc_inicial);
          $('#estado_emocional_psicologico_show').val(response.data.estado_emocional_psicologico);


          // Evaluación primaria (XABCDE) - usar datos de la tabla relacionada si existen
            const xabcde = response.data.xabcde || {};
            $('#xabcde_x_show').val(displayValue(xabcde.x_hemorragias));
            $('#xabcde_a_show').val(displayValue(xabcde.a_via_aerea));
            $('#xabcde_b_show').val(displayValue(xabcde.b_respiracion));
            $('#xabcde_c_show').val(displayValue(xabcde.c_circulacion));
            $('#xabcde_d_show').val(displayValue(xabcde.d_estado_neurologico));
            $('#xabcde_e_show').val(displayValue(xabcde.e_exposicion));

          // Evaluación Secundaria (SAMPLE) - usar datos de la tabla relacionada si existen
          if(response.data.sample) {
            $('#sample_signos_sintomas_show').val(response.data.sample.signos_sintomas);
            $('#sample_alergias_show').val(response.data.sample.alergias);
            $('#sample_medicamentos_show').val(response.data.sample.medicamentos);
            $('#sample_patologias_previas_show').val(response.data.sample.patologias_previas);
            $('#sample_ultima_ingesta_show').val(response.data.sample.ultima_ingesta);
            $('#sample_eventos_previos_show').val(response.data.sample.eventos_previos);
          } else {
            // Usar campos directos de rescates si no hay tabla relacionada
            $('#sample_signos_sintomas_show').val(response.data.sample_signos_sintomas);
            $('#sample_alergias_show').val(response.data.sample_alergias);
            $('#sample_medicamentos_show').val(response.data.sample_medicamentos);
            $('#sample_patologias_previas_show').val(response.data.sample_patologias_previas);
            $('#sample_ultima_ingesta_show').val(response.data.sample_ultima_ingesta);
            $('#sample_eventos_previos_show').val(response.data.sample_eventos_previos);
          }

          // Plan de Acción y Ejecución
          $('#resumen_acciones_show').val(response.data.resumen_acciones);
          $('#medicamentos_administrados_show').val(response.data.medicamentos_administrados);
          $('#metodo_evacuacion_show').val(response.data.metodo_evacuacion);
          $('#destino_final_paciente_show').val(response.data.destino_final_paciente);

          // Bitácora
          const bitacora = response.data.bitacora || {};
          $('#bitacora_emergencia_presencial_show').val(displayValue(bitacora.emergencia_presencial));
          $('#bitacora_salida_cuartel_show').val(displayValue(bitacora.salida_cuartel));
          $('#bitacora_llegada_acceso_show').val(displayValue(bitacora.llegada_acceso));
          $('#bitacora_contacto_grupo_show').val(displayValue(bitacora.contacto_grupo));
          $('#bitacora_evaluacion_sanitaria_inicial_show').val(displayValue(bitacora.evaluacion_sanitaria_inicial));
          $('#bitacora_inicio_descenso_show').val(displayValue(bitacora.inicio_descenso));
          $('#bitacora_llegada_extraccion_show').val(displayValue(bitacora.llegada_extraccion));
          $('#bitacora_traslado_destino_final_show').val(displayValue(bitacora.traslado_destino_final));
          $('#bitacora_regreso_cuartel_show').val(displayValue(bitacora.regreso_cuartel));

          // Descripción y observaciones
          $('#descripcion_emergencia_show').val(response.data.descripcion_emergencia);
          $('#observaciones_generales_show').val(response.data.observaciones_generales);

          // Mostrar voluntarios e instituciones si existen
          if(response.data.voluntaries && response.data.voluntaries.length > 0) {
            console.log('Voluntarios:', response.data.voluntaries);
          }

          if(response.data.instituciones && response.data.instituciones.length > 0) {
            console.log('Instituciones:', response.data.instituciones);
          }

          // ID del registro
          $('#id_show').val(response.data.id);
        },
        error:function(error){
          console.error('Error completo:', error);
          console.error('Status:', error.status);
          console.error('ResponseText:', error.responseText);
          console.error('ResponseJSON:', error.responseJSON);

          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'No se pudieron cargar los datos del rescate: ' + (error.responseJSON?.message || error.message || 'Error desconocido'),
          });
        }
      });
    }

    function deleteRescue(id){
      swal.fire({
        title: '¿Estas seguro de eliminar este rescate?',
        text: "No podrás revertir esto!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminarlo'
        }).then((result) => {
          if (result.isConfirmed) {
            $.ajax({
              url: 'registro-rescate/destroy/' + id,
              type: 'DELETE',
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              success:function(response){
                Swal.fire({
                icon: 'success',
                title: 'Éxito.',
                text: response.message,
            });
            datatableRescue.ajax.reload();
          },
          error:function(error){
            Swal.fire({
              icon: 'error',
              title: 'Error.',
              text: 'Error al eliminar rescate: ' + JSON.stringify(error),
            });
          }
        });
      }
    });
  }
</script>

@endpush
