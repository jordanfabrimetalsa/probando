<!-- Modal -->
<div class="modal fade" id="ReduceStockModal" tabindex="-1" aria-labelledby="ReduceStockModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-extra-background">
      <div class="modal-header">
        <h5 class="modal-title" id="ReduceStockModalLabel"><i class="fa-brands fa-product-hunt"></i> Reducir Stock</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formReduceStock" class="form" method="POST">
          @csrf
          <div class="row">
            <input type="hidden" id="product_id_reduce" name="product_id_reduce">
            <div class="col-12">
              <div class="mb-3">
                <label for="quantity" class="form-label">Cantidad a Descontar<span class="text-danger">*</span></label>
                <input type="number" class="form-control border border-gray p-2" id="quantity" name="quantity">
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Reducir Stock</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

