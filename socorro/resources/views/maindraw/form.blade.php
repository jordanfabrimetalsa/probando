<div class="modal fade" id="avisoModal" tabindex="-1" aria-labelledby="avisoModalLabel" aria-hidden="true">
    <form id="form_departure" type="POST" enctype="multipart/form-data">
    @method('POST')  
    @csrf
    <div class="modal-dialog modal-xl">
      <div class="modal-content modal-extra-background">
        <div class="modal-header">
          <h5 class="modal-title" id="avisoModalLabel">Registro de Salida.</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="pt-2 pb-2"><strong class="text-danger">¡Atención! </strong>, Este es un formulario para registrar tu salida a la montaña y 
            nosotros tener una información completa en caso de que llegaras a requerir nuestra ayuda.
            <br><br>
            Debes recordar dar aviso de finalizado la salida de aviso que has dado.
          </div>
          <br><br>
          <div class="row">
            <div class="col-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nombres</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
            </div>
            <div class="col-6"> 
                <div class="mb-3">
                    <label for="" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="lastname" name="lastname">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="" class="form-label">Tipo</label>
                <select name="document_type" id="document_type" class="form-control">
                  <option value="">Seleccione</option>
                  <option value="0">Pasaporte</option>
                  <option value="1">Rut</option>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="" class="form-label">Rut/Pasaporte</label>
                <input type="text" class="form-control" id="document_number" name="document_number">
              </div>
            </div>
        </div>
        <div class="row border-bottom mb-2">
            <div class="col-6">
              <div class="mb-3">
                <label for="" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="email" name="email">
              </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                  <label for="" class="form-label">Telefono</label>
                  <input type="number" class="form-control" id="phone" name="phone">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="mb-3">
                  <label for="" class="form-label">Región de Destino</label>
                  <select name="region" id="region" class="form-control">
                    <option value="">Seleccione</option>
                    <option value="0">Región Arica y Parinacota</option>
                    <option value="1">Región Tarapaca</option>
                    <option value="1">Región Antofagasta</option>
                    <option value="1">Región Atacama</option>
                    <option value="1">Región Coquimbo</option>
                    <option value="1">Región Metropolitana</option>
                    <option value="1">Región Valparaiso</option>
                    <option value="1">Región O'Higgins</option>
                    <option value="1">Región Maule</option>
                    <option value="1">Región Bio Bio</option>
                    <option value="1">Región Araucania</option>
                    <option value="1">Región Los Rios</option>
                    <option value="1">Región Los Lagos</option>
                    <option value="1">Región Aysen</option>
                    <option value="1">Región Magallanes</option>
                  </select>
                </div>
            </div>
            <div class="col-6">
                <div class="mb-3">
                  <label for="" class="form-label">Lugar Destino</label>
                  <input type="text" class="form-control" id="destination" name="destination">
                </div>
            </div>
            <div class="col-12">
                <div class="mb-3">
                  <label for="" class="form-label">Ruta</label>
                  <input type="text" class="form-control" id="route" name="route">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="mb-3">
                  <label for="" class="form-label">Archivo Track KMZ/GPX</label>
                  <input type="file" class="form-control" id="file_path" name="file_path">
                </div>
            </div>
        </div>
        <div class="row">
          <div class="col-6">
              <div class="mb-3">
                <label for="" class="form-label">Actividad</label>
                <select name="activity" id="activity" class="form-control">
                  <option value="">Seleccione</option>
                  <option value="0">Trekking</option>
                  <option value="1">Hikking</option>
                  <option value="1">Mountain Bike</option>
                  <option value="1">Escalada</option>
                  <option value="1">Escalada en Hielo</option>
                  <option value="1">Randonee</option>
                  <option value="1">Trail Running</option>
                </select>
              </div>
          </div>
          <div class="col-6">
              <div class="mb-3">
                <label for="" class="form-label">N° Participantes</label>
                <input type="number" class="form-control" id="number_participants" name="number_participants">
              </div>
          </div>
          <div class="col-12">
              <div class="mb-3">
                <label for="" class="form-label">Fecha de Salida</label>
                <input type="datetime-local" class="form-control" id="departure_date" name="departure_date">
              </div>
          </div>
          <div class="col-12">
              <div class="mb-3">
                <label for="" class="form-label">Fecha de Regreso</label>
                <input type="datetime-local" class="form-control" id="return_date" name="return_date">
              </div>
          </div>
      </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
          <input type="submit" class="btn btn-dark btn-save-load" value="Guardar">
        </div>
      </div>
    </div>
    </form>
</div>