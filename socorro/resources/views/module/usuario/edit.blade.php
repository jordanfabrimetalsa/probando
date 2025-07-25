<div class="modal fade" id="EditModal" tabindex="-1" aria-labelledby="EditModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="EditModalLabel"><i class="fa-solid fa-user-tie"></i> Editar Usuario</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="formUsuarioEdit" class="form" method="POST">
          @csrf
          @method('PUT')
          <input type="hidden" id="id" name="id">
          <div class="mb-3">
            <p>Nombre Usuario: <span id="name"></span></p>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Rol</label>
            <select class="form-select border border-gray p-2" aria-label="Default select example" id="role" name="role">
              <option selected>Seleccione el Rol</option>
              <option value="admin">Admin</option>
              <option value="leader">Lider</option>
              <option value="comun">Común</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Estado</label>
            <select class="form-select border border-gray p-2" aria-label="Default select example" id="status" name="status">
              <option selected>Seleccione el Estado</option>
              <option value="A">Activo</option>
              <option value="I">Inactivo</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Guardar Cambios</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>