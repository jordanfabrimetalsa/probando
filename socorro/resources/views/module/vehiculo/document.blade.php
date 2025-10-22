<div class="modal fade" id="DocumentModal" tabindex="-1" aria-labelledby="DocumentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content modal-extra-background">
        <div class="modal-header">
          <h5 class="modal-title" id="DocumentModalLabel"><i class="fa-solid fa-truck-monster"></i> Actualizar Doc. Vehículo</h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formDocumentCar" class="form" method="POST">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="circulation_permit" class="form-label">Circulación</label>
                        <select name="circulation_permit" id="circulation_permit" class="form-control" required>
                            <option value="" selected disabled>Seleccione un modelo</option>
                            <option value="Vigente">Vigente</option>
                            <option value="Vencido">Vencido</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="gases" class="form-label">Gases</label>
                        <select name="gases" id="gases" class="form-control" required>
                            <option value="" selected disabled>Seleccione un modelo</option>
                            <option value="Vigente">Vigente</option>
                            <option value="Vencido">Vencido</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="technical_inspection" class="form-label">Inspección Técnica</label>
                        <select name="technical_inspection" id="technical_inspection" class="form-control" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="Vigente">Vigente</option>
                            <option value="Vencido">Vencido</option>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="insurance" class="form-label">Seguro</label>
                        <select name="insurance" id="insurance" class="form-control" required>
                            <option value="">Seleccione un estado</option>
                            <option value="Vigente">Vigente</option>
                            <option value="Vencido">Vencido</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="hidden" name="car_id_document" id="car_id_document">

            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Actualizar Documentación</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
