<div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-extra-background">
        <form id="createEventForm" method="POST">
            @csrf
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Crear evento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control" id="title" name="title" required>
                </div>
                <div class="mb-3">
                    <label for="title" class="form-label">Descripción</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Tipo Evento</label>
                    <select class="form-selected form-control" id="type" name="type">
                        <option disabled selected>Seleccionar</option>
                        <option value="Guard">Guardia</option>
                        <option value="Class">Clase</option>
                        <option value="Event">Evento</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Inicio</label>
                    <input type="date" class="form-control" id="start" name="start" readonly required>
                </div>
                <div class="mb-3">
                    <label for="date" class="form-label">Termino</label>
                    <input type="date" class="form-control" id="end" name="end" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-success">Guardar</button>
            </div>
            </div>
        </form>
    </div>
</div>