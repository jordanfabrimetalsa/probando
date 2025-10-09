<!-- Modal -->
<div class="modal fade" id="AddStockModal" tabindex="-1" aria-labelledby="AddStockModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-extra-background">
      <div class="modal-header">
        <h5 class="modal-title" id="AddStockModalLabel"><i class="fa-brands fa-product-hunt"></i> Agregar Stock</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formAddStock" class="form" method="POST">
          @csrf
          <div class="row">
            <input type="hidden" id="product_id_show" name="product_id_show">
            <div class="col-12">
              <div class="mb-3">
                <label for="quantity" class="form-label">Cantidad<span class="text-danger">*</span></label>
                <input type="number" class="form-control border border-gray p-2" id="quantity" name="quantity">
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="unit_cost" class="form-label">Costo Unitario<span class="text-danger">*</span></label>
                <input type="number" class="form-control border border-gray p-2" id="unit_cost" name="unit_cost">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Agregar Stock</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

