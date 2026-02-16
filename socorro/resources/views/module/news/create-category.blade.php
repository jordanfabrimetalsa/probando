<div class="modal fade" id="CreateCategoryModal" tabindex="-1" aria-labelledby="CreateCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-extra-background">
      <div class="modal-header">
        <h5 class="modal-title" id="CreateCategoryModalLabel"><i class="fa-solid fa-comment-dots"></i> Crear Categoria</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formVoluntaryRemark" class="form" method="POST">
          @csrf
          <input type="hidden" id="id_user_remark" name="id_user_remark">
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nombre</label>
                <textarea class="form-control border border-gray p-2" id="remark_call" name="remark" required></textarea>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Ingresar</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
