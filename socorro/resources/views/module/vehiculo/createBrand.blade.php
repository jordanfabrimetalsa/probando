<!-- Modal -->
<div class="modal fade" id="CreateBrandModal" tabindex="-1" aria-labelledby="CreateBrandModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="CreateBrandModalLabel"><i class="fa-solid fa-icons"></i> Agregar Marca de Vehículo</h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formBrand" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
              <div class="col-12">
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label">Nombre Marca</label>
                  <input type="text" class="form-control" id="name" name="name" required>
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
          <table id="datatableBrand" class="table table-striped dt-responsive nowrap" style="width: 100%;">
            <thead class="bg-gradient-dark text-center">
              <tr>
                <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombre</th>
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
  
  
  