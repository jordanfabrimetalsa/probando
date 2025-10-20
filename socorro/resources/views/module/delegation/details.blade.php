<!-- Modal -->
<div class="modal fade" id="DetailsModalPostulation" tabindex="-1" aria-labelledby="DetailsModalPostulationLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content modal-extra-background">
        <div class="modal-header">
          <h5 class="modal-title" id="DetailsModalPostulationLabel"><i class="fa-solid fa-circle-info"></i> Detalle de postulación</h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formDelegationEventPostulation" class="form" method="POST">
            <div class="row">
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Titular<span class="text-danger">*</span></label>
                  <input type="text" class="form-control border border-gray p-2" id="titlePostulation" name="titlePostulation" readonly>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Cantidad Max.<span class="text-danger">*</span></label>
                  <input type="number" class="form-control border border-gray p-2" id="cant_people_selectedPostulation" name="cant_people_selectedPostulation" readonly>
                </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-12">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Descripción de Requerimientos<span class="text-danger">*</span></label>
                  <textarea name="descriptionPostulation" id="descriptionPostulation" class="form-control border border-gray p-2" readonly></textarea>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Fecha de inicio<span class="text-danger">*</span></label>
                  <input type="datetime-local" class="form-control border border-gray p-2" id="start_datePostulation" name="start_datePostulation" readonly>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-lg-6">
                <div class="mb-3">
                  <label for="exampleInputEmail1" class="form-label">Fecha de fin<span class="text-danger">*</span></label>
                  <input type="datetime-local" class="form-control border border-gray p-2" id="end_datePostulation" name="end_datePostulation" readonly>
                </div>
              </div>
            </div>
          </form>
          <table id="datatablePostulationsPeople" class="table table-striped dt-responsive nowrap" style="width: 100%;">
            <thead class="bg-gradient-dark text-center">
              <tr class="text-center">
                <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Postulante</th>
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
