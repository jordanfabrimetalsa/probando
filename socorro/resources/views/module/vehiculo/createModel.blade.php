<!-- Modal -->
<div class="modal fade" id="CreateModelModal" tabindex="-1" aria-labelledby="CreateModelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content modal-extra-background">
        <div class="modal-header">
          <h5 class="modal-title" id="CreateModelModalLabel"><i class="fa-solid fa-icons"></i> Agregar Modelo de Vehículo</h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formModel" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <label for="name" class="form-label">Nombre Modelo</label>
                  <input type="text" class="form-control" id="name" name="name" required>
                </div>
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <label for="brand_id" class="form-label">Marca</label>
                  <select name="brand_id" id="brand_id" class="form-control">
                    <option value="">Seleccione una marca</option>
                    @foreach ($brands as $brand)
                      <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>
              <input type="hidden" id="id_category_check" name="id_category_check">
            </div>
            <div class="row d-flex justify-content-center mt-4">
              <div class="col-12">
                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Guardar Marca</button>
              </div>
            </div>
          </form>
          <hr>
          <table id="datatableModel" class="table table-striped dt-responsive nowrap" style="width: 100%;">
            <thead class="bg-gradient-dark text-center">
              <tr>
                <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombre</th>
                <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Marca</th>
              </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
</div>
  
  
  