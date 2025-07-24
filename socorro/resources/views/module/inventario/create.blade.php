<!-- Modal -->
<div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="CreateModalLabel">Agregar Producto</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formInventario" class="form" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Codigo<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="barcode" name="barcode" required>
                <div id="scanner"></div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Bodega<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="id_warehouse" name="id_warehouse" required>
                  <option selected disabled>Seleccione la Bodega</option>
                  @foreach ($warehouses as $warehouse)
                    <option value="{{ $warehouse->id }}">{{ $warehouse->name }}</option>
                  @endforeach
                </select>   
                <br>
                <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#CreateWarehouseModal"><i class="fa-solid fa-plus"></i> Crear Bodega</button>                
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Categoria<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="id_category" name="id_category" required>
                  <option selected disabled>Seleccione la Categoria</option>
                  @foreach($categories as $category)  
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                  @endforeach
                </select>
                <br>
                <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#CreateCategoryModal"><i class="fa-solid fa-plus"></i> Crear Categoria</button>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Marca<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="brand" name="brand" minLength="3" maxLength="10" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Nombre<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="name" name="name" minLength="1" maxLength="10" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Descripción<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="description" name="description" minLength="15" maxLength="100" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Color</label>
                <input type="text" class="form-control border border-gray p-2" id="color" name="colour">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Talla</label>
                <input type="text" class="form-control border border-gray p-2" id="size" name="size">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Stock</label>
                <input type="number" class="form-control border border-gray p-2" id="stock" name="stock" min="1" required>
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Precio Unitario</label>
                <input type="number" class="form-control border border-gray p-2" id="price" name="price" min="1" required>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Estado</label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="status" name="status" required>
                  <option selected disabled>Seleccione el Estado</option>
                  <option value="1">Activo</option>
                  <option value="0">Inactivo</option>
                </select>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success btn-sm">Guardar</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

