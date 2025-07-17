@extends('layout.main')

@section('title', 'Voluntarios')

@section('content')

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Administración de Delegaciones</h6>
              </div>
            </div>
            <div class="card-body p-4">
              <div class="w-100 p-2 mb-4">
                <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i> Agregar Delegación</button>
                <table id="datatableDelegations" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                  <thead class="bg-gradient-dark text-center">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Acciones</th>
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
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Delegación</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
      </div>
      <div class="modal-body">
        <form id="formDelegation" class="form" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success btn-sm">Guardar</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditModalLabel">Editar Delegación</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
      </div>
      <div class="modal-body">
        <form id="formDelegationEdit" class="form" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" id="id" name="id">
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name" name="name">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success btn-sm">Guardar</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('script')
<script>
    var datatableDelegations;
    $(document).ready(function(){
      datatableDelegations = $('#datatableDelegations').DataTable({
        ajax:{
          url: '{{ route("delegaciones.data") }}',
          dataSrc: ''
        },
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
                "search": "Buscar:",
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
        buttons: [
          {
            extend: 'excelHtml5',
            text: '<i class="fa-solid fa-file-excel"></i>',
            className: 'btn btn-success me-2'
          },
          {
            extend: 'pdfHtml5',
            text: '<i class="fa-solid fa-file-pdf"></i>',
            className: 'btn btn-danger me-2'
          },
          {
            extend: 'csvHtml5',
            text: '<i class="fa-solid fa-file-csv"></i>',
            className: 'btn btn-info me-2'
          }
        ],
        columns:[
          {data: 'name'},
          {
            data: null,
            orderable: false,
            searchable: false,
            render: function(data, type, row) {
              return `
                <a href="javascript:;" class="btn btn-warning text-white" onclick="editDelegation(${data.id})" data-bs-toggle="modal" data-bs-target="#EditModal">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                      <a onclick="deleteDelegation(${data.id})" class="btn btn-danger text-white">
                        <i class="fa-solid fa-trash"></i>
                      </a>`;
            }
          }        
        ]
      });
    });

    $('#formDelegation').submit(function(e){
      e.preventDefault();
      $.ajax({
        url: '{{ route("delegaciones.store") }}',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Delegación registrada correctamente',
          });
          $('#exampleModal').modal('hide');
          datatableDelegations.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al registrar delegación',
          });
          $('#exampleModal').modal('hide');
        }
      })
    })

    function editDelegation(id){
      console.log(id);
      $.ajax({
        url: 'delegaciones/edit/'+id,
        type: 'GET',
        success: function(response){
          console.log(response.name);
          $('#EditModal').modal('show');
          $('#id').val(response.id);
          $('#name').val(response.name);
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al editar delegación',
          });
        }
      })
    }
    
    $('#formDelegationEdit').submit(function(e){
      e.preventDefault();
      let id = $('#id').val();
      
      $.ajax({
        url: 'delegaciones/update/' + id,
        type: 'PUT',
        data: $(this).serialize(), // <-- ESTA LÍNEA ES CLAVE
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Éxito',
            text: 'Delegación actualizada correctamente',
          });
          $('#EditModal').modal('hide');
          datatableDelegations.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error',
            text: error.responseJSON?.error || 'Error al actualizar delegación',
          });
        }
      });
    });

    function deleteDelegation(id){
            Swal.fire({
              title: "¿Estas seguro de eliminar el usuario?",
              text: "No podrás revertir esto!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Si, eliminarlo!"
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  url: 'delegaciones/destroy/'+id,
                  type: 'DELETE',
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response){
                        Swal.fire({
                            icon: 'success',
                            title: 'Exito.',
                            text: 'Delegación eliminada correctamente',
                        });
                        datatableDelegations.ajax.reload();
                    },
                    error: function(error){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error.',
                            text: 'Error al eliminar delegación: ' + JSON.stringify(error),
                        });
                    }
                });
              }
            });
          }
</script>

@endpush