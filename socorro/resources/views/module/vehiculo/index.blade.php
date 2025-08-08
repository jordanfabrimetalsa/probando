@extends('layout.main')

@section('title', 'Voluntarios')

@section('content')
  <div class="container-fluid py-2">
      <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-user-gear"></i>Administrar Vehículos</h6>
                </div>
              </div>
              <div class="card-body p-4">
                <div class="w-100 p-2 mb-4">
                  <table id="datatableVehicles" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                    <thead class="bg-gradient-dark text-center">
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Marca</th>
                        <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Modelo</th>
                        <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Patente</th>
                        <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Color</th>
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
      </div>
  </div>
  @include('module.vehiculo.create')
  @include('module.vehiculo.createBrand')
  @include('module.vehiculo.createModel')
@endsection

@push('script')
<script>
    var datatableVehicles;
    var datatableBrand;
    var datatableModel;

    $(document).ready(function(){
      datatableVehicles = $('#datatableVehicles').DataTable({
        ajax: {
          url: '{{ route("vehiculo.data") }}',
          dataSrc: ''
        },
        columns: [
          { data: 'brand.name',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'model.name',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
           },
          { data: 'plate',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'colour',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'status',
            render: function(data){
              return data == '1'
                ? '<span class="badge bg-success">Activo</span>'
                : '<span class="badge bg-danger">Inactivo</span>';
            }
          },
          {
                  data: null,
                  orderable: false,
                  searchable: false,
                  render: function(data, type, row) {
                    return `
                      <a href="javascript:;" class="btn btn-info text-white" onclick="showVoluntary(${data.id})" data-bs-toggle="modal" data-bs-target="#ShowModal">
                        <i class="fa-regular fa-user"></i>
                      </a>
                      <a href="javascript:;" class="btn btn-dark text-white" onclick="editVoluntary(${data.id})" data-bs-toggle="modal" data-bs-target="#EditModal">
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
            text: '<i class="fa-solid fa-copyright"></i>',
            className: 'btn btn-dark me-2',
            action: () => $('#CreateBrandModal').modal('show')
          },
          {
            text: '<i class="fa-brands fa-buromobelexperte"></i>',
            className: 'btn btn-dark me-2',
            action: () => $('#CreateModelModal').modal('show')
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

      datatableBrand = $('#datatableBrand').DataTable({
        ajax: {
          url: '{{ route("vehiculo.brand.data") }}',
          dataSrc: ''
        },
        columns: [
          { data: 'name',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
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
        searching: false,
        bFilter: false,
      });

    datatableModel = $('#datatableModel').DataTable({
        ajax: {
          url: '{{ route("vehiculo.model.data") }}',
          dataSrc: ''
        },
        columns: [
          { data: 'name',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'brand.name',
            render: function(data){
                return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
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
        searching: false,
        bFilter: false,
      });
    });

    $('#formVehiculo').submit(function(e){
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        url: '{{ route("vehiculo.store") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Vehiculo registrado correctamente',
          });
          $('#formVehiculo')[0].reset();
          $('#CreateModal').modal('hide');
          datatableVehicles.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al registrar vehiculo' + JSON.stringify(error),
          });
          $('#CreateModal').modal('hide');
        }
      })
    })

    $('#formBrand').submit(function(e){
      e.preventDefault();
      let formData = $(this).serialize();
      $.ajax({
        url: '{{ route("vehiculo.brand.store") }}',
        type: 'POST',
        data: formData,
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Marca de vehiculo registrado correctamente',
          });
          $('#formBrand')[0].reset();
          datatableBrand.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al registrar marca de vehiculo' + JSON.stringify(error),
          });
          $('#CreateBrandModal').modal('hide');
        }
      })
    })

    $('#formModel').submit(function(e){
      e.preventDefault();
      let formData = $(this).serialize();
      $.ajax({
        url: '{{ route("vehiculo.model.store") }}',
        type: 'POST',
        data: formData,
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Modelo de vehiculo registrado correctamente',
          });
          $('#formModel')[0].reset();
          datatableModel.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al registrar modelo de vehiculo' + JSON.stringify(error),
          });
          $('#CreateModelModal').modal('hide');
        }
      })
    })

    $('#formVoluntaryEdit').submit(function(e){
      e.preventDefault();
      let id = $('#id').val();

      $.ajax({
        url: 'voluntarios/update/'+id,
        type: 'PUT',
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: $(this).serialize(),
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Voluntario actualizado correctamente',
          });
          $('#EditModal').modal('hide');
          datatableVoluntaries.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al actualizar voluntario' + JSON.stringify(error),
          });
          $('#EditModal').modal('hide');
        }
      })
    })

    function editVoluntary(id){
      $.ajax({
        url: 'voluntarios/edit/'+id,
        type: 'GET',
        success:function(response){
          console.log(response);
          $('#EditModal').modal('show');
          $('#formVoluntaryEdit').attr('action', 'voluntarios/update/'+id);
          $('#vehicle_edit').val(response.vehicle);
          $('#license_edit').val(response.license);
          $('#type_edit').val(response.type);
          $('#status_edit').val(response.status);
          $('#name_edit').text(response.name);
          $('#id').val(response.id);
        },
        error:function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al editar voluntario',
          });
          $('#EditModal').modal('hide');
        }
      });
    }

    function deleteVoluntary(id){
      Swal.fire({
              title: "¿Estas seguro de eliminar al voluntario?",
              text: "No podrás revertir esto!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Si, eliminarlo!"
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  url: 'voluntarios/destroy/'+id,
                  type: 'DELETE',
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response){
                        Swal.fire({
                            icon: 'success',
                            title: 'Exito.',
                            text: 'Voluntario eliminado correctamente',
                        });
                        datatableVoluntaries.ajax.reload();
                    },
                    error: function(error){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error.',
                            text: 'Error al eliminar voluntario',
                        });
                    }
                });
              }
            });
    }

    function showRemark(id){
      $('#id_user_remark').val(id);
      $('#RemarkModal').modal('show');
    }

    $('#formVoluntaryRemark').submit(function(e){
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        url: 'voluntarios/remark',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Anotación registrada correctamente',
          });
          $('#formVoluntaryRemark')[0].reset();
          $('#RemarkModal').modal('hide');
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al registrar anotación' + JSON.stringify(error),
          });
          $('#RemarkModal').modal('hide');
        }
      })
    })

    function showEmergency(id){
      $('#id_user_emergency').val(id);
      $('#EmergencyModal').modal('show');
    }

    $('#formVoluntaryEmergency').submit(function(e){
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        url: 'voluntarios/emergency',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Emergencia registrada correctamente',
          });
          $('#formVoluntaryEmergency')[0].reset();
          $('#EmergencyModal').modal('hide');
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al registrar emergencia' + JSON.stringify(error),
          });
          $('#EmergencyModal').modal('hide');
        }
      })
    })
</script>

@endpush