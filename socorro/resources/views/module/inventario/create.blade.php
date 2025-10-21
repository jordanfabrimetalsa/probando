<!-- Modal -->
<div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-extra-background">
      <div class="modal-header">
        <h5 class="modal-title" id="CreateModalLabel"><i class="fa-brands fa-product-hunt"></i> Agregar Producto</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formInventario" class="form" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="barcode" class="form-label">Código <span class="text-danger">*</span></label>
                <div class="d-flex align-items-stretch gap-2">
                  <button type="button" class="btn btn-dark" id="startScanner"><i class="fa-solid fa-camera"></i></button>
                  <input type="text" class="form-control p-2" id="barcode" name="barcode" required>
                </div>
                <div id="reader" style="width: 100%; display: none; margin-top: 10px;"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="id_warehouse" class="form-label">Bodega<span class="text-danger">*</span></label>
                <div class="d-flex align-items-stretch gap-2">
                  <select class="select2" aria-label="Default select example" id="id_warehouse" name="id_warehouse" required>
                    <option selected disabled>Seleccione la Bodega</option>
                  </select>   
                </div>
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Categoria<span class="text-danger">*</span></label>
                <div class="d-flex align-items-stretch gap-2">
                  <select class="select2" aria-label="Default select example" id="id_category" name="id_category" required>
                    <option selected disabled>Seleccione la Categoria</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Marca<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="brand" name="brand" minLength="3" maxLength="10" required>
              </div>
            </div>
            <div class="col-4">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nombre<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="name" name="name" minLength="1" maxLength="30" required>
              </div>
            </div>
          <div class="col-4">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Descripción<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="description" name="description" minLength="15" maxLength="100" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Color</label>
                <input type="text" class="form-control border border-gray p-2" id="color" name="colour">
              </div>
            </div>
            <div class="col-4">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Talla</label>
                <input type="text" class="form-control border border-gray p-2" id="size" name="size">
              </div>
            </div>
            <div class="col-4">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Estado<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="status" name="status" required>
                  <option selected disabled>Seleccione el Estado</option>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row d-flex justify-content-center mt-4">
            <div class="col-12">
              <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Agregar Producto</button>
            </div>
          </div>
        </form>
            <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#CreateWarehouseModal">
                <i class="fa-solid fa-plus"></i> Nueva Bodega
            </button>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#CreateCategoryModal">
                <i class="fa-solid fa-plus"></i> Nueva Categoria
            </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

