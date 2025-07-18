<div class="modal fade" id="EmergencyModal" tabindex="-1" aria-labelledby="EmergencyModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EmergencyModalLabel">Agregar Número de Emergencia</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formVoluntaryEmergency" class="form" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" id="id" name="id">
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nombre de Emergencia</label>
                <input type="text" class="form-control border border-gray p-2" id="emergency_name_call" name="emergency_name" required>
              </div>
            </div>
            <div class="col-12">    
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Número de Emergencia</label>
                <input type="number" class="form-control border border-gray p-2" id="emergency_call" name="emergency" required>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Relación</label>
                <input type="text" class="form-control border border-gray p-2" id="relationship_call" name="relationship" required>
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