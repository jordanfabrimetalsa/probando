<div class="modal fade" id="ShowModal" tabindex="-1" aria-labelledby="ShowModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ShowModalLabel">Información de Voluntario</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="page-header min-height-100">
          </div>
          <div class="card card-body mt-n6 mb-4">
            <div class="row gx-4 mb-2">
              <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                  <img src="../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
              </div>
              <div class="col-auto my-auto">
                <div class="h-100">
                  <h5 class="mb-1">
                    <span id="fullname_title_show"></span>
                  </h5>
                  <p class="mb-0 font-weight-normal text-sm">
                    <span id="type_show"></span> - Delegación <span id="delegation_show"></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card card-plain h-100">
                  <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Información Personal</h6>
                  </div>
                    <div class="card-body p-3">
                      <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nombre Completo:</strong> &nbsp; <span id="fullname_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Número de Identificación:</strong> &nbsp; <span id="document_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Fecha de Nacimiento:</strong> &nbsp; <span id="birthday_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Genero:</strong> &nbsp; <span id="gender_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <span id="email_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Dirección:</strong> &nbsp; <span id="address_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Profesión:</strong> &nbsp; <span id="profession_show"></span></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                      <h6 class="mb-0">Información Médica</h6>
                    </div>
                    <div class="card-body p-3">
                      <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tipo de Sangre:</strong> &nbsp; <span id="blood_type_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Alergico:</strong> &nbsp; <span id="allergic_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Enfermedad:</strong> &nbsp; <span id="disease_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Medicamento:</strong> &nbsp; <span id="medicine_show"></span></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                      <h6 class="mb-0">Configuración</h6>
                    </div>
                    <div class="card-body p-3">
                      <ul class="list-group">
                        <li class="list-group-item border-0 px-0">
                          <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="status_show" checked>
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="status_show" id="text_status_show"></label>
                          </div>
                          <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="payment_show" checked>
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="payment_show" id="text_payment_show"></label>
                          </div>
                          <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="license_show" checked>
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="license_show" id="text_license_show"></label>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                      <h6 class="mb-0">Números de Emergencia</h6>
                    </div>
                    <div class="card-body p-3">
                      <ul class="list-group" id="emergency_name_show">
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                      <h6 class="mb-0">Anotaciones</h6>
                    </div>
                    <div class="card-body p-3">
                      <ul class="list-group" id="remark_name_show">
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
