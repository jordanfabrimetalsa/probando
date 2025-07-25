@extends('layout.main')

@section('title', 'Checklist')

@section('content')

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-icons"></i> Administración de Categorias</h6>
              </div>
            </div>
            <div class="card-body p-4">
              <div class="w-100 p-2 mb-4">
                <button class="btn btn-dark text-white" data-bs-toggle="modal" data-bs-target="#CreateCategoryModal"><i class="fa-solid fa-circle-plus"></i> Agregar Categoria</button>
                <table id="datatableCategory" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                  <thead class="bg-gradient-dark text-center">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Nombre</th>
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

@include('module.checklist.createCategoria')

@endsection

@push('script') 

  <script>
      var datatableCategory;

    $(document).ready(function(){
      datatableCategory = $('#datatableCategory').DataTable({
        ajax:{
          url: '/checklist/categoria/data',
          type: 'GET',
          dataSrc: ''
        },
        columns:[
          {data: 'name', 
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          {
            data: null,
            orderable: false,
            searchable: false,
            render: function(data, type, row) {
              return `
                <a href="javascript:;" class="btn btn-warning text-white" onclick="showCategory(${data.id})" data-bs-toggle="modal" data-bs-target="#ShowModal">
                  <i class="fa-solid fa-file-invoice-dollar"></i>
                </a>
                <a onclick="deleteCategory(${data.id})" class="btn btn-danger text-white">
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
      })

      $('#formCategory').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '/checklist/categoria/store',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response){
              Swal.fire({
                icon: 'success',
                title: 'Exito.',
                text: 'Categoria agregada correctamente',
              });
              $('#CreateCategoryModal').modal('hide');
              datatableCategory.ajax.reload();
            },
            error: function(response){
              Swal.fire({
                icon: 'error',
                title: 'Error.',
                text: 'Error al agregar categoria',
              });
              $('#CreateCategoryModal').modal('hide');
            }
        })
      })
    })

    function deleteCategory(id){
        Swal.fire({
          title: "¿Estas seguro de eliminar la categoria?",
          text: "No podrás revertir esto!",
          icon: "warning",
          showCancelButton: true,
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Si, eliminarlo!",
          input: 'password',
          inputPlaceholder: 'Contraseña Oculta',
          inputValidator: (value) => {
            if (value === "contraseñaOculta") {
              $.ajax({
                url: '/checklist/categoria/destroy/'+id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                  Swal.fire({
                    icon: 'success',
                    title: 'Exito.',
                    text: 'Categoria eliminada correctamente',
                  });
                  datatableCategory.ajax.reload();
                },
                error: function(error){
                  Swal.fire({
                    icon: 'error',
                    title: 'Error.',
                    text: 'Error al eliminar categoria',
                  });
                }
              });
            } else {
              return "La contraseña no es correcta";
            }
          }
        })
      }
    
  </script>

@endpush