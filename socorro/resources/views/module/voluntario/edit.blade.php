<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-extra-background">
      <div class="modal-header">
        <h5 class="modal-title" id="EditModalLabel"><i class="fa-solid fa-pen-to-square"></i> Editar Voluntario</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formVoluntaryEdit" class="form" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" id="id" name="id">
          <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Asignar Cargo</label>
                    <select class="form-select border border-gray p-2" aria-label="Default select example" id="cargo_edit" name="cargo_edit">
                        <option value="" selected>Seleccione Opción</option>
                        @foreach($cargos as $cargo)
                            <option value="{{ $cargo->id }}">{{ $cargo->nombre }}</option>
                        @endforeach
                        <option value="">Sin Cargo</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Grupo Sanguineo</label>
                    <select class="form-select border border-gray p-2" aria-label="Default select example" id="blood_type_edit" name="blood_type">
                        <option value="" selected>Seleccione Opción</option>
                        <option value="A+">A+</option>
                        <option value="A-">A-</option>
                        <option value="B+">B+</option>
                        <option value="B-">B-</option>
                        <option value="AB+">AB+</option>
                        <option value="AB-">AB-</option>
                        <option value="O+">O+</option>
                        <option value="O-">O-</option>
                    </select>
                </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">¿Tiene Vehiculo?</label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="vehicle_edit" name="vehicle">
                    <option selected>Seleccione Opción</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">¿Tiene Licencia Clase B?</label>
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
                  <option value="A">Activo</option>
                  <option value="I">Inactivo</option>
                  <option value="S">Suspendido</option>
                  <option value="R">Receso</option>
                </select>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Guardar Cambios</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
