<!-- Modal -->
<div class="modal fade" id="CreateCategoryModal" tabindex="-1" aria-labelledby="CreateCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CreateCategoryModalLabel"><i class="fa-solid fa-icons"></i> Agregar Categoria</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formCategory" class="form" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Delegación</label>
                <select class="form-select" id="id_delegation" name="id_delegation" required>
                  @foreach($delegations as $delegation)
                    <option selected disabled>Seleccione una Delegación</option>
                    <option value="{{ $delegation->id }}">{{ $delegation->name }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="row d-flex justify-content-center mt-4">
            <div class="col-12">
              <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Agregar Categoria</button>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

