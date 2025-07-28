<!-- Modal -->
<div class="modal fade" id="QuestionModal" tabindex="-1" aria-labelledby="QuestionModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="QuestionModalLabel"><i class="fa-solid fa-icons"></i> Agregar Pregunta</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formQuestion" class="form" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Pregunta</label>
                <input type="text" class="form-control" id="name" name="name" required>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Cantidad</label>
                <input type="number" class="form-control" id="quantity" name="quantity" required>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Estado</label>
                <select class="form-select" id="status" name="status" required>
                    <option selected disabled>Seleccione un Estado</option>
                    <option value="Y">Activo</option>
                    <option value="N">Inactivo</option>
                </select>
              </div>
            </div>
            <input type="hidden" id="id_category_check" name="id_category_check">
          </div>
          <div class="row d-flex justify-content-center mt-4">
            <div class="col-12">
              <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Agregar Pregunta</button>
            </div>
          </div>
        </form>
        <hr>
        <table id="datatableQuestion" class="table table-striped dt-responsive nowrap" style="width: 100%;">
          <thead class="bg-gradient-dark text-center">
            <tr>
              <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Nombre</th>
              <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Cantidad</th>
              <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder">Estado</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

