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

@push('styles')
<style>
  .user-create-modal *{box-sizing:border-box}.user-create-modal .modal-dialog{width:calc(100% - 2rem);max-width:820px;height:calc(100vh - 2rem);max-height:calc(100vh - 2rem);margin:1rem auto}.user-create-modal .modal-content{display:flex;width:100%;height:100%;max-height:100%;flex-direction:column}.user-create-modal .modal-content>form{display:flex;min-width:0;min-height:0;flex:1;flex-direction:column}.user-form__header{flex:0 0 auto;padding:19px 24px!important}.user-form__icon{display:grid;width:44px;height:44px;place-items:center;border-radius:10px;background:#e8f4f7;color:#176985;font-size:1.1rem}.user-form__eyebrow{display:block;margin-bottom:3px;color:#ea4e1a;font-size:.59rem;font-weight:800;letter-spacing:.12em}.user-form__header p{margin:3px 0 0;color:#71868f;font-size:.7rem}.user-form__body{min-width:0;min-height:0;flex:1;overflow-x:hidden;overflow-y:auto;padding:20px 24px!important;background:#f3f7f8}.user-form__section{min-width:0;margin-bottom:15px;padding:20px;border:1px solid #dbe6ea;border-radius:12px;background:#fff}.user-form__section:last-child{margin-bottom:0}.user-form__section-heading{display:flex;gap:11px;margin-bottom:17px;padding-bottom:13px;border-bottom:1px solid #e7edef}.user-form__section-heading>span{display:grid;flex:0 0 31px;height:31px;place-items:center;border-radius:8px;background:#0b4257;color:#fff;font-size:.66rem;font-weight:800}.user-form__section-heading h6{margin:0;color:#17313e;font-size:.86rem}.user-form__section-heading p{margin:3px 0 0;color:#7a8e97;font-size:.65rem}.user-create-modal .select2-container{display:block;width:100%!important;max-width:100%!important}.user-create-modal .select2-selection--single{height:44px!important;padding:7px 34px 7px 10px!important;border:1px solid #cfdde2!important;border-radius:8px!important}.user-create-modal .select2-selection__rendered{overflow:hidden;padding:0!important;color:#294653!important;line-height:28px!important;text-overflow:ellipsis;white-space:nowrap}.user-create-modal .select2-selection__arrow{height:42px!important}.select2-container--open{z-index:1080}.user-voluntary-card{position:relative;display:flex;min-width:0;align-items:center;gap:14px;margin-top:15px;padding:15px;border:1px solid #cfe0e6;border-radius:10px;background:linear-gradient(135deg,#f3f9fb,#fff)}.user-voluntary-card>img{width:55px;height:55px;border:3px solid #fff;border-radius:10px;object-fit:cover;box-shadow:0 3px 10px rgba(11,66,87,.12)}.user-voluntary-card__main{display:flex;min-width:0;flex:1;flex-direction:column}.user-voluntary-card__main>strong{overflow:hidden;color:#173744;font-size:.86rem;text-overflow:ellipsis;white-space:nowrap}.user-voluntary-card__main>span{margin-top:2px;color:#71868f;font-size:.66rem}.user-voluntary-card__tags{display:flex;flex-wrap:wrap;gap:6px;margin-top:8px}.user-voluntary-card__tags span{padding:4px 7px;border-radius:5px;background:#e5f0f4;color:#315b6b;font-size:.59rem}.user-voluntary-card__tags i{margin-right:3px;color:#176985}.user-voluntary-card__status{align-self:flex-start;padding:5px 8px;border-radius:10px;background:#e5f6eb;color:#178248;font-size:.59rem;font-weight:800;text-transform:uppercase}.user-field-help{display:block;margin-top:5px;color:#7b8e96;font-size:.62rem}.user-form__footer{flex:0 0 auto;justify-content:space-between!important;padding:13px 22px!important}.user-form__footer>span{color:#71868e;font-size:.64rem}.user-form__footer>span i{margin-right:5px;color:#176985}.user-create-modal .input-group{flex-wrap:nowrap}.user-create-modal .input-group>.form-control{min-width:0}.user-create-modal .input-group-text{border-color:#cfdde2;background:#f5f8f9;color:#5e7883}.user-create-modal .toggle-user-password{flex:0 0 42px;border-color:#cfdde2!important}
  @media(max-width:767.98px){.user-create-modal .modal-dialog{height:calc(100dvh - 1rem);max-height:calc(100dvh - 1rem);margin:.5rem}.user-form__body{padding:14px!important}.user-form__section{padding:17px}.user-form__footer>span{display:none}.user-form__footer .d-flex{width:100%}.user-form__footer .btn{flex:1}.user-voluntary-card__status{display:none}}
</style>
@endpush

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
            $('#formUsuario .is-invalid').removeClass('is-invalid');
            $('#formUsuario .invalid-feedback').text('');
            const submitButton = $('#submitUsuario');
            submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Creando cuenta...');
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
                error: function(xhr){
                    const errors = xhr.responseJSON?.errors || {};
                    Object.keys(errors).forEach(function(field){
                      const input = $('#formUsuario [name="' + field + '"]');
                      input.addClass('is-invalid');
                      $('#formUsuario [data-error-for="' + field + '"]').text(errors[field][0]);
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Revisa los datos',
                        text: Object.values(errors)[0]?.[0] || xhr.responseJSON?.error || 'No fue posible crear el usuario.',
                    });
                },
                complete: function(){
                    submitButton.prop('disabled', false).html('<i class="fa-solid fa-user-plus me-2"></i>Crear usuario');
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
