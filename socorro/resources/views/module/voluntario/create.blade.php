<!-- Modal -->
<div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-scrollable create-volunteer-dialog">
        <div class="modal-content modal-extra-background create-volunteer-modal">
            <div class="modal-header">
                <div class="d-flex align-items-center gap-3">
                    <span class="create-volunteer-icon"><i class="fa-solid fa-user-plus"></i></span>
                    <div>
                        <h5 class="modal-title mb-0" id="CreateModalLabel">Registrar voluntario</h5>
                        <small>Complete los antecedentes personales, médicos y técnicos.</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formVoluntario" class="form create-volunteer-form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-section-title">
                        <span><i class="fa-solid fa-building-shield"></i></span>
                        <div><strong>Datos institucionales</strong><small>Delegación a la que pertenecerá.</small></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Delegación<span
                                        class="text-danger">*</span></label>
                                <select class="form-select border border-gray p-2" aria-label="Default select example"
                                    id="delegation_id" name="delegation_id" required>
                                    <option value="" selected disabled>Seleccione Delegación</option>
                                    @foreach ($delegations as $delegation)
                                        <option value="{{ $delegation->id }}">{{ $delegation->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-section-title">
                        <span><i class="fa-solid fa-address-card"></i></span>
                        <div><strong>Información personal</strong><small>Identificación y datos de contacto.</small></div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label>Imagen</label>
                                <input type="file" class="form-control border border-gray p-2" id="image"
                                    name="image">
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Número de Documento<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control border border-gray p-2" id="document"
                                    name="document" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nombre<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control border border-gray p-2" id="name"
                                    name="name" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Apellido<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control border border-gray p-2" id="lastname"
                                    name="lastname" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Telefono<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control border border-gray p-2" id="phone"
                                    name="phone" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Fecha Nacimiento<span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control border border-gray p-2" id="birthday"
                                    name="birthday" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Dirección<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control border border-gray p-2" id="address"
                                    name="address" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Profesión<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control border border-gray p-2" id="profession"
                                    name="profession" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Sexo<span
                                        class="text-danger">*</span></label>
                                <select class="form-select border border-gray p-2" aria-label="Default select example"
                                    id="gender" name="gender" required>
                                    <option value="" selected disabled>Seleccione Opción</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-section-title mt-2">
                                    <span><i class="fa-solid fa-heart-pulse"></i></span>
                                    <div><strong>Salud y antecedentes médicos</strong><small>Información importante para actuar con seguridad.</small></div>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Alergico<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select border border-gray p-2"
                                        aria-label="Default select example" id="allergic" name="allergic" required>
                                        <option value="" selected disabled>Seleccione opción</option>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Enfermedad<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select border border-gray p-2"
                                        aria-label="Default select example" id="disease" name="disease" required>
                                        <option value="" selected disabled>Seleccione opción</option>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Medicamento<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select border border-gray p-2"
                                        aria-label="Default select example" id="medicine" name="medicine" required>
                                        <option selected>Seleccione Opción</option>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 d-none" id="allergy_details_group">
                                <div class="mb-3">
                                    <label for="allergy_details" class="form-label">¿Qué alergia tiene?<span class="text-danger">*</span></label>
                                    <textarea class="form-control border border-gray p-2" id="allergy_details"
                                        name="allergy_details" rows="2" maxlength="500"
                                        placeholder="Indique la alergia y cualquier precaución relevante"></textarea>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 d-none" id="disease_details_group">
                                <div class="mb-3">
                                    <label for="disease_details" class="form-label">¿Qué enfermedad tiene?<span class="text-danger">*</span></label>
                                    <textarea class="form-control border border-gray p-2" id="disease_details"
                                        name="disease_details" rows="2" maxlength="500"
                                        placeholder="Indique la enfermedad y cualquier precaución relevante"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-section-title">
                        <span><i class="fa-solid fa-car-side"></i></span>
                        <div><strong>Movilidad y seguridad</strong><small>Disponibilidad de vehículo, licencia y grupo sanguíneo.</small></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">¿Tiene Vehiculo?<span
                                        class="text-danger">*</span></label>
                                <select class="form-select border border-gray p-2" aria-label="Default select example"
                                    id="vehicle" name="vehicle" required>
                                    <option selected>Seleccione Opción</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">¿Tiene Licencia de Conducir
                                    Clase B?<span class="text-danger">*</span></label>
                                <select class="form-select border border-gray p-2" aria-label="Default select example"
                                    id="license" name="license" required>
                                    <option selected>Seleccione Opción</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tipo de Sangre<span
                                        class="text-danger">*</span></label>
                                <select class="form-select border border-gray p-2" aria-label="Default select example"
                                    id="blood_type" name="blood_type" required>
                                    <option selected disabled>Seleccione Opción</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="competency-panel mb-3">
                        <div class="mb-3">
                            <h6 class="mb-1"><i class="fa-solid fa-chart-simple me-1"></i> Evaluación de competencias</h6>
                            <small class="text-muted">Seleccione el nivel actual del voluntario en cada área.</small>
                        </div>
                        <div class="row">
                            @foreach ([
                                'rope_technical_level' => 'Técnica de cuerda',
                                'health_level' => 'Salud',
                                'stretcher_level' => 'Camillaje',
                                'leadership_level' => 'Liderazgo',
                                'physical_performance_level' => 'Rendimiento físico',
                                'snow_ice_level' => 'Manejo en nieve/hielo',
                            ] as $field => $label)
                                <div class="col-12 col-md-6">
                                    <div class="mb-3">
                                        <label for="{{ $field }}" class="form-label">{{ $label }}<span class="text-danger">*</span></label>
                                        <select class="form-select border border-gray p-2" id="{{ $field }}"
                                            name="{{ $field }}" required>
                                            <option value="" selected disabled>Seleccione nivel</option>
                                            <option value="low">Bajo</option>
                                            <option value="medium">Medio</option>
                                            <option value="high">Alto</option>
                                        </select>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="form-section-title">
                        <span><i class="fa-solid fa-id-badge"></i></span>
                        <div><strong>Situación institucional</strong><small>Estado, tipo de integrante e inicio de servicio.</small></div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Estado</label>
                                <select class="form-select border border-gray p-2" aria-label="Default select example"
                                    id="status" name="status" required>
                                    <option selected disabled>Seleccione el Estado</option>
                                    <option value="A">Activo</option>
                                    <option value="I">Inactivo</option>
                                    <option value="S">Suspendido</option>
                                    <option value="R">Receso</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tipo de Socorrista</label>
                                <select class="form-select border border-gray p-2" aria-label="Default select example"
                                    id="type" name="type" required>
                                    <option selected disabled>Seleccione el Tipo</option>
                                    <option value="V">Voluntario</option>
                                    <option value="A">Aspirante</option>
                                    <option value="H">Honorario</option>
                                    <option value="C">Cooperador</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label>Fecha de inicio de servicio</label>
                                <input type="date" class="form-control" id="init_voluntary" name="init_voluntary" required>
                            </div>
                        </div>
                    </div>
                    <div class="create-volunteer-actions">
                        <small><span class="text-danger">*</span> Campos obligatorios</small>
                        <button type="submit" class="btn btn-success px-4"><i class="fa-solid fa-floppy-disk me-1"></i>
                            Registrar voluntario</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
<style>
    #CreateModal .create-volunteer-modal {
        border: 0;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 1.5rem 4rem rgba(24, 30, 42, .22);
    }

    #CreateModal .modal-header {
        padding: 1.15rem 1.5rem;
        border-bottom: 1px solid rgba(0, 0, 0, .07);
    }

    #CreateModal .modal-header small { color: #6c757d; }
    #CreateModal .modal-body { padding: 1.5rem; }

    #CreateModal .create-volunteer-icon,
    #CreateModal .form-section-title > span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
        color: #fff;
        background: #343a40;
        border-radius: .75rem;
    }

    #CreateModal .create-volunteer-icon { width: 2.75rem; height: 2.75rem; font-size: 1.1rem; }

    #CreateModal .form-section-title {
        display: flex;
        align-items: center;
        gap: .75rem;
        margin: .4rem 0 1rem;
        padding: .8rem 1rem;
        background: rgba(52, 58, 64, .055);
        border-left: 3px solid #343a40;
        border-radius: 0 .7rem .7rem 0;
    }

    #CreateModal .form-section-title > span { width: 2.2rem; height: 2.2rem; border-radius: .6rem; }
    #CreateModal .form-section-title strong,
    #CreateModal .form-section-title small { display: block; }
    #CreateModal .form-section-title strong { color: #343a40; line-height: 1.2; }
    #CreateModal .form-section-title small { color: #6c757d; margin-top: .15rem; }

    #CreateModal .create-volunteer-form > .row { --bs-gutter-x: 1rem; }
    #CreateModal .form-label,
    #CreateModal .create-volunteer-form label { font-size: .86rem; font-weight: 600; color: #495057; }

    #CreateModal .form-control,
    #CreateModal .form-select {
        min-height: 2.8rem;
        border-color: #dee2e6 !important;
        border-radius: .65rem;
        background-color: #fff;
        transition: border-color .2s ease, box-shadow .2s ease;
    }

    #CreateModal textarea.form-control { min-height: 5rem; }
    #CreateModal .form-control:focus,
    #CreateModal .form-select:focus {
        border-color: #6c757d !important;
        box-shadow: 0 0 0 .2rem rgba(52, 58, 64, .1);
    }

    #CreateModal .competency-panel {
        padding: 1.1rem 1.1rem .2rem;
        border: 1px solid #e2e6ea;
        border-radius: .85rem;
        background: linear-gradient(145deg, #fff, #f8f9fa);
    }

    #CreateModal .competency-panel h6 { color: #343a40; font-weight: 700; }

    #CreateModal .create-volunteer-actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        margin-top: .5rem;
        padding-top: 1rem;
        border-top: 1px solid #e9ecef;
    }

    #CreateModal .create-volunteer-actions small { color: #6c757d; }

    @media (max-width: 767.98px) {
        #CreateModal .modal-body { padding: 1rem; }
        #CreateModal .modal-header { padding: 1rem; }
        #CreateModal .modal-header small { display: none; }
        #CreateModal .form-section-title { padding: .7rem .8rem; }
        #CreateModal .create-volunteer-actions { align-items: stretch; flex-direction: column; }
        #CreateModal .create-volunteer-actions .btn { width: 100%; }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('formVoluntario');

        function configureConditionalField(selectId, groupId, inputId) {
            const select = document.getElementById(selectId);
            const group = document.getElementById(groupId);
            const input = document.getElementById(inputId);

            function sync() {
                const visible = select.value === '1';
                group.classList.toggle('d-none', !visible);
                input.required = visible;
                if (!visible) input.value = '';
            }

            select.addEventListener('change', sync);
            sync();
        }

        configureConditionalField('allergic', 'allergy_details_group', 'allergy_details');
        configureConditionalField('disease', 'disease_details_group', 'disease_details');

        form.addEventListener('reset', function () {
            setTimeout(function () {
                document.getElementById('allergic').dispatchEvent(new Event('change'));
                document.getElementById('disease').dispatchEvent(new Event('change'));
            });
        });
    });
</script>
