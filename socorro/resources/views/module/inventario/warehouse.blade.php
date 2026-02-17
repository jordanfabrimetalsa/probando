<div class="modal fade" id="CreateWarehouseModal" tabindex="-1" aria-labelledby="CreateWarehouseModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-extra-background">
      <div class="modal-header">
        <h5 class="modal-title" id="CreateWarehouseModalLabel"><i class="fa-solid fa-warehouse"></i> Agregar Bodega</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formWarehouse" class="form" method="POST">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="name" class="form-label">Nombre<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="name" name="name">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="description" class="form-label">Descripción<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="description" name="description">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="delegation_id" class="form-label">Delegación<span class="text-danger">*</span></label>
                <select name="delegation_id" id="delegation_id" class="form-control border border-gray p-2">
                  @foreach($delegations as $delegation)
                    <option value="{{ $delegation->id }}">{{ $delegation->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="description" class="form-label">Ubicación<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="path" name="path">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="description" class="form-label">Estado<span class="text-danger">*</span></label>
                <select name="status" id="status" class="form-control border border-gray p-2">
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Crear Bodega</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
