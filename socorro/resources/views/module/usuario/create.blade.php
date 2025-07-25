<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><i class="fa-solid fa-user-tie"></i> Registrar Usuario</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formUsuario" class="form" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Nombre</label>
            <input type="text" class="form-control border border-gray p-2" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control border border-gray p-2" id="exampleInputEmail1" name="email" aria-describedby="emailHelp">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" class="form-control border border-gray p-2" id="exampleInputPassword1" name="password" autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Confirmar Password</label>
            <input type="password" class="form-control border border-gray p-2" id="exampleInputPassword1" name="password_confirmation" autocomplete="off">
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Rol</label>
            <select class="form-select border border-gray p-2" aria-label="Default select example" name="role">
              <option selected>Seleccione el Rol</option>
              <option value="admin">Admin</option>
              <option value="leader">Lider</option>
              <option value="comun">Común</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Estado</label>
            <select class="form-select border border-gray p-2" aria-label="Default select example" name="status">
              <option selected>Seleccione el Estado</option>
              <option value="A">Activo</option>
              <option value="I">Inactivo</option>
            </select>
          </div>
          <div class="mb-3">
            <label>Imagen</label>
            <input type="file" class="form-control border border-gray p-2" id="exampleInputPassword1" id="image" name="image">
          </div>
          <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Agregar Usuario</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>