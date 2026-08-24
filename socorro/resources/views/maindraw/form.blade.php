<div class="modal fade" id="avisoModal" tabindex="-1" aria-labelledby="avisoModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-extra-background">
            <form id="form_departure" class="departure-registration-form" method="POST" enctype="multipart/form-data" data-loading-title="Registrando aviso de salida" novalidate>
                @method('POST')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="avisoModalLabel"><i class="fa-solid fa-person-hiking me-2"></i> Aviso de salida</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pt-2 pb-2">
                    </div>
                    <div class="safety-note"><i class="fa-solid fa-shield-halved"></i><div>
                        <strong>Tu información puede hacer la diferencia.</strong><br>
                        Registra los datos de tu salida para que podamos ayudarte con rapidez si ocurre una emergencia.
                    </div></div>
                    <h6 class="form-section-title"><i class="fa-regular fa-user"></i> Datos personales</h6>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Ingrese sus nombres" minlength="2" maxlength="50" required autocomplete="given-name">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                    placeholder="Ingrese sus apellidos" minlength="2" maxlength="50" required autocomplete="family-name">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Tipo</label>
                                <select name="document_type" id="document_type" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <option value="0">Pasaporte</option>
                                    <option value="1">Rut</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Rut/Pasaporte</label>
                                <input type="text" class="form-control" onchange="validarRut(this)"
                                    id="document_number" name="document_number" placeholder="Ingrese su rut o pasaporte"
                                    minlength="5" maxlength="20" required autocomplete="off">
                            </div>
                        </div>
                    </div>
                    <div class="row border-bottom mb-2">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email" maxlength="100"
                                    placeholder="Ingrese su correo electronico" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Telefono</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Ingrese su número de teléfono" inputmode="numeric" pattern="[0-9]{8,12}" minlength="8"
                                    maxlength="12" required autocomplete="tel">
                            </div>
                        </div>
                    </div>
                    <h6 class="form-section-title mt-3"><i class="fa-solid fa-route"></i> Plan de ruta</h6>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Región de Destino</label>
                                <select name="region" id="region" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <option value="0">Región Arica y Parinacota</option>
                                    <option value="1">Región Tarapaca</option>
                                    <option value="2">Región Antofagasta</option>
                                    <option value="3">Región Atacama</option>
                                    <option value="4">Región Coquimbo</option>
                                    <option value="5">Región Metropolitana</option>
                                    <option value="6">Región Valparaiso</option>
                                    <option value="7">Región O'Higgins</option>
                                    <option value="8">Región Maule</option>
                                    <option value="9">Región Nuble</option>
                                    <option value="10">Región Bio Bio</option>
                                    <option value="11">Región Araucania</option>
                                    <option value="12">Región Los Rios</option>
                                    <option value="13">Región Los Lagos</option>
                                    <option value="14">Región Aysen</option>
                                    <option value="15">Región Magallanes</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Lugar Destino</label>
                                <input type="text" class="form-control" id="destination" name="destination"
                                    placeholder="Ingrese el LUGAR DESTINO" minlength="5" maxlength="40" required
                                    onkeyup="this.value = this.value.toUpperCase();">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Ruta</label>
                                <input type="text" class="form-control" id="route" name="route"
                                    placeholder="Ingrese la ruta" minlength="5" maxlength="60" required
                                    onkeyup="this.value = this.value.toUpperCase();">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Archivo Track GPX</label>
                                <input type="file" class="form-control" id="file_path" name="file_path"
                                    accept=".gpx,.kmz" data-max-size="10485760">
                                <div class="form-text">Formato GPX o KMZ, máximo 10 MB.</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Actividad</label>
                                <select name="activity" id="activity" class="form-control" required>
                                    <option value="" selected disabled>Seleccione</option>
                                    <option value="0">Trekking</option>
                                    <option value="1">Hikking</option>
                                    <option value="3">Mountain Bike</option>
                                    <option value="4">Escalada</option>
                                    <option value="5">Escalada en Hielo</option>
                                    <option value="6">Randonee</option>
                                    <option value="7">Trail Running</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">N° Participantes</label>
                                <input type="number" class="form-control" id="number_participants"
                                    name="number_participants" placeholder="Ingrese el numero de participantes"
                                    required min="1" max="100" value="1" onchange="validarParticipantes()">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Fecha de Salida</label>
                                <input type="datetime-local" class="form-control" id="departure_date"
                                    name="departure_date" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Fecha de Regreso</label>
                                <input type="datetime-local" class="form-control" id="return_date"
                                    name="return_date" required disabled>
                            </div>
                        </div>
                        <hr class="mb-3"><br>
                        <h6 class="form-section-title mt-3"><i class="fa-solid fa-phone-volume"></i> Contactos de emergencia</h6>
                            <div class="col-md-4 col-sm-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Nombre de Emergencia 1 <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="name_emergency_family" name="name_emergency_family" minlength="10"
                                        maxlength="60"
                                        placeholder="Ingrese el nombre" required>
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">Parentesco 1 <span class="text-danger">*</span></label>
                                    <select type="text" class="form-control" id="parentesco_family_emergency" name="parentesco_family_emergency"
                                        placeholder="Ingrese el nombre" required>
                                        <option value="">Seleccione</option>
                                        <option value="Padre">Padre</option>
                                        <option value="Madre">Madre</option>
                                        <option value="Hermano">Hermano</option>
                                        <option value="Hermana">Hermana</option>
                                        <option value="Amigo">Amigo</option>
                                        <option value="Otro">Otro</option>
                                    </select>

                                </div>
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <div class="mb-3">
                                    <label for="" class="form-label bg-light">Numero Telefonico 1 <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="number_family_emergency" name="number_family_emergency"
                                        placeholder="Ingrese el número" inputmode="numeric" pattern="[0-9]{8,12}" minlength="8"
                                        maxlength="12" required>
                                </div>
                            </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Nombre de Emergencia 2</label>
                                <input type="text" class="form-control" id="name_emergency_family_2" name="name_emergency_family_2"
                                    placeholder="Ingrese el nombre" minlength="10" maxlength="60" required>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Parentesco 2</label>
                                <select type="text" class="form-control" id="parentesco_family_emergency_2" name="parentesco_family_emergency_2"
                                    placeholder="Ingrese el nombre" required>
                                    <option value="">Seleccione</option>
                                    <option value="Padre">Padre</option>
                                    <option value="Madre">Madre</option>
                                    <option value="Hermano">Hermano</option>
                                    <option value="Hermana">Hermana</option>
                                    <option value="Amigo">Amigo</option>
                                    <option value="Otro">Otro</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Numero Telefonico 2</label>
                                <input type="text" class="form-control" id="number_family_emergency_2" name="number_family_emergency_2"
                                    placeholder="Ingrese el número" inputmode="numeric" pattern="[0-9]{8,12}" minlength="8"
                                    maxlength="12" required>
                            </div>
                        </div>
                    </div>
                    <div class="safety-note mb-0"><i class="fa-solid fa-circle-check"></i><div>
                        <strong>Recuerda cerrar tu salida.</strong><br>Solo puedes mantener un aviso activo a la vez.
                    </div></div>
                    <div class="modal-footer d-flex justify-content-between">

                        <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                data-bs-target="#departureModal">
                            Dar finalizado aviso
                        </button>

                        <div>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                Cerrar
                            </button>

                            <button type="submit" id="btnSubmit" class="btn btn-dark btn-save-load">
                                Guardar
                            </button>
                        </div>
                    </div>
            </form>
        </div>
    </div>
</div>

<script>
$('#number_family_emergency').on('input', function () {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
});


$('#number_family_emergency').on('input', function() {
    let valor = $(this).val();

    if (valor.length > 9) {
        $(this).val(valor.substring(0, 9));
    }
});

$('#number_family_emergency_2').on('input', function() {
    let valor = $(this).val();

    if (valor.length > 9) {
        $(this).val(valor.substring(0, 9));
    }
});

$('#number_family_emergency_2').on('input', function () {
    $(this).val($(this).val().replace(/[^0-9]/g, ''));
});
</script>

<script>
    function validarFecha() {
        const departureInput = document.getElementById('departure_date');
        const returnInput = document.getElementById('return_date');
        returnInput.disabled = !departureInput.value;
        returnInput.setCustomValidity('');
        if (!departureInput.value || !returnInput.value) return true;

        const minimumReturn = new Date(departureInput.value).getTime() + (60 * 60 * 1000);
        const isValid = new Date(returnInput.value).getTime() >= minimumReturn;
        if (!isValid) returnInput.setCustomValidity('La fecha de regreso debe ser al menos una hora posterior a la salida.');
        return isValid;
    }

    function validarParticipantes() {
        let participantes = document.getElementById('number_participants').value;
        if (participantes < 1) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'El numero de participantes debe ser mayor a 0',
            });
            document.getElementById('number_participants').value = 1;
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        const departureInput = document.getElementById('departure_date');
        const returnInput = document.getElementById('return_date');
        const fileInput = document.getElementById('file_path');

        departureInput?.addEventListener('change', function () {
            if (this.value) {
                const minimum = new Date(new Date(this.value).getTime() + (60 * 60 * 1000));
                returnInput.min = new Date(minimum.getTime() - minimum.getTimezoneOffset() * 60000).toISOString().slice(0, 16);
            }
            validarFecha();
        });
        returnInput?.addEventListener('change', validarFecha);
        fileInput?.addEventListener('change', function () {
            this.setCustomValidity(this.files[0] && this.files[0].size > 10485760 ? 'El archivo no puede superar los 10 MB.' : '');
        });
    });
</script>

<script>
    function validarRut(rut) {
        rut = rut.replace(/\./g, '').replace('-', '');
        if (rut.length < 2) return false;

        let cuerpo = rut.slice(0, -1);
        let dv = rut.slice(-1).toUpperCase();

        let suma = 0;
        let multiplo = 2;

        for (let i = cuerpo.length - 1; i >= 0; i--) {
            suma += multiplo * cuerpo.charAt(i);
            multiplo = multiplo < 7 ? multiplo + 1 : 2;
        }

        let dvEsperado = 11 - (suma % 11);
        dvEsperado = dvEsperado == 11 ? '0' :
            dvEsperado == 10 ? 'K' :
            dvEsperado.toString();

        return dv === dvEsperado;
    }

    function validarFormulario() {
        let tipoDocumento = $('#document_type').val();
        let rut = $('#document_number').val();

        if (tipoDocumento == "1") { // 1 = RUT
            if (validarRut(rut)) {
                $('#document_number').removeClass('is-invalid').addClass('is-valid');
                $('#btnSubmit').prop('disabled', false);
            } else {
                $('#document_number').removeClass('is-valid').addClass('is-invalid');
                $('#btnSubmit').prop('disabled', true);
            }
        } else {
            // Si no es RUT, habilita botón y limpia validación
            $('#btnSubmit').prop('disabled', false);
            $('#document_number').removeClass('is-invalid is-valid');
        }
    }

    // Event listeners
    $(document).ready(function() {
        $('#document_type').on('change', validarFormulario);
        $('#document_number').on('input', validarFormulario);

        // Validación inicial
        validarFormulario();
    });
</script>
