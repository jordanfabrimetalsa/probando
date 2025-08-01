<div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="CreateModalLabel"><i class="fa-solid fa-user-tie"></i> Registrar Usuario</h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formVehiculo" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label for="brand_id" class="form-label">Marca</label>
              <select name="brand_id" id="brand_id" class="form-control" required>
                <option value="">Seleccione una marca</option>
                @foreach ($brands as $brand)
                  <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="exampleInputEmail1" class="form-label">Modelo</label>
              <select name="model_id" id="model_id" class="form-control">
                <option value="">Seleccione un modelo</option>
                @foreach ($models as $model)
                  <option value="{{ $model->id }}">{{ $model->name }}</option>
                @endforeach
              </select>
            </div>
            <div class="mb-3">
              <label for="plate" class="form-label">Patente</label>
              <input type="text" class="form-control border border-gray p-2" id="plate" name="plate" maxlength="7" autocomplete="off" required>
            </div>
            <div class="mb-3">
              <label for="chassis" class="form-label">Chasis</label>
              <input type="text" class="form-control border border-gray p-2" id="chassis" name="chassis" maxlength="17" autocomplete="off" required>
            </div>
            <div class="mb-3">
              <label for="colour" class="form-label">Color</label>
              <input type="text" class="form-control border border-gray p-2" name="colour" id="colour" maxlength="20" autocomplete="off" required>
            </div>
            <div class="mb-3">
              <label for="year" class="form-label">Año</label>
              <input type="number" class="form-control border border-gray p-2" name="year" id="year" min="1900" max="2100" autocomplete="off" required>
            </div>
            <div class="mb-3">
              <label for="motor" class="form-label">Motor</label>
              <input type="text" class="form-control border border-gray p-2" name="motor" id="motor" maxlength="20" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label for="type" class="form-label">Tipo</label>
                <select name="type" id="type" class="form-control" required>
                  <option value="">Seleccione un tipo</option>
                  <option value="4x4">4x4</option>
                  <option value="4x2">4x2</option>
                  <option value="City">City</option>
                </select>
              </div>
            <div class="mb-3">
              <label for="status" class="form-label">Estado</label>
              <select name="status" id="status" class="form-control" required>
                <option value="">Seleccione un estado</option>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
            </div>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Agregar Vehículo</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>