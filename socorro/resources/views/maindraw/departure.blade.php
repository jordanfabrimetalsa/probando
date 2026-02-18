<!-- Modal de Lista de Salidas -->
<div class="modal fade" id="departureModal" tabindex="-1" aria-labelledby="departureModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-extra-background">
            <div class="modal-header">
                <h5 class="modal-title" id="departureModalLabel">Mi Salida</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="pt-2 pb-2"><strong class="text-danger">¡Atención!, </strong> Revisa aquí tu detalle de salida. En el caso de estar activa aún, favor de cerrarla.</div>
                <form id="form_departure_search" type="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <input type="text" class="form-control" id="rut" name="rut" placeholder="Ingrese su rut" required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="mb-3">
                                <button type="submit" class="btn btn-dark btn-search-load">Buscar</button>
                                <button type="button" class="btn btn-warning" onclick="clearSearch()">Limpiar</button>
                                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#avisoModal">Crear</button>
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
            departureModal.addEventListener('hidden.bs.modal', function () {
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
</script>
@endpush
