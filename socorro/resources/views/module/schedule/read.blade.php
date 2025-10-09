<div class="modal fade" id="eventReadModal" tabindex="-1" aria-labelledby="eventReadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-extra-background">
            <div class="modal-header">
                <h6 class="modal-title" id="eventReadModalLabel">Tipo de Evento es <span class="badge bg-danger" id="type_read"></span></h6>
            </div>
            
            <div class="modal-body">
                <p class="text-dark">Información detallada.</p>
                <div>
                    <label>Titulo:</label>
                    <input type="text" class="form-control" id="title_read" name="title_read" disabled>
                </div>
                <div>
                    <label>Descripcion:</label>
                    <textarea id="description_read" name="description_read" class="form-control" disabled></textarea>
                </div>
                <div class="row">
                    <div class="col-6">
                        <label>Inicio:</label>
                        <input type="text" class="form-control" id="start_read" name="start_read" disabled>
                    </div>
                    <div class="col-6">
                        <label>Termino:</label>
                        <input type="text" class="form-control" id="end_read" name="end_read" disabled>
                    </div>
                </div>

                <br>

                <div class="d-flex justify-content-center">
                    <div class="btn-group d-inline-flex" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-dark me-2" data-bs-toggle="modal" data-bs-target="#assistantModal">
                            <i class="fa-solid fa-user-plus"></i>
                        </button>  
                        <button type="button" class="btn btn-dark me-2" data-bs-toggle="modal" data-bs-target="#fileModal">
                            <i class="fa-solid fa-file-circle-plus"></i>
                        </button>                        
                        <button type="button" id="btnDeleteEvent" class="btn btn-danger">
                            <i class="fa-solid fa-calendar-xmark"></i>
                        </button>
                    </div>
                </div>

                <div class="border border-radius-sm p-2">
                    <p class="text-dark">Participantes.</p>
                    <table id="datatableGuards" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                        <thead class="bg-gradient-dark text-center">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombre</th>
                                <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Asignación</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="border border-radius-sm p-2">
                    <p class="text-dark">Material digital.</p>
                    <table id="datatableFile" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                        <thead class="bg-gradient-dark text-center">
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombre</th>
                                <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Tipo</th>
                                <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Descarga</th>
                            </tr>
                        </thead>
                        <tbody class="text-left">
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>