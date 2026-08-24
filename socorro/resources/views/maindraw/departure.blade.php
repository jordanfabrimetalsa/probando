<!-- Modal de Lista de Salidas -->
<div class="modal fade" id="departureModal" tabindex="-1" aria-labelledby="departureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-extra-background">
            <div class="modal-header">
                <h5 class="modal-title" id="departureModalLabel"><i class="fa-solid fa-magnifying-glass-location me-2"></i> Consultar mi salida</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="safety-note"><i class="fa-solid fa-circle-info"></i><div><strong>Revisa el estado de tu salida.</strong><br>Si ya regresaste, ciérrala para informar que estás a salvo.</div></div>
                <form id="form_departure_search" method="POST" data-loading-title="Buscando tu salida" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label>Tipo Documento</label>
                                <select class="form-control" id="tipo_documento" name="tipo_documento" required>
                                    <option value="">Seleccione</option>
                                    <option value="1">RUT</option>
                                    <option value="2">Pasaporte</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label><span class="text-danger">¡Recuerde que RUT es sin punto ni guión!</span></label>
                                <input type="text" class="form-control" id="rut" name="rut" disabled required>

                                <div class="invalid-feedback">
                                    El RUT ingresado no es válido.
                                </div>

                                <div class="valid-feedback">
                                    RUT válido.
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="mb-3">
                                <label class="form-label invisible">Acciones</label>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-dark btn-search-load"><i class="fa-solid fa-magnifying-glass me-1"></i> Buscar</button>
                                    <button type="button" class="btn btn-warning"
                                        onclick="clearSearch()">Limpiar</button>
                                    <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                        data-bs-target="#avisoModal">Crear</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <br>
                <div class="table-responsive">
                    <table id="datatableUser" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="text-center">Nombres</th>
                                <th class="text-center">Lugar</th>
                                <th class="text-center">Salida</th>
                                <th class="text-center">Regreso</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-body text-center">
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        // Asegurarse de que el DOM esté completamente cargado
        document.addEventListener('DOMContentLoaded', function() {
            const departureModal = document.getElementById('departureModal');

            if (departureModal) {
                // Limpiar el fondo oscuro del modal cuando se cierre
                departureModal.addEventListener('hidden.bs.modal', function() {
                    const backdrops = document.getElementsByClassName('modal-backdrop');
                    for (let backdrop of backdrops) {
                        backdrop.remove();
                    }
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = 'auto';
                    document.body.style.paddingRight = '0';
                });
            }
        });

        $(document).ready(function() {
            $('#tipo_documento').on('change', function() {
                let tipo = $(this).val();
                $('#rut').val('');
                if (tipo === '') {
                    $('#rut')
                        .prop('disabled', true)
                        .attr('maxlength', 9);
                    return;
                }

                $('#rut').prop('disabled', false);
                if (tipo == '1') {
                    // RUT
                    $('#rut')
                        .attr('maxlength', 9)
                        .attr('placeholder', 'Ingrese RUT sin puntos ni guión');
                } else {
                    // Pasaporte
                    $('#rut')
                        .removeAttr('maxlength')
                        .attr('placeholder', 'Ingrese Pasaporte');
                }

            });

            $('#rut').on('input', function() {
                let tipo = $('#tipo_documento').val();
                let valor = $(this).val();

                if (tipo == '1') {
                    // Solo números y K
                    valor = valor.toUpperCase().replace(/[^0-9K]/g, '');
                } else if (tipo == '2') {
                    // Solo letras y números
                    valor = valor.toUpperCase().replace(/[^A-Z0-9]/g, '');
                }

                $(this).val(valor);

            });

            $('#rut').on('blur', function() {

                if ($('#tipo_documento').val() != '1') {
                    return;
                }

                let rut = $(this).val();

                if (rut === '') {
                    return;
                }

                if (!validarRut(rut)) {
                    $(this)
                        .addClass('is-invalid')
                        .removeClass('is-valid');
                } else {
                    $(this)
                        .removeClass('is-invalid')
                        .addClass('is-valid');
                }

            });

        });
    </script>
@endpush
