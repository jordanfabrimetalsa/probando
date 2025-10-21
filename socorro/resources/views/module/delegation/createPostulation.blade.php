<!-- Modal -->
<div class="modal fade" id="CreateModalEventPostulation" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-extra-background">
      <div class="modal-header">
        <h5 class="modal-title" id="CreateModalLabel"><i class="fa-solid fa-people-roof"></i> Crear nuevas postulaciones</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formDelegationEventPostulation" class="form" method="POST" action="{{ route('postulations.store') }}">
          @csrf
          <div class="row">
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Titular<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="title" name="title" required>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Cantidad Max.<span class="text-danger">*</span></label>
                <input type="number" class="form-control border border-gray p-2" id="cant_people_selected" name="cant_people_selected" required>
              </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-12">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Descripción de Requerimientos<span class="text-danger">*</span></label>
                <textarea name="description" id="description" class="form-control border border-gray p-2" required></textarea>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fecha de inicio<span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control border border-gray p-2" id="start_date" name="start_date" required>
              </div>
            </div>
            <div class="col-sm-12 col-md-6 col-lg-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fecha de fin<span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control border border-gray p-2" id="end_date" name="end_date" required>
              </div>
            </div>
            <input type="hidden" name="delegation_id_postulation" id="delegation_id_postulation">
          </div>
          <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Crear Delegación</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
