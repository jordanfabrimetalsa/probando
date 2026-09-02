<div class="modal fade" id="AddStockModal" tabindex="-1" aria-labelledby="AddStockModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content inventory-action-modal">
      <div class="modal-header inventory-action-header inventory-action-header--add">
        <div class="d-flex align-items-center gap-3"><span class="inventory-action-icon"><i class="fa-solid fa-arrow-trend-up"></i></span><div><small>Movimiento de inventario</small><h5 class="modal-title" id="AddStockModalLabel">Ingresar existencias</h5></div></div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form id="formAddStock" method="POST">@csrf
        <div class="modal-body p-4">
          <input type="hidden" id="product_id_show" name="product_id_show">
          <div class="inventory-product-summary mb-4"><span class="inventory-product-summary__icon"><i class="fa-solid fa-box"></i></span><div><small>Producto seleccionado</small><strong id="add_stock_product_name">Cargando…</strong><span><b id="add_stock_current">—</b> unidades disponibles · <span id="add_stock_warehouse">—</span></span></div></div>
          <div class="row g-3">
            <div class="col-md-6"><label for="add_quantity" class="form-label">Cantidad a ingresar <span class="text-danger">*</span></label><div class="input-group inventory-quantity"><button type="button" class="btn btn-light inventory-step" data-target="add_quantity" data-step="-1">−</button><input type="number" class="form-control text-center" id="add_quantity" name="quantity" min="1" step="1" required><button type="button" class="btn btn-light inventory-step" data-target="add_quantity" data-step="1">+</button></div></div>
            <div class="col-md-6"><label for="unit_cost" class="form-label">Costo unitario <span class="text-danger">*</span></label><div class="input-group"><span class="input-group-text">$</span><input type="number" class="form-control" id="unit_cost" name="unit_cost" min="0" step="1" placeholder="0" required></div></div>
            <div class="col-12"><label for="stock_source" class="form-label">Proveedor u origen <span class="text-danger">*</span></label><input type="text" class="form-control" id="stock_source" name="source" maxlength="150" placeholder="Compra, donación o proveedor" required></div>
            <div class="col-12"><label for="stock_add_reference" class="form-label">Documento de respaldo</label><input type="text" class="form-control" id="stock_add_reference" name="reference" maxlength="100" placeholder="Factura, guía de despacho o acta"></div>
          </div>
          <div class="inventory-result-preview mt-4"><span>Stock resultante</span><strong><span id="add_stock_result">—</span> unidades</strong></div>
        </div>
        <div class="modal-footer px-4"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-success px-4"><i class="fa-solid fa-check me-2"></i>Confirmar entrada</button></div>
      </form>
    </div>
  </div>
</div>
