<!-- Modal -->
<div class="modal fade" id="CreateModalCargo" tabindex="-1" aria-labelledby="CreateModalCargoLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-extra-background">
      <div class="modal-header">
        <h5 class="modal-title" id="CreateModalCargoLabel"><i class="fa-solid fa-user-plus"></i> Crear Cargo</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form id="formCargo" class="form" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre<span class="text-danger">*</span></label>
                <input type="text" {{ old('name') ? 'value="' . old('name') . '"' : '' }} class="form-control border border-gray p-2" id="name" name="name" aria-describedby="emailHelp" required>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Crear Cargo</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

