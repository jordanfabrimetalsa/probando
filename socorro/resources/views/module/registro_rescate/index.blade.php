@extends('layout.main')

@section('title', 'Registro de Rescate')

@section('content')
  <div class="container-fluid py-2">
      <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-user-gear"></i>Registro de Rescate</h6>
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
                      <a href="javascript:;" class="btn btn-info text-white" onclick="showRescue(${data.id})" data-bs-toggle="modal" data-bs-target="#CreateModal">
                        <i class="fa-regular fa-user"></i>
                      </a>
                      <a href="javascript:;" class="btn btn-dark text-white" onclick="editRescue(${data.id})" data-bs-toggle="modal" data-bs-target="#EditModal">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                      <a onclick="deleteVoluntary(${data.id})" class="btn btn-danger text-white">
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


</script>

@endpush
