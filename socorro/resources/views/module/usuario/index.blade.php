@extends('layout.main')

@section('title', 'Usuarios')

@section('content')

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark shadow-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3">Administración de Usuarios</h6>
              </div>
              <div class="p-2 d-flex justify-align-content-start">
                <button class="btn btn-sm btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-plus"></i> Agregar Usuario</button>
              </div>
            </div>
            <div class="card-body px-0 pb-2">
              <div class="table-responsive p-2">
                <table id="datatableUser" class="table align-items-center mb-0 table-striped table-bordered border-radius-lg">
                  <thead class="table-dark">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Email</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Rol</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Estado</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Ingresado</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
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
        <h5 class="modal-title" id="exampleModalLabel">Registrar Usuario</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
      </div>
      <div class="modal-body">
        <form id="formUsuario" class="form" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre</label>
            <input type="text" class="form-control border border-gray p-2" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control border border-gray p-2" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control border border-gray p-2" id="exampleInputPassword1" name="password" autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirmar Password</label>
            <input type="password" class="form-control border border-gray p-2" id="exampleInputPassword1" name="password_confirmation" autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Rol</label>
            <select class="form-select border border-gray p-2" aria-label="Default select example" name="role">
              <option selected>Seleccione el Rol</option>
              <option value="admin">Admin</option>
              <option value="leader">Lider</option>
              <option value="comun">Común</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Estado</label>
            <select class="form-select border border-gray p-2" aria-label="Default select example" name="status">
              <option selected>Seleccione el Estado</option>
              <option value="A">Activo</option>
              <option value="I">Inactivo</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Imagen</label>
            <input type="file" class="form-control border border-gray p-2" id="exampleInputPassword1" id="image" name="image">
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
        <h5 class="modal-title" id="EditModalLabel">Editar Usuario - <span id="name"></span></h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
      </div>
      <div class="modal-body">
        <form id="formUsuarioEdit" class="form" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" id="id" name="id">
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Rol</label>
            <select class="form-select border border-gray p-2" aria-label="Default select example" id="role" name="role">
              <option selected>Seleccione el Rol</option>
              <option value="admin">Admin</option>
              <option value="leader">Lider</option>
              <option value="comun">Común</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Estado</label>
            <select class="form-select border border-gray p-2" aria-label="Default select example" id="status" name="status">
              <option selected>Seleccione el Estado</option>
              <option value="A">Activo</option>
              <option value="I">Inactivo</option>
            </select>
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
          var datatableUser;
          
          $(document).ready(function(){
            datatableUser = $('#datatableUser').DataTable({
              ajax: {
                url: '{{ route("usuarios.data") }}',
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
              columns: [
                { data: 'name',
                  dataemail: 'email',
                  render:function(data){
                    return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
                  }
                },
                { data: 'email' ,
                  render:function(data){
                    return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
                  }
                },
                { data: 'role' ,
                  render:function(data){
                    return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
                  }
                },
                {
                  data: 'status',
                  render: function(data) {
                    return data === 'A'
                      ? '<span class="badge bg-success">Activo</span>'
                      : '<span class="badge bg-danger">Inactivo</span>';
                  }
                },
                {
                  data: 'created_at',
                  render: function(data) {
                    return data = '<p class="text-xs text-secondary mb-0">'+moment(data).format('DD-MM-YYYY HH:mm')+'</p>';
                  }
                },
                {
                  data: null,
                  orderable: false,
                  searchable: false,
                  render: function(data, type, row) {
                    return `
                      <a href="javascript:;" class="btn btn-warning text-white" onclick="editUser(${data.id})" data-bs-toggle="modal" data-bs-target="#EditModal">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                      <a onclick="deleteUser(${data.id})" class="btn btn-danger text-white">
                        <i class="fa-solid fa-trash"></i>
                      </a>`;
                  }
                }
              ]
            });
          });

          $('#formUsuario').submit(function(e){
            e.preventDefault();
            let formData = new FormData(this);
            $.ajax({
                url: '{{route('usuarios.store')}}',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response){
                    Swal.fire({
                        icon: 'success',
                        title: 'Exito.',
                        text: 'Usuario registrado correctamente',
                    });
                    
                    $('#exampleModal').modal('hide');
                    datatableUser.ajax.reload();
                },
                error: function(error){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error.',
                        text: 'Error al registrar usuario',
                    });
                    $('#exampleModal').modal('hide');
                }
            });
          });

          $('#formUsuarioEdit').submit(function(e){
            e.preventDefault();
            let id = $('#id').val();
            let formData = new FormData(this);
            $.ajax({
                url: 'usuarios/update/'+id,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                contentType: false,
                data: formData,
                success: function(response){
                    Swal.fire({
                        icon: 'success',
                        title: 'Exito.',
                        text: 'Usuario actualizado correctamente',
                    });
                    
                    $('#EditModal').modal('hide');
                    datatableUser.ajax.reload();
                },
                error: function(error){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error.',
                        text: 'Error al actualizar usuario',
                    });
                    $('#EditModal').modal('hide');
                }
            });
          });

          function editUser(id){
            console.log('entra aqui');
             $.ajax({
                url: 'usuarios/edit/'+id,
                type: 'GET',
                success: function(response){
                    $('#EditModal').modal('show');
                    $('#formUsuselected').attr('action', 'usuarios/update/'+id);
                    $('#role').val(response.role);
                    $('#status').val(response.status);
                    $('#name').text(response.name);
                    $('#id').val(response.id);
                },
                error: function(error){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error.',
                        text: 'Error al editar usuario',
                    });
                }
            });
          }

          function deleteUser(id){
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
                  url: 'usuarios/destroy/'+id,
                  type: 'DELETE',
                  headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(response){
                        Swal.fire({
                            icon: 'success',
                            title: 'Exito.',
                            text: 'Usuario eliminado correctamente',
                        });
                        datatableUser.ajax.reload();
                    },
                    error: function(error){
                        Swal.fire({
                            icon: 'error',
                            title: 'Error.',
                            text: 'Error al eliminar usuario: ' + JSON.stringify(error),
                        });
                    }
                });
              }
            });
          }
    </script>
@endpush
