@extends('layout.main')

@section('title', 'Registro de Rescate')

@section('content')
  <div class="container-fluid py-2">
      <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-map-location-dot"></i> Registro de Rescate</h6>
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
                        <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Estado</th>
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
          { data: 'name_accident',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'type',
            render: function(data){
              return data == 'accident'
                ? '<span class="badge bg-info">Accidente</span>'
                : data == 'search'
                ? '<span class="badge bg-info">Busqueda</span>'
                : '<span class="badge bg-info">Recuperación</span>';
            }
           },
          { data: 'place',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'date_start_trek',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'situation',
            render: function(data){
              return data == 'pending'
                ? '<span class="badge bg-success">Pendiente</span>'
                : data == 'in_progress'
                ? '<span class="badge bg-warning">En Proceso</span>'
                : '<span class="badge bg-danger">Completado</span>';
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
                      <a onclick="deleteRescue(${data.id})" class="btn btn-danger text-white">
                        <i class="fa-solid fa-trash"></i>
                      </a>
                      `;
                  }
                }
        ],
        buttons: [
          {
            text: '<i class="fa-solid fa-circle-plus"></i>',
            className: 'btn btn-dark me-2',
            action: () => $('#CreateModal').modal('show')
          },
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
        }
      });

    });

    $('#formRescue').submit(function(e){
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: '{{ route("registro-rescate.store") }}',
            type: 'POST',
            data: formData,
            success: function(response){
            // Mostrar mensaje desde el backend
            Swal.fire({
                icon: response.status === 'success' ? 'success' : 'warning',
                title: response.status === 'success' ? 'Éxito' : 'Aviso',
                text: response.message,
            });

            if (response.status === 'success') {
                $('#formRescue')[0].reset();
                datatableRescue.ajax.reload();
                $('#CreateModal').modal('hide');
            }
            },
            error: function(xhr){
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

    function editRescue(id){
        $.ajax({
            url: '{{ url("registro-rescate/edit") }}/' + id,
            type: 'GET',
            success:function(response){
            console.log(response);

            $('#EditModal').modal('show');
            let updateRoute = '{{ route("registro-rescate.update", ":id") }}';
            updateRoute = updateRoute.replace(':id', id);
            $('#formRescueEdit').attr('action', updateRoute);
            },
            error:function(error){
            Swal.fire({
                icon: 'error',
                title: 'Error.',
                text: 'Error al editar rescate',
            });
            $('#EditModal').modal('hide');
            }
        });
    }

    function showRescue(id){
      $.ajax({
        url: 'registro-rescate/show/' + id,
        type: 'GET',
        success:function(response){
          $('#type_show').val(response.data.type);

          $('#place_show').val(response.data.place);
          $('#road_show').val(response.data.road);
          $('#weather_show').val(response.data.weather);

          $('#Stretcher_show').val(response.data.Stretcher);
          $('#address_show').val(response.data.address);
          $('#city_show').val(response.data.city);

          $('#created_at_show').val(response.data.created_at);
          $('#date_call_show').val(response.data.date_call);
          $('#date_finish_rescue_show').val(response.data.date_finish_rescue);
          $('#date_middle_trek_show').val(response.data.date_middle_trek);
          $('#date_start_trek_show').val(response.data.date_start_trek);

          $('#kilometer_total_show').val(response.data.kilometer_total);
          $('#different_height_show').val(response.data.different_height);
          $('#quantity_people_show').val(response.data.quantity_people);
          $('#quantity_voluntaries_show').val(response.data.quantity_voluntaries);
          $('#helper_external_show').val(response.data.helper_external);
          $('#external_helper_show').val(response.data.external_helper);
          $('#allergic_show').val(response.data.allergic);
          $('#disease_show').val(response.data.disease);
          $('#gravity_show').val(response.data.gravity);
          $('#helicopter_show').val(response.data.helicopter);
          $('#medical_assistance_show').val(response.data.medical_assistance);
          $('#injury_show').val(response.data.injury);
          $('#observations_show').val(response.data.observations);
          $('#phone_accident_show').val(response.data.phone_accident);
          $('#email_accident_show').val(response.data.email_accident);
          $('#name_accident_show').val(response.data.name_accident);
          $('#user_id_show').val(response.data.user_id);
          $('#type_transport_show').val(response.data.type_transport);
          $('#situation_show').val(response.data.situation);
          $('#state_show').val(response.data.state);
          $('#id_show').val(response.data.id);

          $('#type_show_hidden').val(response.data.type);
          $('#weather_show_hidden').val(response.data.weather);
          $('#helper_external_show_hidden').val(response.data.helper_external);
          $('#external_helper_show_hidden').val(response.data.external_helper);

          $('#Stretcher_show_hidden').val(response.data.Stretcher);
          $('#medical_assistance_show_hidden').val(response.data.medical_assistance);
          $('#type_transport_show_hidden').val(response.data.type_transport);
          $('#helicopter_show_hidden').val(response.data.helicopter);
           $('#voluntary_id_show_hidden').val(response.data.voluntary_id);
          $('#voluntary_id_show').val(response.data.voluntary.name + ' ' + response.data.voluntary.last_name); // o response.voluntary.id

        },
        error:function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Error al mostrar rescate',
          });
        }
      });
    }

@endpush
