<!-- Modal -->
<div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CreateModalLabel"><i class="fa-solid fa-people-roof"></i> Registrar Delegación</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formDelegation" class="form" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="name" name="name" required>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Región de la Sede<span class="text-danger">*</span></label>
                <select name="region_id" id="region_id" class="form-control border border-gray p-2">
                  <option value="">Seleccione una región</option>
                  @foreach($regions as $region)
                    <option value="{{ $region->id }}">{{ $region->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="image" class="form-label">Imagen Referencial<span class="text-danger">*</span></label>
                <input type="file" name="image" id="image" class="form-control border border-gray p-2" accept="image/png,image/jpeg,image/jpg" required>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Crear Delegación</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
