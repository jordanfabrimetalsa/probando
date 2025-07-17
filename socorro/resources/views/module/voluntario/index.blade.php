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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Voluntario</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
      </div>
      <div class="modal-body">
        <form id="formVoluntario" class="form" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Delegación<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" name="role">
                    <option selected>Seleccione Opción</option>
                    <option value="S">Sí</option>
                    <option value="N">No</option>
                </select>   
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label>Imagen</label>
                <input type="file" class="form-control border border-gray p-2" id="exampleInputPassword1" id="image" name="image">
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Número de Documento<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Apellido<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="exampleInputEmail1" name="lastname" aria-describedby="emailHelp">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control border border-gray p-2" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Telefono<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="exampleInputEmail1" name="phone" aria-describedby="emailHelp">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fecha Nacimiento<span class="text-danger">*</span></label>
                <input type="date" class="form-control border border-gray p-2" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Sexo<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" name="type">
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
                <select class="form-select border border-gray p-2" aria-label="Default select example" name="role">
                    <option selected>Seleccione Opción</option>
                    <option value="S">Sí</option>
                    <option value="N">No</option>
                </select>   
              </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Enfermedad<span class="text-danger">*</span></label>
                  <select class="form-select border border-gray p-2" aria-label="Default select example" name="role">
                      <option selected>Seleccione Opción</option>
                      <option value="S">Sí</option>
                      <option value="N">No</option>
                  </select>
                </div>  
              </div>
              <div class="col-4">
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Medicamento<span class="text-danger">*</span></label>
                  <select class="form-select border border-gray p-2" aria-label="Default select example" name="role">
                      <option selected>Seleccione Opción</option>
                      <option value="S">Sí</option>
                      <option value="N">No</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">¿Tiene Vehiculo?<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" name="type">
                    <option selected>Seleccione Opción</option>
                    <option value="S">Sí</option>
                    <option value="N">No</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">¿Tiene Licencia de Conducir Clase B?<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" name="type">
                    <option selected>Seleccione Opción</option>
                    <option value="S">Sí</option>
                    <option value="N">No</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control border border-gray p-2" id="exampleInputPassword1" name="password_confirmation" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Estado</label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" name="status">
                  <option selected>Seleccione el Estado</option>
                  <option value="A">Activo</option>
                <option value="I">Inactivo</option>
              </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Tipo de Socorrista</label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" name="type">
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
        <h5 class="modal-title" id="EditModalLabel">Editar Voluntario - <span id="name"></span></h5>
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
    $(document).ready(function(){
      $('#datatableVoluntaries').DataTable({
        $.ajax{
          url: '{{ route("voluntarios.data") }}',
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
        dom:
                "<'row mb-2'<'col-md-6 d-flex align-items-center'B><'col-md-6'f>>" +
                "<'row'<'col-12'tr>>" +
                "<'row mt-2'<'col-md-6'i><'col-md-6'p>>",
        responsive:{
          details:{
            type: 'inline'
          }
        },
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
          },
          {
            extend: 'csvHtml5',
            text: '<i class="fa-solid fa-file-csv"></i>',
            className: 'btn btn-info me-2'
          }
        ]
      });
    });
</script>

@endpush