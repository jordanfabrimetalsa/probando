<div class="modal fade" id="RemarkModal" tabindex="-1" aria-labelledby="RemarkModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="RemarkModalLabel">Anotación</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formVoluntaryRemark" class="form" method="POST">
          @csrf
          <input type="hidden" id="id_user_remark" name="id_user_remark">
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Anotación</label>
                <textarea class="form-control border border-gray p-2" id="remark_call" name="remark" required></textarea>
              </div>
            </div>
            <div class="col-12">    
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Gravedad</label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="gravity_edit" name="gravity">
                    <option selected>Seleccione Opción</option>
                    <option value="1">Nula</option>
                    <option value="2">Baja</option>
                    <option value="3">Media</option>
                    <option value="4">Alta</option>
                    <option value="5">Extrema</option>
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
      function showRemark(id){
      $('#id_user_remark').val(id);
      $('#RemarkModal').modal('show');
    }

    $('#formVoluntaryRemark').submit(function(e){
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        url: 'voluntarios/remark',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Anotación registrada correctamente',
          });
          $('#RemarkModal').modal('hide');
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al registrar anotación' + JSON.stringify(error),
          });
          $('#RemarkModal').modal('hide');
        }
      })
    })
</script>