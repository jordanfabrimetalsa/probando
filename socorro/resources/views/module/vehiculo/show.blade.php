<div class="modal fade" id="ShowModal" tabindex="-1" aria-labelledby="ShowModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-extra-background">
      <div class="modal-header">
        <h5 class="modal-title" id="ShowModalLabel">Información del Vehículo</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid">
          <div class="page-header min-height-100">
          </div>
          <div class="card card-body mt-n6 mb-4">
            <div class="row gx-4 mb-2">
              <div class="col-auto my-auto">
                <div class="h-100">
                  <p class="mb-0 font-weight-normal text-sm">
                    <span id=""></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card card-plain h-100">
                  <div class="card-header pb-0 p-3">
                    <h5 class="mb-0">Información Vehículo</h5>
                  </div>
                    <div class="card-body p-3 row">
                      <div class="col-md-6">
                        <ul class="list-group">
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Kilometraje:</strong> &nbsp; <span id="kilometer_show"></span></li>
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Marca:</strong> &nbsp; <span id="brand_show"></span></li>
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Modelo:</strong> &nbsp; <span id="model_show"></span></li>
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Patente:</strong> &nbsp; <span id="plate_show"></span></li>
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Chasis:</strong> &nbsp; <span id="chassis_show"></span></li>
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Motor:</strong> &nbsp; <span id="motor_show"></span></li>
                        </ul>
                      </div>
                      <div class="col-md-6">
                        <ul class="list-group">
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Año:</strong> &nbsp; <span id="year_show"></span></li>
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Color:</strong> &nbsp; <span id="color_show"></span></li>
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tipo:</strong> &nbsp; <span id="type_show"></span></li>
                          <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Delegación:</strong> &nbsp; <span id="delegation_show"></span></li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                      <h5 class="mb-0">Información Mantención</h5>
                    </div>
                    <div class="card-body p-3">
                      <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Kilometraje:</strong> &nbsp; <span id="blood_type_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Lugar:</strong> &nbsp; <span id="place_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Costo:</strong> &nbsp; <span id="cost_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Fecha:</strong> &nbsp; <span id="date_show"></span></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                      <h5 class="mb-0">Documentación</h5>
                    </div>
                    <div class="card-body p-3">
                      <ul class="list-group" id="document_name_show">
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                      <h5 class="mb-0">Gasto</h5>
                    </div>
                    <div class="card-body p-3">
                      <ul class="list-group" id="expense_name_show">
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
