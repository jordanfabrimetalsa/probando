<div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="CreateModalLabel"><i class="fa-solid fa-register"></i> Registrar Rescate</h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formUsuario" class="form" method="POST">
            @csrf
            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2 text-center">Información General</h5>
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="type" class="form-label">Tipo</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" value="{{ old('type') }}" name="type">
                            <option selected>Seleccione el Tipo</option>
                            <option value="rescue">Rescate</option>
                            <option value="search">Busqueda</option>
                            <option value="passing">Recuperación</option>

                        </select>
                    </div>
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="place" class="form-label">Lugar/Montaña</label>
                        <input type="text" class="form-control border border-gray p-2" id="place" value="{{ old('place') }}" name="place" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="road" class="form-label">Ruta</label>
                        <input type="text" class="form-control border border-gray p-2" id="road" value="{{ old('road') }}" name="road" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="weather" class="form-label">Clima</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="weather">
                            <option selected>Seleccione el Clima</option>
                            <option value="hot">Despejado</option>
                            <option value="cloudy">Nublado</option>
                            <option value="rainy">Lluvia</option>
                            <option value="snowy">Nieve</option>
                            <option value="stormy">Tormenta</option>
                            <option value="windy">Ventoso</option>
                        </select>
                    </div>

                </div>
                <div class="row p-2">
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="kilometer_total" class="form-label">Kilometraje Total</label>
                        <input type="number" class="form-control border border-gray p-2" id="kilometer_total" value="{{ old('kilometer_total') }}" name="kilometer_total" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="different_height" class="form-label">Desnivel</label>
                        <input type="number" class="form-control border border-gray p-2" id="different_height" value="{{ old('different_height') }}" name="different_height" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="quantity_people" class="form-label">Cantidad de personas</label>
                        <input type="number" class="form-control border border-gray p-2" id="quantity_people" value="{{ old('quantity_people') }}" name="quantity_people" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="quantity_voluntaries" class="form-label">Cantidad de voluntarios</label>
                        <input type="number" class="form-control border border-gray p-2" id="quantity_voluntaries" value="{{ old('quantity_voluntaries') }}" name="quantity_voluntaries" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="helper_external" class="form-label">Trabajo Conjunto</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="helper_external" value="{{ old('helper_external') }}">
                            <option selected>Seleccione el Ayudante Externo</option>
                            <option value="yes">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="external_helper" class="form-label">Institucion Externa</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="helper_external" value="{{ old('helper_external') }}">
                            <option selected>Seleccione el Ayudante Externo</option>
                            <option value="gope">Gope</option>
                            <option value="conaf">Conaf</option>
                            <option value="bomberos">Bomberos</option>
                            <option value="carabineros">Carabineros</option>
                            <option value="parme">PARME</option>
                            <option value="gremm">Gremm</option>
                            <option value="unrem">UNIREM</option>
                            <option value="rio_montaña">Rio Montaña</option>
                            <option value="alfa_andino">Alfa Andino</option>
                            <option value="pdi">PDI</option>
                            <option value="seguridad_privada">Seguridad Privada</option>
                            <option value="otros">Otros</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2 text-center">Información del Accidentado</h5>
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="name_accident" class="form-label">Nombre Accidentado</label>
                        <input type="text" class="form-control border border-gray p-2" id="name_accident" value="{{ old('name_accident') }}" name="name_accident" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="phone_accident" class="form-label">Telefono</label>
                        <input type="number" class="form-control border border-gray p-2" id="phone_accident" value="{{ old('phone_accident') }}" name="phone_accident" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="email_accident" class="form-label">Correo</label>
                        <input type="email" class="form-control border border-gray p-2" id="email_accident" value="{{ old('email_accident') }}" name="email_accident" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="address" class="form-label">Direccion</label>
                        <input type="text" class="form-control border border-gray p-2" id="address" value="{{ old('address') }}" name="address" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="city" class="form-label">Comuna</label>
                        <input type="text" class="form-control border border-gray p-2" id="city" value="{{ old('city') }}" name="city" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="state" class="form-label">Region</label>
                        <input type="text" class="form-control border border-gray p-2" id="state" value="{{ old('state') }}" name="state" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="allergic" class="form-label">¿Alergico?</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="allergic" value="{{ old('allergic') }}">
                            <option selected>Seleccione </option>
                            <option value="yes">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="disease" class="form-label">¿Enfermedad?</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="disease" value="{{ old('disease') }}">
                            <option selected>Seleccione</option>
                            <option value="yes">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2 text-center">Detalle del Rescate</h5>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="date_call" class="form-label">Fecha de Llamada</label>
                        <input type="datetime-local" class="form-control border border-gray p-2" id="date_call" value="{{ old('date_call') }}" name="date_call" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="date_start_trek" class="form-label">Fecha de Inicio del Rescate</label>
                        <input type="datetime-local" class="form-control border border-gray p-2" id="date_start_trek" value="{{ old('date_start_trek') }}" name="date_start_trek" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="date_middle_trek" class="form-label">Fecha de Encuentro Rescatado</label>
                        <input type="datetime-local" class="form-control border border-gray p-2" id="date_middle_trek" value="{{ old('date_middle_trek') }}" name="date_middle_trek" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="date_finish_rescue" class="form-label">Fecha de Finalizacion Rescate</label>
                        <input type="datetime-local" class="form-control border border-gray p-2" id="date_finish_rescue" value="{{ old('date_finish_rescue') }}" name="date_finish_rescue" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="injury" class="form-label">Tipo de Lesión</label>
                        <input type="text" class="form-control border border-gray p-2" id="injury" value="{{ old('injury') }}" name="injury" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="gravity" class="form-label">Gravedad de Lesión</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="gravity" value="{{ old('gravity') }}">
                            <option selected>Seleccione </option>
                            <option value="leve">Leve</option>
                            <option value="medio">Medio</option>
                            <option value="grave">Grave</option>
                        </select>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="medical_assistance" class="form-label">¿Requirio Asistencia Medica?</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="medical_assistance" value="{{ old('medical_assistance') }}">
                            <option selected>Seleccione </option>
                            <option value="yes">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="Stretcher" class="form-label">¿Requirio Camillaje?</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="Stretcher" value="{{ old('Stretcher') }}">
                            <option selected>Seleccione</option>
                            <option value="yes">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="transport" class="form-label">Tipo Transporte</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="transport" value="{{ old('transport') }}">
                            <option selected>Seleccione</option>
                            <option value="sked">Sked</option>
                            <option value="kong">Kong</option>
                        </select>
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="helicopter" class="form-label">¿Requirio Helitransporte?</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="helicopter" value="{{ old('helicopter') }}">
                            <option selected>Seleccione</option>
                            <option value="yes">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2 text-center">Estado Actual</h5>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="name_accident" class="form-label">Jefe de Operaciones</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="helicopter" value="{{ old('helicopter') }}">
                            <option selected>Seleccione</option>
                            @foreach ($voluntaries as $voluntary)
                                <option value="{{ $voluntary->id }}">{{ $voluntary->name }} {{ $voluntary->last_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="transport" class="form-label">Estado de Emergencia</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="transport" value="{{ old('transport') }}">
                            <option selected>Seleccione</option>
                            <option value="pending">Pendiente</option>
                            <option value="in_progress">En Proceso</option>
                            <option value="completed">Completado</option>
                        </select>
                    </div>
                    <div class="mb-2 col-lg-12 col-md-12 col-sm-12">
                        <label for="name_accident" class="form-label">Observación</label>
                        <textarea class="form-control border border-gray p-2" id="name_accident" value="{{ old('name_accident') }}" name="name_accident" aria-describedby="emailHelp"></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Agregar Rescate</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
