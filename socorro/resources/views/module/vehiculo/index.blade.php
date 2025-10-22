@extends('layout.main')

@section('title', 'vehiculos')

@section('content')
  <div class="container-fluid py-2">
      <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-car"></i> Administrar Vehículos</h6>
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

  @include('module.vehiculo.show')
  @include('module.vehiculo.document')
  @include('module.vehiculo.maintenance')
  @include('module.vehiculo.createBrand')
  @include('module.vehiculo.createModel')
  @include('module.vehiculo.create')

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
                      <a href="javascript:;" class="btn btn-info text-white" onclick="showCar(${data.id})" data-bs-toggle="modal" data-bs-target="#ShowModal">
                        <i class="fa-solid fa-car"></i>
                      </a>
                      <a href="javascript:;" class="btn btn-dark text-white" onclick="createDocumentCar(${data.id})" data-bs-toggle="modal" data-bs-target="#DocumentModal">
                        <i class="fa-solid fa-folder-tree"></i>
                      </a>
                      <a href="javascript:;" class="btn btn-dark text-white" onclick="createMaintenanceCar(${data.id})" data-bs-toggle="modal" data-bs-target="#MaintenanceModal">
                        <i class="fa-solid fa-screwdriver-wrench"></i>
                      </a>
                      <a onclick="deleteCar(${data.id})" class="btn btn-danger text-white">
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

        getBrandData();
        getModelData();
    });

    function getBrandData() {
        $.ajax({
            url: '{{ route("vehiculo.brand.data") }}',
            type: 'GET',
            success: function(response) {
                let brandOptions = '<option value="">Seleccione una marca</option>';
                response.forEach(function(brand) {
                    brandOptions += `<option value="${brand.id}">${brand.name}</option>`;
                });
                $('#brand_id, #model_brand_id').html(brandOptions);
            },
            error: function(error) {
                console.error('Error al cargar marcas:', error);
            }
        });
    }

    function getModelData() {
        $.ajax({
            url: '{{ route("vehiculo.model.data") }}',
            type: 'GET',
            success: function(response) {
                let modelOptions = '<option value="">Seleccione un modelo</option>';
                response.forEach(function(model) {
                    modelOptions += `<option value="${model.id}">${model.name}</option>`;
                });
                $('#model_id').html(modelOptions);
            },
            error: function(error) {
                console.error('Error al cargar modelos:', error);
            }
        });
    }

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
          getBrandData();
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
          getModelData();
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

    $('#formDocumentCar').submit(function(e){
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        url: '{{ route("vehiculo.document.store") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,  
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Documentación del vehículo actualizada correctamente',
          });
          $('#formDocumentCar')[0].reset();
          $('#DocumentModal').modal('hide');
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al actualizar documentación del vehículo' + JSON.stringify(error),
          });
          $('#DocumentModal').modal('hide');
        }
      })
    })

    $('#formMaintenanceCar').submit(function(e){
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        url: '{{ route("vehiculo.maintenance.store") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Mantenimiento del vehículo actualizado correctamente',
          });
          $('#formMaintenanceCar')[0].reset();
          $('#MaintenanceModal').modal('hide');
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al actualizar mantenimiento del vehículo' + JSON.stringify(error),
          });
          $('#MaintenanceModal').modal('hide');
        }
      })
    })

    function editCar(id){
      $.ajax({
        url: 'vehiculo/edit/'+id,
        type: 'GET',
        success:function(response){
          console.log(response);
          $('#EditModal').modal('show');
          $('#formVoluntaryEdit').attr('action', 'vehiculo/update/'+id);
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
            text: 'Error al editar vehiculo',
          });
          $('#EditModal').modal('hide');
        }
      });
    }

    function deleteCar(id){
      Swal.fire({
              title: "¿Estas seguro de eliminar el vehículo?",
              text: "No podrás revertir esto!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Si, eliminarlo!"
            }).then((result) => {
              if (result.isConfirmed) {
                $.ajax({
                  url: 'vehiculo/destroy/'+id,
                  type: 'DELETE',
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response){
                        Swal.fire({
                            icon: 'success',
                            title: 'Exito.',
                            text: 'Vehículo eliminado correctamente',
                        });
                        datatableVehicles.ajax.reload();
                    },
                    error: function(error){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error.',
                            text: 'Error al eliminar vehículo',
                        });
                    }
                });
              }
            });
    }

    function showCar(id){
      try {
        $.ajax({
          url: 'vehiculo/show/' + id,
          type: 'GET',
          success: function(response){
            // Si la respuesta viene como string JSON
            if (typeof response === 'string') {
              response = JSON.parse(response);
            }

            console.log(response);

            $('#ShowModal').modal('show');

            $('#kilometer_show').text(response.kilometer.toLocaleString('es-CL'));
            $('#brand_show').text(response.brand?.name || '');
            $('#model_show').text(response.model?.name || '');
            $('#plate_show').text(response.plate);
            $('#chassis_show').text(response.chassis);
            $('#motor_show').text(response.motor);
            $('#year_show').text(response.year);
            $('#color_show').text(response.colour);
            $('#type_show').text(response.type);
            $('#delegation_show').text(response.delegation?.name || '');

            // ✅ Cambiar documentCar → document_car
            if (response.document_car) {
              $('#circulation_permit_show').html(response.document_car.circulation_permit = 'Vigente' ? '<span class="badge bg-gradient-success">Vigente</span>' : '<span class="badge bg-gradient-danger">Vencido</span>');
              $('#gases_show').html(response.document_car.gases = 'Vigente' ? '<span class="badge bg-gradient-success">Vigente</span>' : '<span class="badge bg-gradient-danger">Vencido</span>');
              $('#technical_inspection_show').html(response.document_car.technical_inspection = 'Vigente' ? '<span class="badge bg-gradient-success">Vigente</span>' : '<span class="badge bg-gradient-danger">Vencido</span>');
              $('#insurance_show').html(response.document_car.insurance = 'Vigente' ? '<span class="badge bg-gradient-success">Vigente</span>' : '<span class="badge bg-gradient-danger">Vencido</span>');
            } else {
              $('#circulation_permit_show, #gases_show, #technical_inspection_show, #insurance_show').html('Sin datos');
            }

            // ✅ Mostrar mantenimiento
            var maintenance = '';
            if (response.maintenance && response.maintenance.length > 0) {
              response.maintenance.forEach(element => {
                maintenance += `
                  <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                    <div class="d-flex align-items-start flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">${element.kilometer.toLocaleString('es-CL')} km</h6>
                      <p class="mb-0 text-xs">${element.place} - $${element.cost.toLocaleString('es-CL')}</p>
                      <small class="text-muted">${element.date}</small>
                    </div>
                  </li>`;
              });
            } else {
              maintenance = `<li class="list-group-item border-0 px-0 mb-2 pt-0">Sin registros</li>`;
            }

            $('#maintenance_name_show').html(maintenance);
          },
          error: function(error){
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Error al mostrar vehículo: ' + JSON.stringify(error)
            });
          }
        });
      } catch(e){
        console.error(e);
      }
    }

    function createDocumentCar(id){
      $('#car_id_document').val(id);
      $('#DocumentModal').modal('show');
    }

    function createMaintenanceCar(id){
      $('#car_id_maintenance').val(id);
      $('#MaintenanceModal').modal('show');
    }

</script>

@endpush
