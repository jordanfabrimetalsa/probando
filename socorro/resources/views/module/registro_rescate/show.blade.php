<div class="modal fade" id="ShowModal" tabindex="-1" aria-labelledby="ShowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content modal-extra-background">
        <div class="modal-header">
          <h5 class="modal-title" id="ShowModalLabel"><i class="fa-solid fa-register"></i> Información del Rescate</h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formRescueUpdate" class="form" method="POST">
            @method('PUT')
            @csrf
            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2 text-center">Información General</h5>
                    <input type="hidden" name="id_show" id="id_show">
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="type" class="form-label">Tipo</label>
                        <select disabled class="form-select border border-gray p-2" aria-label="Default select example" name="type_show" id="type_show">
                            <option selected>Seleccione el Tipo</option>
                            <option value="accident">Accidente</option>
                            <option value="search">Busqueda</option>
                            <option value="passing">Recuperación</option>
                        </select>
                        <input type="hidden" name="type_show_hidden" id="type_show_hidden">
                    </div>
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="place" class="form-label">Lugar/Montaña</label>
                        <input type="text" class="form-control border border-gray p-2" name="place_show" id="place_show" aria-describedby="emailHelp" readonly>
                    </div>
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="road" class="form-label">Ruta</label>
                        <input type="text" class="form-control border border-gray p-2" name="road_show" id="road_show" aria-describedby="emailHelp" readonly>
                    </div>
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="weather" class="form-label">Clima</label>
                        <select disabled class="form-select border border-gray p-2" aria-label="Default select example" name="weather_show" id="weather_show">
                            <option selected>Seleccione el Clima</option>
                            <option value="hot">Despejado</option>
                            <option value="cloudy">Nublado</option>
                            <option value="rainy">Lluvia</option>
                            <option value="snowy">Nieve</option>
                            <option value="stormy">Tormenta</option>
                            <option value="windy">Ventoso</option>
                        </select>
                        <input type="hidden" name="weather_show_hidden" id="weather_show_hidden">
                    </div>

                </div>
                <div class="row p-2">
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="kilometer_total" class="form-label">Kilometraje Total</label>
                        <input type="number" class="form-control border border-gray p-2" name="kilometer_total_show" id="kilometer_total_show" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="different_height" class="form-label">Desnivel</label>
                        <input type="number" class="form-control border border-gray p-2" name="different_height_show" id="different_height_show" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="quantity_people" class="form-label">Cantidad de personas</label>
                        <input type="number" class="form-control border border-gray p-2" name="quantity_people_show" id="quantity_people_show" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3 col-lg-3 col-md-6 col-sm-12">
                        <label for="quantity_voluntaries" class="form-label">Cantidad de voluntarios</label>
                        <input type="number" class="form-control border border-gray p-2" name="quantity_voluntaries_show" id="quantity_voluntaries_show" aria-describedby="emailHelp" readonly>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="helper_external" class="form-label">Ayuda Externa</label>
                        <select disabled class="form-select border border-gray p-2" aria-label="Default select example" name="helper_external_show" id="helper_external_show">
                            <option selected>Seleccione el Ayudante Externo</option>
                            <option value="yes">Si</option>
                            <option value="no">No</option>
                        </select>
                        <input type="hidden" name="helper_external_show_hidden" id="helper_external_show_hidden">
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="external_helper" class="form-label">Institucion Externa</label>
                        <select disabled class="form-select border border-gray p-2" aria-label="Default select example" name="external_helper_show" id="external_helper_show">
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
                        <input type="hidden" name="external_helper_show_hidden" id="external_helper_show_hidden">
                    </div>
                </div>
            </div>
            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2 text-center">Información del Accidentado</h5>
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="name_accident" class="form-label">Nombre Accidentado</label>
                        <input type="text" class="form-control border border-gray p-2" name="name_accident_show" id="name_accident_show" aria-describedby="emailHelp" readonly>
                    </div>
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="phone_accident" class="form-label">Telefono</label>
                        <input type="number" class="form-control border border-gray p-2" name="phone_accident_show" id="phone_accident_show" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="email_accident" class="form-label">Correo</label>
                        <input type="email" class="form-control border border-gray p-2" name="email_accident_show" id="email_accident_show" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="address" class="form-label">Direccion</label>
                        <input type="text" class="form-control border border-gray p-2" name="address_show" id="address_show" aria-describedby="emailHelp">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="city" class="form-label">Comuna</label>
                        <input type="text" class="form-control border border-gray p-2" name="city_show" id="city_show" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="state" class="form-label">Region</label>
                        <input type="text" class="form-control border border-gray p-2" name="state_show" id="state_show" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="allergic" class="form-label">¿Alergico?</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="allergic_show" id="allergic_show">
                            <option selected>Seleccione </option>
                            <option value="yes">Si</option>
                            <option value="no">No</option>
                        </select>
                    </div>
                    <div class="mb-2 col-lg-3 col-md-6 col-sm-12">
                        <label for="disease" class="form-label">¿Enfermedad?</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="disease_show" id="disease_show">
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
                        <input type="datetime-local" class="form-control border border-gray p-2" name="date_call_show" id="date_call_show" aria-describedby="emailHelp" readonly>
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="date_start_trek" class="form-label">Fecha de Inicio del Rescate</label>
                        <input type="datetime-local" class="form-control border border-gray p-2" name="date_start_trek_show" id="date_start_trek_show" aria-describedby="emailHelp" readonly>
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="date_middle_trek" class="form-label">Fecha de Encuentro Rescatado</label>
                        <input type="datetime-local" class="form-control border border-gray p-2" name="date_middle_trek_show" id="date_middle_trek_show" aria-describedby="emailHelp" readonly>
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="date_finish_rescue" class="form-label">Fecha de Finalizacion Rescate</label>
                        <input type="datetime-local" class="form-control border border-gray p-2" name="date_finish_rescue_show" id="date_finish_rescue_show" aria-describedby="emailHelp" readonly>
                    </div>
                </div>
                <div class="row p-2">
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="injury" class="form-label">Tipo de Lesión</label>
                        <input type="text" class="form-control border border-gray p-2" name="injury_show" id="injury_show" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="gravity" class="form-label">Gravedad de Lesión</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="gravity_show" id="gravity_show">
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
                        <select disabled class="form-select border border-gray p-2" aria-label="Default select example" name="medical_assistance_show" id="medical_assistance_show" >
                            <option selected>Seleccione </option>
                            <option value="yes">Si</option>
                            <option value="no">No</option>
                        </select>
                        <input type="hidden" name="medical_assistance_show_hidden" id="medical_assistance_show_hidden">
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="Stretcher" class="form-label">¿Requirio Camillaje?</label>
                        <select disabled class="form-select border border-gray p-2" aria-label="Default select example" name="Stretcher_show" id="Stretcher_show" >
                            <option selected>Seleccione</option>
                            <option value="yes">Si</option>
                            <option value="no">No</option>
                        </select>
                        <input type="hidden" name="Stretcher_show_hidden" id="Stretcher_show_hidden">
                    </div>
                </div>
                <div class="row p-2">
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="transport" class="form-label">Tipo Transporte</label>
                        <select disabled class="form-select border border-gray p-2" aria-label="Default select example" name="type_transport_show" id="type_transport_show" >
                            <option selected>Seleccione</option>
                            <option value="sked">Sked</option>
                            <option value="kong">Kong</option>
                        </select>
                        <input type="hidden" name="type_transport_show_hidden" id="type_transport_show_hidden">
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="helicopter" class="form-label">¿Requirio Helitransporte?</label>
                        <select disabled class="form-select border border-gray p-2" aria-label="Default select example" name="helicopter_show" id="helicopter_show">
                            <option selected>Seleccione</option>
                            <option value="yes">Si</option>
                            <option value="no">No</option>
                        </select>
                        <input type="hidden" name="helicopter_show_hidden" id="helicopter_show_hidden">
                    </div>
                </div>
            </div>

            <div class="border mb-4">
                <div class="row p-2">
                    <h5 class="modal-title mb-2 text-center">Estado Actual</h5>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="name_accident" class="form-label">Jefe de Operaciones</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="voluntary_id_show" id="voluntary_id_show">
                            <option selected disabled>Seleccionar Jefe de Operación</option>
                            @foreach ($voluntaries as $voluntary)
                                <option value="{{ $voluntary->id }}">{{ $voluntary->name }} {{ $voluntary->lastname }}</option>
                            @endforeach
                        </select>
                        <input type="hidden" name="voluntary_id_show_hidden" id="voluntary_id_show_hidden">
                    </div>
                    <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                        <label for="transport" class="form-label">Estado de Emergencia</label>
                        <select class="form-select border border-gray p-2" aria-label="Default select example" name="situation_show" id="situation_show">
                            <option selected>Seleccione</option>
                            <option value="pending">Pendiente</option>
                            <option value="in_progress">En Proceso</option>
                            <option value="completed">Completado</option>
                        </select>
                    </div>
                    <div class="mb-2 col-lg-12 col-md-12 col-sm-12">
                        <label for="observations" class="form-label">Observación</label>
                        <textarea class="form-control border border-gray p-2" id="observations_show" name="observations_show" aria-describedby="emailHelp"></textarea>
                    </div>
                </div>
            </div>
            <button type="submit" id="button-update-rescue" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Actualizar Rescate</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
</div>
