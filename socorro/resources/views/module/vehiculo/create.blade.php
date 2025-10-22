<div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content modal-extra-background">
        <div class="modal-header">
          <h5 class="modal-title" id="CreateModalLabel"><i class="fa-solid fa-truck-monster"></i> Registrar Vehículo</h5>
          <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form id="formVehiculo" class="form" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-6">
                    <div class="mb-3">
                        <label for="brand_id" class="form-label">Marca</label>
                        <select name="brand_id" id="brand_id" class="form-control" required>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Modelo</label>
                        <select name="model_id" id="model_id" class="form-control">
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="mb-3">
                        <label for="plate" class="form-label">Patente</label>
                        <input type="text" class="form-control border border-gray p-2" id="plate" name="plate" maxlength="7" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="motor" class="form-label">Motor</label>
                        <input type="text" class="form-control border border-gray p-2" name="motor" id="motor" maxlength="20" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="chassis" class="form-label">Chasis</label>
                        <input type="text" class="form-control border border-gray p-2" id="chassis" name="chassis" maxlength="17" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="mb-3">
                        <label for="colour" class="form-label">Color</label>
                        <input type="text" class="form-control border border-gray p-2" name="colour" id="colour" maxlength="20" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="year" class="form-label">Año</label>
                        <input type="number" class="form-control border border-gray p-2" name="year" id="year" min="1950" max="2050" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="type" class="form-label">Tipo</label>
                        <select name="type" id="type" class="form-control" required>
                            <option value="">Seleccione un tipo</option>
                            <option value="4x4">4x4</option>
                            <option value="4x2">4x2</option>
                            <option value="City">City</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="mb-3">
                        <label for="type" class="form-label">Delegación Perteneciente</label>
                        <select name="id_delegations" id="id_delegations" class="form-control" required>
                            <option value="">Seleccione una delegación</option>
                            @foreach ($delegations as $delegation)
                                <option value="{{ $delegation->id }}">{{ $delegation->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="kilometer" class="form-label">Kilometraje</label>
                        <input type="number" name="kilometer" id="kilometer" class="form-control" required>
                    </div>
                </div>
                <div class="col-4">
                    <div class="mb-3">
                        <label for="status" class="form-label">Estado</label>
                        <select name="status" id="status" class="form-control" required>
                            <option value="">Seleccione un estado</option>
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Agregar Vehículo</button>
            </form>
            <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal" data-bs-target="#CreateBrandModal">
                <i class="fa-solid fa-plus"></i> Agregar Marca
            </button>
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#CreateModelModal">
                <i class="fa-solid fa-plus"></i> Agregar Modelo
            </button>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
