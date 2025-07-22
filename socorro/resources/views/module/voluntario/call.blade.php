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
          <input type="hidden" id="id_user_emergency" name="id_user_emergency">
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nombre de Emergencia</label>
                <input type="text" class="form-control border border-gray p-2" id="emergency_name" name="emergency_name" required>
              </div>
            </div>
            <div class="col-12">    
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Número de Emergencia</label>
                <input type="number" class="form-control border border-gray p-2" id="emergency_phone" name="emergency_phone" required>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Relación</label>
                <select class="form-control" name="relationship">
                  <option value="">Seleccione una opción</option>
                  <option value="padre">Padre</option>
                  <option value="madre">Madre</option>
                  <option value="hermano">Hermano</option>
                  <option value="hermana">Hermana</option>
                  <option value="tio">Tio</option>
                  <option value="tia">Tia</option>
                  <option value="primo">Primo</option>
                  <option value="prima">Prima</option>
                  <option value="abuela">Abuela</option>
                  <option value="abuelo">Abuelo</option>
                  <option value="otro">Otro</option>
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
