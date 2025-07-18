<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Registrar Voluntario</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formVoluntario" class="form" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Delegación<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="delegation_id" name="delegation_id">
                    @foreach ($delegations as $delegation)
                        <option value="{{ $delegation->id }}">{{ $delegation->name }}</option>
                    @endforeach
                </select>   
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label>Imagen</label>
                <input type="file" class="form-control border border-gray p-2" id="image" name="image">
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Número de Documento<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="document" name="document" aria-describedby="emailHelp">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Nombre<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="name" name="name" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Apellido<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="lastname" name="lastname" aria-describedby="emailHelp">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email<span class="text-danger">*</span></label>
                <input type="email" class="form-control border border-gray p-2" id="email" name="email" aria-describedby="emailHelp">
              </div>
            </div>
            <div class="col-6">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Telefono<span class="text-danger">*</span></label>
                <input type="text" class="form-control border border-gray p-2" id="phone" name="phone" aria-describedby="emailHelp">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Fecha Nacimiento<span class="text-danger">*</span></label>
                <input type="date" class="form-control border border-gray p-2" id="birthday" name="birthday" aria-describedby="emailHelp">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Sexo<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="gender" name="gender">
                    <option selected>Seleccione Opción</option>
                    <option value="M">Masculino</option>
                    <option value="F">Femenino</option>
                </select>
            </div>
          </div>
          <div class="row">
            <div class="col-4">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Alergico<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="allergic" name="allergic">
                    <option selected>Seleccione Opción</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>   
              </div>
            </div>
            <div class="col-4">
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Enfermedad<span class="text-danger">*</span></label>
                  <select class="form-select border border-gray p-2" aria-label="Default select example" id="disease" name="disease">
                      <option selected>Seleccione Opción</option>
                      <option value="1">Sí</option>
                      <option value="0">No</option>
                  </select>
                </div>  
              </div>
              <div class="col-4">
                <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Medicamento<span class="text-danger">*</span></label>
                  <select class="form-select border border-gray p-2" aria-label="Default select example" id="medicine" name="medicine">
                      <option selected>Seleccione Opción</option>
                      <option value="1">Sí</option>
                      <option value="0">No</option>
                  </select>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">¿Tiene Vehiculo?<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="vehicle" name="vehicle">
                    <option selected>Seleccione Opción</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">¿Tiene Licencia de Conducir Clase B?<span class="text-danger">*</span></label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="license" name="license">
                    <option selected>Seleccione Opción</option>
                    <option value="1">Sí</option>
                    <option value="0">No</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control border border-gray p-2" id="password" name="password" autocomplete="off">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Estado</label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="status" name="status">
                  <option selected>Seleccione el Estado</option>
                  <option value="1">Activo</option>
                <option value="0">Inactivo</option>
              </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Tipo de Socorrista</label>
                <select class="form-select border border-gray p-2" aria-label="Default select example" id="type" name="type">
                  <option selected>Seleccione el Tipo</option>
                  <option value="V">Voluntario</option>
                <option value="A">Aspirante</option>
              </select>
              </div>
            </div>
          </div>
          <button type="submit" class="btn btn-success btn-sm">Guardar</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
