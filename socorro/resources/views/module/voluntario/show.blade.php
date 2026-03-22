<div class="modal fade" id="ShowModal" tabindex="-1" aria-labelledby="ShowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-extra-background">
            <div class="modal-header">
                <h5 class="modal-title" id="ShowModalLabel">Información de Voluntario</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="page-header min-height-100">
                    </div>
                    <div class="card card-body mt-n6 mb-4">
                        <div class="row gx-4 mb-2">
                            <div class="col-auto my-auto">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-plain h-100">
                                    <div class="text-center mb-4">
                                        <div class="position-relative d-inline-block">
                                            <img id="image_show" src="" alt="Foto del voluntario"
                                                class="rounded-circle"
                                                style="width: 120px; height: 120px; object-fit: cover; border: 4px solid #fff;">
                                            <div class="position-absolute bottom-0 end-0 bg-success rounded-circle p-1"
                                                style="width: 30px; height: 30px;"><i
                                                    class="fa-solid fa-check text-white" style="font-size: 12px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header pb-0 p-3">
                                        <h5 class="mb-0">Información Personal</h5>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-group">
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Nombre Completo:</strong> &nbsp; <span
                                                            id="fullname_show"></span></li>
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Número de Identificación:</strong> &nbsp;
                                                        <span id="document_show"></span>
                                                    </li>
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Genero:</strong> &nbsp; <span
                                                            id="gender_show"></span></li>
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Fecha de Nacimiento:</strong> &nbsp; <span
                                                            id="birthday_show"></span></li>
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Edad</strong> &nbsp; <span
                                                            id="age_show"></span></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-group">
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Profesión:</strong> &nbsp; <span
                                                            id="profession_show"></span></li>
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Dirección:</strong> &nbsp; <span
                                                            id="address_show"></span></li>
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Teléfono:</strong> &nbsp; <span
                                                            id="phone_show"></span></li>
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Estado:</strong> &nbsp; <span
                                                            id="status_show"></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-plain h-100">
                                    <div class="card-header pb-0 p-3">
                                        <h5 class="mb-0">Información Voluntariado</h5>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-group">
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Tipo:</strong> &nbsp; <span
                                                            id="type_show"></span></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-group">
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Cargo:</strong> &nbsp; <span
                                                            id="cargo_show"></span></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-group">
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Fecha Inicio Voluntariado:</strong> &nbsp; <span
                                                            id="init_voluntary_show"></span></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-group">
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Tiempo Servicio:</strong> &nbsp; <span
                                                            id="servicio_show"></span></li>
                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-plain h-100">
                                    <div class="card-header pb-0 p-3">
                                        <h5 class="mb-0">Información Médica</h5>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-6">
                                                <ul class="list-group">
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Tipo de Sangre:</strong> &nbsp; <span
                                                            id="blood_type_show"></span></li>
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Alergico:</strong> &nbsp; <span
                                                            id="allergic_show"></span></li>
                                                </ul>
                                            </div>
                                            <div class="col-6">
                                                <ul class="list-group">
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Enfermedad:</strong> &nbsp; <span
                                                            id="disease_show"></span></li>
                                                    <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                            class="text-dark">Medicamento:</strong> &nbsp; <span
                                                            id="medicine_show"></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="card card-plain h-100">
                                    <div class="card-header pb-0 p-3">
                                        <h5 class="mb-0">Configuración</h5>
                                    </div>
                                    <div class="card-body p-3">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 px-0">
                                                <div class="form-check form-switch ps-0">
                                                    <input class="form-check-input ms-auto" type="checkbox"
                                                        id="payment_show" checked disabled>
                                                    <label
                                                        class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                                        for="payment_show" id="text_payment_show"></label>
                                                </div>
                                                <div class="form-check form-switch ps-0">
                                                    <input class="form-check-input ms-auto" type="checkbox"
                                                        id="license_show" checked disabled>
                                                    <label
                                                        class="form-check-label text-body ms-3 text-truncate w-80 mb-0"
                                                        for="license_show" id="text_license_show"></label>
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
                                        <h5 class="mb-0">Números de Emergencia</h5>
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
                                        <h5 class="mb-0">Anotaciones</h5>
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
