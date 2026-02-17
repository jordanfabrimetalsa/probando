<div class="modal fade" id="avisoModal" tabindex="-1" aria-labelledby="avisoModalLabel" aria-hidden="true">

    <div class="modal-dialog modal-xl">
        <div class="modal-content modal-extra-background">
            <form id="form_departure" type="POST" enctype="multipart/form-data">
                @method('POST')
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="avisoModalLabel">Registro de Salida.</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="pt-2 pb-2"><strong class="text-danger">¡Atención! </strong>, Este es un formulario para
                        registrar tu salida a la montaña y
                        nosotros tener una información completa en caso de que llegaras a requerir nuestra ayuda.
                        <br><br>
                        Debes recordar dar aviso de finalizado la salida de aviso que has dado.
                    </div>
                    <br><br>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Nombres</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Ingrese sus nombres" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Apellidos</label>
                                <input type="text" class="form-control" id="lastname" name="lastname"
                                    placeholder="Ingrese sus apellidos" required>
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
                                <input type="text" class="form-control" id="document_number" name="document_number"
                                    placeholder="Ingrese su rut o pasaporte" required>
                            </div>
                        </div>
                    </div>
                    <div class="row border-bottom mb-2">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">E-mail</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Ingrese su correo electronico" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Telefono</label>
                                <input type="number" class="form-control" id="phone" name="phone"
                                    placeholder="Ingrese su numero de telefono">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Región de Destino</label>
                                <select name="region" id="region" class="form-control" required>
                                    <option value="">Seleccione</option>
                                    <option value="0">Región Arica y Parinacota</option>
                                    <option value="1">Región Tarapaca</option>
                                    <option value="3">Región Antofagasta</option>
                                    <option value="4">Región Atacama</option>
                                    <option value="5">Región Coquimbo</option>
                                    <option value="6">Región Metropolitana</option>
                                    <option value="7">Región Valparaiso</option>
                                    <option value="8">Región O'Higgins</option>
                                    <option value="9">Región Maule</option>
                                    <option value="16">Región Nuble</option>
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
                                    placeholder="Ingrese el lugar de destino" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Ruta</label>
                                <input type="text" class="form-control" id="route" name="route"
                                    placeholder="Ingrese la ruta" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="" class="form-label">Archivo Track KMZ/GPX</label>
                                <input type="file" class="form-control" id="file_path" name="file_path" accept=".kmz,.gpx" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="" class="form-label">Actividad</label>
                                <select name="activity" id="activity" class="form-control" required>
                                    <option selected disabled>Seleccione</option>
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
                                    required>
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
                                    name="return_date" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-dark btn-save-load">Guardar</button>
                    </div>
            </form>
        </div>
    </div>
</div>
