<div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content modal-extra-background">
      <div class="modal-header">
        <h5 class="modal-title" id="CreateModalLabel"><i class="fa-solid fa-user-tie"></i> Registrar Usuario</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body">
        <form id="formUsuario" class="form" method="POST">
          @csrf
          <div class="mb-3">
            <label for="voluntary_id" class="form-label">Voluntario</label>
            <select class="form-select border border-gray p-2" name="voluntary_id" id="voluntary_id" required>
              <option value="" selected>Seleccione el correspondiente voluntario</option>
              @foreach($voluntarios as $voluntario)
                <option value="{{ $voluntario->id }}">{{ $voluntario->name }} {{ $voluntario->lastname }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input type="text" class="form-control border border-gray p-2" id="name" name="name" required>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control border border-gray p-2" id="email" name="email" required>
          </div>
          <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control border border-gray p-2" id="password" name="password" autocomplete="new-password" required>
          </div>
          <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Password</label>
            <input type="password" class="form-control border border-gray p-2" id="password_confirmation" name="password_confirmation" autocomplete="new-password" required>
          </div>
          <div class="mb-3">
            <label for="role" class="form-label">Rol</label>
            <select class="form-select border border-gray p-2" id="role" name="role" required>
              <option value="" selected disabled>Seleccione el rol</option>
              @foreach($roles as $role)
                <option value="{{ $role->slug }}">{{ $role->name }}</option>
              @endforeach
            </select>
          </div>
          <div class="mb-3">
            <label for="status" class="form-label">Estado</label>
            <select class="form-select border border-gray p-2" id="status" name="status" required>
              <option value="">Seleccione el estado</option>
              <option value="A">Activo</option>
              <option value="I">Inactivo</option>
            </select>
          </div>
          <button type="submit" class="btn btn-success" id="submitUsuario"><i class="fa-solid fa-floppy-disk"></i> Agregar Usuario</button>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
