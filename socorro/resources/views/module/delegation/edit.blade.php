<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-extra-background">
      <div class="modal-header">
        <h5 class="modal-title" id="EditModalLabel"><i class="fa-solid fa-people-roof"></i> Editar Delegación</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formDelegationEdit" class="form" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" id="id" name="id">
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="name_edit" name="name" readonly>
              </div>
            </div>
          </div>
          <!--<button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Editar Delegación</button>-->
        </form>

        <label for="exampleInputEmail1" class="form-label">Voluntarios pertenecientes a esta delegación</label>
        <div class="text-center">
          <table id="datatableVoluntaries" class="table table-striped dt-responsive nowrap" style="width: 100%;">
            <thead class="bg-gradient-dark text-center">
              <tr class="text-center">
                <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombre</th>
                <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Tipo</th>
              </tr>
            </thead>
            <tbody class="text-center">
            </tbody>
          </table>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
