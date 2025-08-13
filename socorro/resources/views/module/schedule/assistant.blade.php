<div class="modal fade" id="assistantModal" tabindex="-1" aria-labelledby="assistantModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-body">
            <form id="createAssistantEventForm" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="eventModalLabel">Ingresar Participante</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <input type="hidden" id="id_event" name="id_event">
                            <label for="date" class="form-label">Tipo Evento</label>
                            <select class="form-selected form-control" id="id_user" name="id_user">
                                <option disabled selected>Seleccionar</option>
                                @foreach($voluntaries as $voluntary)
                                    <option value="{{ $voluntary->id }}">{{ $voluntary->name }} {{ $voluntary->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Tipo Asignación</label>
                            <select class="form-selected form-control" id="assign" name="assign">
                                <option selected disabled>Seleccionar Opción</option>
                                <option value="assitant">Asistente/Guardia</option>
                                <option value="support">Apoyo</option>
                                <option value="leader">Lider</option>
                                <option value="speaker">Presentador</option>
                                <option value="guest">Invitado</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Ingresar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>