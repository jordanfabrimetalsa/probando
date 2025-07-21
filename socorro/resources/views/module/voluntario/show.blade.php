<div class="modal fade" id="ShowModal" tabindex="-1" aria-labelledby="ShowModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ShowModalLabel">Información de Voluntario</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="container-fluid px-2 px-md-4">
          <div class="page-header min-height-100 border-radius-xl mt-4 bg-gradient-dark">
            <span class="mask  bg-gradient-dark  opacity-6"></span>
          </div>
          <div class="card card-body mx-2 mx-md-2 mt-n6">
            <div class="row gx-4 mb-2">
              <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                  <img src="../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                </div>
              </div>
              <div class="col-auto my-auto">
                <div class="h-100">
                  <h5 class="mb-1">
                    <span id="fullname_title_show"></span>
                  </h5>
                  <p class="mb-0 font-weight-normal text-sm">
                    <span id="type_show"></span> - Delegación <span id="delegation_show"></span>
                  </p>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card card-plain h-100">
                  <div class="card-header pb-0 p-3">
                    <h6 class="mb-0">Información Personal</h6>
                  </div>
                    <div class="card-body p-3">
                      <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nombre Completo:</strong> &nbsp; <span id="fullname_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Número de Identificación:</strong> &nbsp; <span id="document_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Fecha de Nacimiento:</strong> &nbsp; <span id="birthday_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Genero:</strong> &nbsp; <span id="gender_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <span id="email_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Dirección:</strong> &nbsp; <span id="address_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Profesión:</strong> &nbsp; <span id="profession_show"></span></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                      <h6 class="mb-0">Información Médica</h6>
                    </div>
                    <div class="card-body p-3">
                      <ul class="list-group">
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Tipo de Sangre:</strong> &nbsp; <span id="blood_type_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Alergico:</strong> &nbsp; <span id="allergic_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Enfermedad:</strong> &nbsp; <span id="disease_show"></span></li>
                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Medicamento:</strong> &nbsp; <span id="medicine_show"></span></li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                      <h6 class="mb-0">Configuración</h6>
                    </div>
                    <div class="card-body p-3">
                      <ul class="list-group">
                        <li class="list-group-item border-0 px-0">
                          <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="status_show" checked>
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="status_show" id="text_status_show"></label>
                          </div>
                          <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="payment_show" checked>
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="payment_show" id="text_payment_show"></label>
                          </div>
                          <div class="form-check form-switch ps-0">
                            <input class="form-check-input ms-auto" type="checkbox" id="license_show" checked>
                            <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="license_show" id="text_license_show"></label>
                          </div>
                        </li>
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                      <h6 class="mb-0">Números de Emergencia</h6>
                    </div>
                    <div class="card-body p-3">
                      <ul class="list-group" id="emergency_name_show">
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-12">
                  <div class="card card-plain h-100">
                    <div class="card-header pb-0 p-3">
                      <h6 class="mb-0">Anotaciones</h6>
                    </div>
                    <div class="card-body p-3">
                      <ul class="list-group" id="remark_name_show">
                      </ul>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
      function showVoluntary(id){
      try{
        $.ajax({
          url: 'voluntarios/show/' + id,
          type: 'GET',
          success: function(response){
            console.log(response);
            $('#ShowModal').modal('show');
            $('#fullname_title_show').text(response.name + ' ' + response.lastname);
            $('#fullname_show').text(response.name + ' ' + response.lastname);
            $('#document_show').text(response.document);
            $('#email_show').text(response.email);
            $('#phone_show').text(response.phone);
            $('#birthday_show').text(response.birthday);
            $('#address_show').text(response.address);
            $('#profession_show').text(response.profession);
            $('#gender_show').text(response.gender == 'M' ? 'Masculino' : 'Femenino');
            $('#allergic_show').text(response.allergic == 1 ? 'Si' : 'No');
            $('#disease_show').text(response.disease == 1 ? 'Si' : 'No');
            $('#medicine_show').text(response.medicine == 1 ? 'Si' : 'No');
            $('#vehicle_show').text(response.vehicle == 1 ? 'Si' : 'No');
            $('#license_show').text(response.license == 1 ? 'Si' : 'No');

            $('#payment_show').attr('checked', response.payment == 1 ? $('#text_payment_show').text('Pagado') : $('#text_payment_show').text('No pagado'));
            $('#status_show').attr('checked', response.status == 1 ? $('#text_status_show').text('Activo') : $('#text_status_show').text('Inactivo'));
            $('#license_show').attr('checked', response.license == 1 ? $('#text_license_show').text('Tiene licencia') : $('#text_license_show').text('No tiene licencia'));

            $('#blood_type_show').text(response.blood_type);
            $('#type_show').text(response.type == 'V' ? 'Voluntario' : 'Aspirante');
            $('#delegation_show').text(response.delegation.name);

            var emergency = '';
            response.emergency.forEach(element => {
              emergency += `<li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                              <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">${element.emergecy_name}</h6>
                                <p class="mb-0 text-xs">${element.relationship}</p>
                              </div>
                              <a class="btn btn-danger pe-3 mb-0 ms-auto w-30 w-md-auto text-white text-center" href="tel:${element.emergency_phone}"><i class="fa-solid fa-phone-volume"></i></a>
                            </li>`;
            });
            $('#emergency_name_show').html(emergency);

            var remark = '';
            response.remark.forEach(element => {
              remark += `<li class="list-group-item border-0 d-flex align-items-center px-0 mb-2 pt-0">
                              <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm">${element.remark}</h6>
                                <p class="mb-0 text-xs">${moment(element.created_at).format('DD-MM-YYYY')} <span class="badge bg-danger">Grave</span></p>
                              </div>
                            </li>`;
            });
            $('#remark_name_show').html(remark);

          },
          error: function(error){
            Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al mostrar voluntario' + JSON.stringify(error),
          });
          }
        });
      }catch(e){
        console.log(e);  
      }
    }
</script>