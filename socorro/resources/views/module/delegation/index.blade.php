@extends('layout.main')

@section('title', 'Voluntarios')

@section('content')

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-people-roof"></i> Administración de Delegaciones</h6>
              </div>
            </div>
            <div class="card-body p-4">
              <div class="w-100 p-2 mb-4">
                <table id="datatableDelegations" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                  <thead class="bg-gradient-dark text-center">
                    <tr class="text-center">
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombre</th>
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
    </div>
</div>

@include('module.delegation.create')
@include('module.delegation.edit')
@include('module.delegation.createPostulation')

@endsection

@push('script')
<script>
    var datatableDelegations;
    var datatableVoluntaries;
    var datatablePostulations;

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
        buttons: [
                {
                  text: '<i class="fa-solid fa-circle-plus"></i>',
                  className: 'btn btn-dark text-white gap-2 me-2',
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
        columns:[
          {data: 'name'},
          {
            data: null,
            orderable: false,
            searchable: false,
            render: function(data, type, row) {
              return `
                <a href="javascript:;" class="btn btn-dark text-white" onclick="editDelegation(${data.id})" data-bs-toggle="modal" data-bs-target="#EditModal">
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
          $('#formDelegation')[0].reset();
          $('#CreateModal').modal('hide');
          datatableDelegations.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al registrar delegación',
          });
          $('#CreateModal').modal('hide');
        }
      })
    })

    function editDelegation(id){
      $.ajax({
        url: 'delegaciones/edit/'+id,
        type: 'GET',
        success: function(response){
          console.log(response.name);
          $('#EditModal').modal('show');
          $('#id').val(response.id);
          $('#name_edit').val(response.name);
          $('#postulation_status').val(response.postulation_status == 'C' ? 'Cerrado' : 'Abierto');
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al editar delegación',
          });
        }
      });

      datatablePostulations = $('#datatablePostulations').DataTable({
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
        buttons: [
                {
                  text: '<i class="fa-solid fa-circle-plus"></i>',
                  className: 'btn btn-dark text-white gap-2 me-2',
                  action: () => {
                    $('#CreateModalEventPostulation').modal('show') 
                  }
                },
                {
                  extend: 'excelHtml5',
                  text: '<i class="fa-solid fa-file-excel"></i>',
                  className: 'btn btn-success me-2'
                }
        ],
        columns:[
          {data: 'title'},
          {data: 'start_date', render: function(data){
            return moment(data).format('DD/MM/YYYY HH:mm:ss');
          }},
          {data: 'end_date', render: function(data){
            return moment(data).format('DD/MM/YYYY HH:mm:ss');
          }}
        ],
        destroy: true
      });

      datatableVoluntaries = $('#datatableVoluntaries').DataTable({
        ajax:{
          url: '{{ route("voluntarios.data") }}',
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
        buttons: [
                {
                  extend: 'excelHtml5',
                  text: '<i class="fa-solid fa-file-excel"></i>',
                  className: 'btn btn-success me-2'
                }
        ],
        columns:[
          {data: 'name'},
          {
            data: 'type',
            render: function(data, type, row) {
              return data == 'V' ? 'Voluntario' : 'Aspirante';
            }
          }
        ],
        destroy: true
      });
    }

    
    $('#formDelegationEventPostulation').submit(function(e){
      e.preventDefault();
      $.ajax({
        url: '{{ route("postulations.store") }}',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Postulación registrada correctamente',
          });
          $('#formDelegationEventPostulation')[0].reset();
          $('#CreateModalEventPostulation').modal('hide');
          datatableDelegations.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al registrar postulación',
          });
          $('#CreateModalEventPostulation').modal('hide');
        }
      })
    })
    
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