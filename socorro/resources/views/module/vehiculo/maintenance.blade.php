<div class="modal fade" id="MaintenanceModal" tabindex="-1" aria-labelledby="MaintenanceModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content modal-extra-background">
        <div class="modal-header">
          <h5 class="modal-title" id="MaintenanceModalLabel"><i class="fa-solid fa-truck-monster"></i> Registrar Mantención</h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formMaintenanceCar" class="form" method="POST">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="kilometer" class="form-label">Kilometraje de mantenimiento</label>
                        <input type="number" class="form-control border border-gray p-2" id="kilometer" name="kilometer" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="place" class="form-label">Ubicación</label>
                        <input type="text" class="form-control border border-gray p-2" id="place" name="place" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="cost" class="form-label">Costo</label>
                        <input type="number" class="form-control border border-gray p-2" id="cost" name="cost" required>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha</label>
                        <input type="date" class="form-control border border-gray p-2" id="date" name="date" required>
                    </div>
                </div>
            </div>
            <input type="hidden" name="car_id_maintenance" id="car_id_maintenance">

            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Agregar Mantención</button>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
