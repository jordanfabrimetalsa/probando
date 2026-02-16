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

  @include('module.news.create')
  @include('module.news.edit')
  @include('module.news.show')

@endsection

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
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
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
                      <a href="javascript:;" class="btn btn-info text-white" onclick="showNews(${data.id})" data-bs-toggle="modal" data-bs-target="#ShowModal">
                        <i class="fa-solid fa-car"></i>
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

      getCategoriesNews();
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
      let formData = new FormData(this);
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
          $('#CreateModal').modal('hide');
          datatableNews.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al registrar noticia' + JSON.stringify(error),
          });
          $('#CreateModal').modal('hide');
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
          datatableCategoryNews.ajax.reload();
          getCategoriesNews();
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
            if (typeof response === 'string'){
              response = JSON.parse(response);
            }

            $('#ShowModal').modal('show');
            $('#kilometer_show').text(`${response.kilometer.toLocaleString('es-CL')} km`);
            $('#brand_show').text(response.brand?.name || '');
            $('#model_show').text(response.model?.name || '');
            $('#plate_show').text(response.plate);

            if (response.document_car) {
              $('#circulation_permit_show').html(response.document_car.circulation_permit == 'Vigente' ? '<span class="badge bg-success">Vigente</span>' : '<span class="badge bg-danger">Vencido</span>');
              $('#gases_show').html(response.document_car.gases == 'Vigente' ? '<span class="badge bg-success">Vigente</span>' : '<span class="badge bg-danger">Vencido</span>');
              $('#technical_inspection_show').html(response.document_car.technical_inspection == 'Vigente' ? '<span class="badge bg-success">Vigente</span>' : '<span class="badge bg-danger">Vencido</span>');
              $('#insurance_show').html(response.document_car.insurance == 'Vigente' ? '<span class="badge bg-success">Vigente</span>' : '<span class="badge bg-danger">Vencido</span>');
            } else {
              $('#circulation_permit_show, #gases_show, #technical_inspection_show, #insurance_show').html('Sin datos');
            }

            var maintenance = '';
            if (response.maintenance && response.maintenance.length > 0) {
              response.maintenance.forEach(element => {
                maintenance += `
                  <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                    <div class="d-flex align-items-start flex-column justify-content-center">
                      <h6 class="mb-0 text-sm">Lugar: ${element.place} / ${element.kilometer.toLocaleString('es-CL')} KM</h6>
                      <p class="mb-0 text-xs">Costo: $${element.cost.toLocaleString('es-CL')} <span class="badge bg-danger">${element.date}</span></p>
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

</script>

@endpush
