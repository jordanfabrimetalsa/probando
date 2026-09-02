<div class="modal fade" id="ReduceStockModal" tabindex="-1" aria-labelledby="ReduceStockModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content inventory-action-modal">
      <div class="modal-header inventory-action-header inventory-action-header--reduce">
        <div class="d-flex align-items-center gap-3"><span class="inventory-action-icon"><i class="fa-solid fa-arrow-trend-down"></i></span><div><small>Movimiento de inventario</small><h5 class="modal-title" id="ReduceStockModalLabel">Registrar salida</h5></div></div>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <form id="formReduceStock" method="POST">@csrf
        <div class="modal-body p-4">
          <input type="hidden" id="product_id_reduce" name="product_id_reduce">
          <div class="inventory-product-summary mb-4"><span class="inventory-product-summary__icon"><i class="fa-solid fa-box-open"></i></span><div><small>Producto seleccionado</small><strong id="reduce_stock_product_name">Cargando…</strong><span><b id="reduce_stock_current">—</b> unidades disponibles · <span id="reduce_stock_warehouse">—</span></span></div></div>
          <div class="inventory-warning mb-3"><i class="fa-solid fa-circle-info"></i><span>La salida reducirá inmediatamente las existencias y quedará registrada en el historial.</span></div>
          <div class="row g-3">
            <div class="col-12"><label for="reduce_quantity" class="form-label">Cantidad a retirar <span class="text-danger">*</span></label><div class="input-group inventory-quantity"><button type="button" class="btn btn-light inventory-step" data-target="reduce_quantity" data-step="-1">−</button><input type="number" class="form-control text-center" id="reduce_quantity" name="quantity" min="1" step="1" required><button type="button" class="btn btn-light inventory-step" data-target="reduce_quantity" data-step="1">+</button></div><small class="text-muted">No puede superar el stock disponible.</small></div>
            <div class="col-12"><label for="stock_reason" class="form-label">Motivo o destino <span class="text-danger">*</span></label><input type="text" class="form-control" id="stock_reason" name="reason" maxlength="180" placeholder="Entrega a operativo, préstamo o baja por daño" required></div>
            <div class="col-12"><label for="stock_reduce_reference" class="form-label">Documento o responsable</label><input type="text" class="form-control" id="stock_reduce_reference" name="reference" maxlength="100" placeholder="Número de acta, operativo o persona responsable"></div>
          </div>
          <div class="inventory-result-preview inventory-result-preview--reduce mt-4"><span>Stock resultante</span><strong><span id="reduce_stock_result">—</span> unidades</strong></div>
        </div>
        <div class="modal-footer px-4"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-danger px-4"><i class="fa-solid fa-arrow-down me-2"></i>Confirmar salida</button></div>
      </form>
    </div>
  </div>
</div>
