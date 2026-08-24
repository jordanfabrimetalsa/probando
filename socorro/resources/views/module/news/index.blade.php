@extends('layout.main')

@section('title', 'noticias')

@section('content')
  <div class="container-fluid py-2">
      <div class="row">
          <div class="col-12">
            <div class="card my-4">
              <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                  <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-newspaper"></i> Administrar Noticias</h6>
                </div>
              </div>
              <div class="card-body p-4">
                <div class="w-100 p-2 mb-4">
                  <table id="datatableNews" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                    <thead class="bg-gradient-dark text-center">
                      <tr>
                        <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Titulo</th>
                        <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Categoria</th>
                        <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Fecha</th>
                        <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Autor</th>
                        <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Destacado</th>
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

  @include('module.news.show')
  @include('module.news.create-category')
  @include('module.news.create')
  @include('module.news.edit')

@endsection

@push('styles')
<style>
  .news-reader-modal .modal-content{border:0!important;border-radius:20px!important}.news-reader__hero{position:relative;min-height:400px;overflow:hidden;background:#0a3545}.news-reader__image{position:absolute;inset:0;width:100%;height:100%;object-fit:cover}.news-reader__shade{position:absolute;inset:0;background:linear-gradient(180deg,rgba(3,25,34,.12) 12%,rgba(3,25,34,.9) 100%)}.news-reader__close{position:absolute;z-index:2;top:20px;right:20px;display:grid;width:42px;height:42px;place-items:center;border:1px solid rgba(255,255,255,.35);border-radius:50%;color:#fff;background:rgba(4,31,41,.5);font-size:1.2rem;backdrop-filter:blur(8px)}.news-reader__heading{position:absolute;z-index:1;right:0;bottom:0;left:0;padding:42px 52px;color:#fff}.news-reader__heading h2{max-width:900px;margin:0 0 18px;color:#fff;font-size:clamp(1.7rem,3vw,2.65rem);font-weight:750;line-height:1.1;letter-spacing:-.035em}.news-reader__category,.news-reader__featured{padding:7px 11px;border-radius:6px;font-size:.67rem;font-weight:800;letter-spacing:.07em;text-transform:uppercase}.news-reader__category{background:#eb4d17;color:#fff}.news-reader__featured{background:rgba(255,255,255,.16);color:#fff;backdrop-filter:blur(8px)}.news-reader__meta{display:flex;flex-wrap:wrap;gap:22px;color:#d8e6eb;font-size:.78rem}.news-reader__meta i{margin-right:6px;color:#ffb092}.news-reader__body{padding:42px 52px!important;background:#fff}.news-reader__content{max-width:850px;margin:auto;color:#324c58;font-size:1rem;line-height:1.85}.news-reader__content>p:first-child{font-size:1.12rem;color:#183744}.news-reader__content img{display:block;max-width:100%!important;height:auto!important;margin:28px auto;border-radius:12px}.news-reader__content h2,.news-reader__content h3{margin-top:1.7em;color:#17313e}.news-reader__footer{justify-content:space-between!important;padding:15px 30px!important;color:#6d818a;font-size:.72rem}.news-reader__footer>span i{margin-right:7px;color:#ea4e1a}
  .news-create-modal .modal-dialog{height:calc(100vh - 2rem);max-height:calc(100vh - 2rem);margin-top:1rem;margin-bottom:1rem}.news-create-modal .modal-content{height:100%;max-height:100%;display:flex;flex-direction:column}.news-create-modal .modal-content>form{display:flex;min-height:0;flex:1;flex-direction:column}.news-form__header{flex:0 0 auto;padding:20px 26px!important}.news-form__header-icon{display:grid;width:44px;height:44px;place-items:center;border-radius:10px;background:#e8f4f7;color:#176985;font-size:1.15rem}.news-form__eyebrow{display:block;margin-bottom:3px;color:#ea4e1a;font-size:.6rem;font-weight:800;letter-spacing:.12em}.news-form__header p{margin:3px 0 0;color:#71868f;font-size:.72rem}.news-form__body{min-height:0;flex:1;overflow-x:hidden;overflow-y:auto;padding:24px!important;background:#f4f7f8;overscroll-behavior:contain}.news-form__section{padding:24px;border:1px solid #dce6ea;border-radius:12px;background:#fff}.news-form__section-title{display:flex;gap:12px;margin-bottom:22px;padding-bottom:16px;border-bottom:1px solid #e7edef}.news-form__section-title>span{display:grid;flex:0 0 32px;height:32px;place-items:center;border-radius:8px;background:#0b4257;color:#fff;font-size:.7rem;font-weight:800}.news-form__section-title h6{margin:0;color:#17313e;font-size:.88rem}.news-form__section-title p{margin:3px 0 0;color:#7a8e97;font-size:.68rem}.news-create-modal .ck-editor__editable{min-height:285px;border-color:#cfdde2!important}.news-create-modal .ck-toolbar{border-color:#cfdde2!important;border-radius:8px 8px 0 0!important;background:#f8fafb!important}.news-cover-upload{position:relative;display:grid;min-height:220px;overflow:hidden;place-items:center;border:1.5px dashed #b9cdd5;border-radius:10px;background:#f7fafb;cursor:pointer;transition:.2s}.news-cover-upload:hover{border-color:#176985;background:#eff7f9}.news-cover-upload img{display:none;position:absolute;inset:0;width:100%;height:100%;object-fit:cover}.news-cover-upload.has-image img{display:block}.news-cover-upload.has-image:after{content:'Cambiar portada';position:absolute;right:12px;bottom:12px;padding:6px 9px;border-radius:6px;background:rgba(5,39,52,.82);color:#fff;font-size:.65rem;font-weight:700}.news-cover-upload__empty{display:flex;align-items:center;flex-direction:column;gap:7px;color:#627983;text-align:center}.news-cover-upload__empty i{color:#176985;font-size:1.8rem}.news-cover-upload__empty strong{font-size:.76rem}.news-cover-upload__empty small{font-size:.62rem}.news-cover-upload.has-image .news-cover-upload__empty{display:none}.news-form__footer{flex:0 0 auto;justify-content:space-between!important;padding:14px 24px!important}.news-form__footer>span{color:#738790;font-size:.67rem}
  @media(max-width:767.98px){.news-reader-modal .modal-dialog{margin:.5rem}.news-reader__hero{min-height:330px}.news-reader__heading{padding:28px 24px}.news-reader__body{padding:28px 24px!important}.news-reader__footer>span,.news-form__footer>span{display:none}.news-create-modal .modal-dialog{height:calc(100dvh - 1rem);max-height:calc(100dvh - 1rem);margin:.5rem}.news-form__body{padding:14px!important}.news-form__section{padding:18px}.news-form__footer{justify-content:flex-end!important}.news-form__footer .d-flex{width:100%}.news-form__footer .btn{flex:1}}
</style>
@endpush

@push('script')
<script>
    var datatableNews;

    $(document).ready(function(){
      datatableNews = $('#datatableNews').DataTable({
        ajax: {
          url: '{{ route("news.data") }}',
          dataSrc: ''
        },
        columns: [
          { data: 'title',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'category.name',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
           },
          { data: 'created_at',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+moment(data).format('DD/MM/YYYY HH:mm:ss')+'</p>'
            }
          },
          { data: 'user.name',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'featured',
            render: function(data){
              return data == true
                ? '<span class="badge bg-danger">Destacado</span>'
                : '<span class="badge bg-warning">No Destacado</span>';
            }
          },
          {
                  data: null,
                  orderable: false,
                  searchable: false,
                  render: function(data, type, row) {
                    return `
                      <div class="d-inline-flex align-items-center gap-1">
                        <button type="button" class="btn btn-dark text-white mb-0" onclick="showNews(${data.id})" title="Ver noticia" aria-label="Ver noticia">
                          <i class="fa-solid fa-newspaper"></i>
                        </button>
                        <button type="button" class="btn btn-danger text-white mb-0" onclick="deleteNews(${data.id})" title="Eliminar noticia" aria-label="Eliminar noticia">
                          <i class="fa-solid fa-trash-can"></i>
                        </button>
                      </div>
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

      getCategoriesNews();

      $('#image').on('change', function() {
        const file = this.files && this.files[0];
        if (!file) return;
        const previewUrl = URL.createObjectURL(file);
        $('#newsImagePreview').attr('src', previewUrl);
        $('#newsCoverUpload').addClass('has-image');
      });
    });

    function getCategoriesNews() {
        $.ajax({
            url: '{{ route("news.category.data") }}',
            type: 'GET',
            success: function(response) {
                let categoryOptions = '<option value="">Seleccione una categoria</option>';
                response.forEach(function(category) {
                    categoryOptions += `<option value="${category.id}">${category.name}</option>`;
                });
                $('#category_id').html(categoryOptions);
            },
            error: function(error) {
                console.error('Error al cargar categorias:', error);
            }
        });
    }

    $('#formNews').submit(function(e){
      e.preventDefault();
      $('#formNews .is-invalid').removeClass('is-invalid');
      $('#formNews .invalid-feedback').text('');
      let formData = new FormData(this);
      const submitButton = $('#submitNews');
      submitButton.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Publicando...');
      $.ajax({
        url: '{{ route("news.store") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Noticia registrada correctamente',
          });
          $('#formNews')[0].reset();
          $('#newsCoverUpload').removeClass('has-image');
          $('#newsImagePreview').attr('src', '');
          $('#CreateModal').modal('hide');
          datatableNews.ajax.reload();
        },
        error: function(xhr){
          const errors = xhr.responseJSON?.errors || {};
          Object.keys(errors).forEach(function(field) {
            const input = $('#formNews [name="' + field + '"]');
            input.addClass('is-invalid');
            const feedback = $('#formNews [data-error-for="' + field + '"]');
            (feedback.length ? feedback : input.closest('.mb-3, .mb-4').find('.invalid-feedback')).first().text(errors[field][0]);
          });
          Swal.fire({
            icon: 'error',
            title: 'Revisa la noticia',
            text: xhr.responseJSON?.message || 'Hay datos que debes corregir antes de publicar.',
          });
        },
        complete: function(){
          submitButton.prop('disabled', false).html('<i class="fa-solid fa-paper-plane me-2"></i>Publicar noticia');
        }
      })
    })

    $('#formCategoryNews').submit(function(e){
      e.preventDefault();
      let formData = $(this).serialize();
      $.ajax({
        url: '{{ route("news.category.store") }}',
        type: 'POST',
        data: formData,
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Categoria de noticia registrado correctamente',
          });
          $('#formCategoryNews')[0].reset();
          $('#CreateCategoryModal').modal('hide');
          getCategoriesNews();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al registrar categoria de noticia',
          });
          $('#CreateCategoryModal').modal('hide');
        }
      })
    })

    function editNews(id){
      $.ajax({
        url: 'news/edit/'+id,
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

    function showNews(id){
      try {
        $.ajax({
          url: 'news/show/' + id,
          type: 'GET',
          success: function(response){
            console.log(response);
            $('#ShowModal').modal('show');
            $('#show-title').text(response.title);
            $('#show-content').html(response.description);
            $('#show-category').text(response.category?.name || '');
            $('#show-image').attr('src', response.image);
            $('#show-created-at').text(moment(response.created_at).format('DD/MM/YYYY HH:mm:ss'));
            $('#show-author').text(response.user?.name || 'Equipo CSA Chile');
            $('#show-featured').toggleClass('d-none', !Boolean(response.featured));
          },
          error: function(error){
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Error al mostrar articulo'
            });
          }
        });
      } catch(e){
        console.error(e);
      }
    }

    function deleteNews(id) {
      Swal.fire({
        icon: 'warning',
        title: '¿Eliminar esta noticia?',
        text: 'La noticia y su imagen de portada se eliminarán definitivamente.',
        showCancelButton: true,
        confirmButtonColor: '#ea4e1a',
        cancelButtonColor: '#647983',
        confirmButtonText: '<i class="fa-solid fa-trash-can me-2"></i>Eliminar',
        cancelButtonText: 'Cancelar',
        reverseButtons: true,
        focusCancel: true
      }).then(function(result) {
        if (!result.isConfirmed) return;

        Swal.fire({
          title: 'Eliminando noticia',
          text: 'Espera un momento...',
          allowOutsideClick: false,
          allowEscapeKey: false,
          didOpen: function() {
            Swal.showLoading();
          }
        });

        $.ajax({
          url: '{{ url("news/destroy") }}/' + id,
          type: 'DELETE',
          data: {
            _token: '{{ csrf_token() }}'
          },
          success: function(response) {
            datatableNews.ajax.reload(null, false);
            Swal.fire({
              icon: 'success',
              title: 'Noticia eliminada',
              text: response.message || 'La noticia fue eliminada correctamente.'
            });
          },
          error: function(xhr) {
            Swal.fire({
              icon: 'error',
              title: 'No se pudo eliminar',
              text: xhr.responseJSON?.message || 'Ocurrió un problema al eliminar la noticia.'
            });
          }
        });
      });
    }

</script>

@endpush
