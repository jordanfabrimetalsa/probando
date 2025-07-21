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

<script>
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
</script>