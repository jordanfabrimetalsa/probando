@extends('layout.main')

@section('title', 'Voluntarios')

@section('content')

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Administración de Voluntarios</h6>
              </div>
            </div>
            <div class="card-body p-4">
              <div class="w-100 p-2 mb-4">
                <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i> Agregar Voluntario</button>
                <table id="datatableVoluntaries" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                  <thead class="bg-gradient-dark text-center">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Delegación</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Tipo</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Email</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Telefono</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Estado</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Registrar Voluntario</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formVoluntario" class="form" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Delegación<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="delegation_id" name="delegation_id">
                    @foreach ($delegations as $delegation)
                        <option value="{{ $delegation->id }}">{{ $delegation->name }}</option>
                    @endforeach
                </select>   
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label>Imagen</label>
                <input type="file" class="form-control border border-gray p-2" id="image" name="image">
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Número de Documento<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="document" name="document" aria-describedby="emailHelp">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="name" name="name" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Apellido<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="lastname" name="lastname" aria-describedby="emailHelp">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control border border-gray p-2" id="email" name="email" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Telefono<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="phone" name="phone" aria-describedby="emailHelp">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fecha Nacimiento<span class="text-danger">*</span></label>
                <input type="date" class="form-control border border-gray p-2" id="birthday" name="birthday" aria-describedby="emailHelp">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Sexo<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="gender" name="gender">
                    <option selected>Seleccione Opción</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Alergico<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="allergic" name="allergic">
                    <option selected>Seleccione Opción</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>   
              </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Enfermedad<span class="text-danger">*</span></label>
                  <select class="form-select border border-gray p-2" aria-label="Default select example" id="disease" name="disease">
                      <option selected>Seleccione Opción</option>
                      <option value="1">Sí</option>
                      <option value="0">No</option>
                  </select>
                </div>  
              </div>
              <div class="col-4">
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Medicamento<span class="text-danger">*</span></label>
                  <select class="form-select border border-gray p-2" aria-label="Default select example" id="medicine" name="medicine">
                      <option selected>Seleccione Opción</option>
                      <option value="1">Sí</option>
                      <option value="0">No</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">¿Tiene Vehiculo?<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="vehicle" name="vehicle">
                    <option selected>Seleccione Opción</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">¿Tiene Licencia de Conducir Clase B?<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="license" name="license">
                    <option selected>Seleccione Opción</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control border border-gray p-2" id="password" name="password" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Estado</label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="status" name="status">
                  <option selected>Seleccione el Estado</option>
                  <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Tipo de Socorrista</label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="type" name="type">
                  <option selected>Seleccione el Tipo</option>
                  <option value="V">Voluntario</option>
                <option value="A">Aspirante</option>
              </select>
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
        <h5 class="modal-title" id="EditModalLabel">Editar Voluntario</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formVoluntaryEdit" class="form" method="POST">
          @csrf
          @method('PUT')
          <p>Nombre: <span id="name_edit"></span></p>
          <input type="hidden" id="id" name="id">
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">¿Tiene Vehiculo?</label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="vehicle_edit" name="vehicle">
                    <option selected>Seleccione Opción</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">¿Tiene Licencia de Conducir Clase B?</label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="license_edit" name="license">
                    <option selected>Seleccione Opción</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
              <label for="exampleInputPassword1" class="form-label">Tipo de Socorrista</label>
              <select class="form-select border border-gray p-2" aria-label="Default select example" id="type_edit" name="type">
                <option selected>Seleccione el Tipo</option>
                <option value="V">Voluntario</option>
                <option value="A">Aspirante</option>
              </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Estado</label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="status_edit" name="status">
                  <option selected>Seleccione el Estado</option>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
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
    var datatableVoluntaries;
    $(document).ready(function(){
      datatableVoluntaries = $('#datatableVoluntaries').DataTable({
        ajax: {
          url: '{{ route("voluntarios.data") }}',
          dataSrc: ''
        },
        columns: [
          { data: 'name',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'delegation.name',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'type',
            render: function(data){
              return data === 'V'
                ? '<span class="badge bg-success">Voluntario</span>'
                : '<span class="badge bg-danger">Aspirante</span>';
            }
           },
          { data: 'email',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'phone',
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
                      <a href="javascript:;" class="btn btn-info text-white" onclick="showVoluntary(${data.id})" data-bs-toggle="modal" data-bs-target="#EditModal">
                        <i class="fa-regular fa-user"></i>
                      </a>
                      <a href="javascript:;" class="btn btn-warning text-white" onclick="editVoluntary(${data.id})" data-bs-toggle="modal" data-bs-target="#EditModal">
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
                  className: 'btn btn-info me-2'
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
        }
      });
    });

    $('#formVoluntario').submit(function(e){
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        url: '{{ route("voluntarios.store") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Voluntario registrado correctamente',
          });
          $('#exampleModal').modal('hide');
          datatableVoluntaries.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al registrar voluntario',
          });
          $('#exampleModal').modal('hide');
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
                            text: 'Error al eliminar voluntario: ' + JSON.stringify(error),
                        });
                    }
                });
              }
            });
    }
</script>

@endpush