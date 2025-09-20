<!-- Modal de Lista de Salidas -->
<div class="modal fade" id="departureModal" tabindex="-1" aria-labelledby="departureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="departureModalLabel">Lista de Salidas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="pt-2 pb-2"><strong class="text-danger">¡Atención! </strong>, Revisa aquí tu detalle de salida. En el caso de estar activa aún, favor de cerrarla.
                </div>
                <div class="row">
                    <div class="col-12">
                        <div class="card my-4">
                            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                                <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                                    <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-user-tie"></i> Salida</h6>
                                </div>
                            </div>
                            <div class="card-body p-4">
                                <table id="datatableUser" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                                    <thead class="bg-gradient-dark text-center">
                                        <tr class="text-center">
                                            <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombres</th>
                                            <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Apellidos</th>
                                            <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Email</th>
                                            <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Telefono</th>
                                            <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">N° Documento</th>
                                            <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Región</th>
                                            <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Lugar Destino</th>
                                            <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Ruta</th>
                                            <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Fecha de Salida</th>
                                            <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Fecha de Regreso</th>
                                            <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
    // Limpiar el fondo oscuro del modal cuando se cierre
    document.getElementById('DepartureModal').addEventListener('hidden.bs.modal', function () {
        const backdrops = document.getElementsByClassName('modal-backdrop');
        for (let backdrop of backdrops) {
            backdrop.remove();
        }
        document.body.classList.remove('modal-open');
        document.body.style.overflow = 'auto';
        document.body.style.paddingRight = '0';
    });
</script>
@endpush
