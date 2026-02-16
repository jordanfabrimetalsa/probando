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
                <table id="datatableUser" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                  <thead class="bg-gradient-dark text-center">
                    <tr class="text-center">
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Email</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Rol</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Estado</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Ingresado</th>
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
                "search": "<i class='fa-solid fa-magnifying-glass'></i>",
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
                  text: '<i class="fa-solid fa-circle-plus"></i>',
                  className: 'btn btn-dark text-white gap-2 me-2',
                  action: () => $("#CreateModal").modal('show')
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
                      <a href="javascript:;" class="btn btn-dark text-white btn-load" onclick="editUser(${data.id})">
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
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $(this).serialize(),
                success: function(response){
                    Swal.fire({
                        icon: 'success',
                        title: 'Exito.',
                        text: 'Usuario registrado correctamente',
                    });
                    $('#formUsuario')[0].reset();
                    $('#CreateModal').modal('hide');
                    datatableUser.ajax.reload();
                },
                error: function(error){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error.',
                        text: 'Error al registrar usuario',
                    });
                    $('#CreateModal').modal('hide');
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
            $('.btn-load').html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><rect width="7.33" height="7.33" x="1" y="1" fill="currentColor"><animate id="SVGzjrPLenI" attributeName="x" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="1" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="1" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="1" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="1" y="15.66" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="15.66" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="15.66" fill="currentColor"><animate id="SVGXAURnSRI" attributeName="x" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/></rect></svg>').prop('disabled', true);
            console.log('entra aqui');
             $.ajax({
                url: 'usuarios/edit/'+id,
                type: 'GET',
                success: function(response){
                    $('.btn-load').html('<i class="fa-solid fa-pen-to-square"></i>').prop('disabled', false);
                    $('#EditModal').modal('show');
                    $('#formUsuselected').attr('action', 'usuarios/update/'+id);
                    $('#role').val(response.role);
                    $('#status').val(response.status);
                    $('#name').text(response.name);
                    $('#id').val(response.id);

                },
                error: function(error){
                    $('.btn-load').html('<i class="fa-solid fa-pen-to-square"></i>').prop('disabled', false);
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
