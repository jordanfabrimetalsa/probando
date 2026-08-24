<!-- Modal -->
<div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content modal-extra-background">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateModalLabel"><i class="fa-solid fa-user-plus"></i> Registrar Voluntario
                </h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formVoluntario" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Delegación<span
                                        class="text-danger">*</span></label>
                                <select class="form-select border border-gray p-2" aria-label="Default select example"
                                    id="delegation_id" name="delegation_id" required>
                                    <option value="" selected disabled>Seleccione Delegación</option>
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
                                <input type="file" class="form-control border border-gray p-2" id="image"
                                    name="image">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Número de Documento<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control border border-gray p-2" id="document"
                                    name="document" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nombre<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control border border-gray p-2" id="name"
                                    name="name" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Apellido<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control border border-gray p-2" id="lastname"
                                    name="lastname" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Telefono<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control border border-gray p-2" id="phone"
                                    name="phone" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Fecha Nacimiento<span
                                        class="text-danger">*</span></label>
                                <input type="date" class="form-control border border-gray p-2" id="birthday"
                                    name="birthday" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Dirección<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control border border-gray p-2" id="address"
                                    name="address" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Profesión<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control border border-gray p-2" id="profession"
                                    name="profession" aria-describedby="emailHelp" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Sexo<span
                                        class="text-danger">*</span></label>
                                <select class="form-select border border-gray p-2" aria-label="Default select example"
                                    id="gender" name="gender" required>
                                    <option value="" selected disabled>Seleccione Opción</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Alergico<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select border border-gray p-2"
                                        aria-label="Default select example" id="allergic" name="allergic" required>
                                        <option selected>Seleccione Opción</option>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Enfermedad<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select border border-gray p-2"
                                        aria-label="Default select example" id="disease" name="disease" required>
                                        <option selected>Seleccione Opción</option>
                                        <option value="1">Sí</option>
                                        <option value="0">No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label">Medicamento<span
                                            class="text-danger">*</span></label>
                                    <select class="form-select border border-gray p-2"
                                        aria-label="Default select example" id="medicine" name="medicine" required>
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
                                <label for="exampleInputPassword1" class="form-label">¿Tiene Vehiculo?<span
                                        class="text-danger">*</span></label>
                                <select class="form-select border border-gray p-2" aria-label="Default select example"
                                    id="vehicle" name="vehicle" required>
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
                                <label for="exampleInputPassword1" class="form-label">¿Tiene Licencia de Conducir
                                    Clase B?<span class="text-danger">*</span></label>
                                <select class="form-select border border-gray p-2" aria-label="Default select example"
                                    id="license" name="license" required>
                                    <option selected>Seleccione Opción</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">¿Pagos al Día?<span
                                        class="text-danger">*</span></label>
                                <select class="form-select border border-gray p-2" aria-label="Default select example"
                                    id="payment" name="payment" required>
                                    <option selected>Seleccione Opción</option>
                                    <option value="1">Sí</option>
                                    <option value="0">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tipo de Sangre<span
                                        class="text-danger">*</span></label>
                                <select class="form-select border border-gray p-2" aria-label="Default select example"
                                    id="blood_type" name="blood_type" required>
                                    <option selected disabled>Seleccione Opción</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O+">O+</option>
                                    <option value="O-">O-</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Estado</label>
                                <select class="form-select border border-gray p-2" aria-label="Default select example"
                                    id="status" name="status" required>
                                    <option selected disabled>Seleccione el Estado</option>
                                    <option value="A">Activo</option>
                                    <option value="I">Inactivo</option>
                                    <option value="S">Suspendido</option>
                                    <option value="R">Receso</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Tipo de Socorrista</label>
                                <select class="form-select border border-gray p-2" aria-label="Default select example"
                                    id="type" name="type" required>
                                    <option selected disabled>Seleccione el Tipo</option>
                                    <option value="V">Voluntario</option>
                                    <option value="A">Aspirante</option>
                                    <option value="H">Honorario</option>
                                    <option value="C">Cooperador</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label>Fecha de inicio de servicio</label>
                                <input type="date" class="form-control" id="init_voluntary" name="init_voluntary" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Agregar
                        Voluntario</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
