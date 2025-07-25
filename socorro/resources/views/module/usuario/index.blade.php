@extends('layout.main')

@section('title', 'Usuarios')

@section('content')

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-user-tie"></i> Administración de Usuarios</h6>
              </div>
            </div>
            <div class="card-body p-4">
              <div class="w-100 p-2 mb-4">
                <button class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-circle-plus"></i> Agregar Usuario</button>
                <table id="datatableUser" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                  <thead class="bg-gradient-dark text-center">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Email</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Rol</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Estado</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Ingresado</th>
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

@include('module.usuario.create')
@include('module.usuario.edit')

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
              responsive: {
                details: {
                  type: 'inline'
                }
              },
              dom:
                "<'row mb-2'<'col-md-6 d-flex align-items-center'B><'col-md-6'f>>" +
                "<'row'<'col-12'tr>>" +
                "<'row mt-2'<'col-md-6'i><'col-md-6'p>>",
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
            $.ajax({
                url: 'usuarios/update/'+id,
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $(this).serialize(),
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
