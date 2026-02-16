<!-- Modal -->
<div class="modal fade" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="CreateModalLabel"><i class="fa-solid fa-newspaper"></i> Nueva Noticia</h5>
                <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formNews" class="form" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Titulo<span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control border border-gray p-2" id="title"
                                    name="title" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Descripción<span
                                        class="text-danger">*</span></label>
                                <textarea name="descripcion" id="editor" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="category_id" class="form-label">Categoria<span
                                        class="text-danger">*</span></label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Seleccione una categoria</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="featured" class="form-label">Destacada<span
                                        class="text-danger">*</span></label>
                                <select name="featured" id="featured" class="form-control">
                                    <option value="">Seleccione Destacada</option>
                                    <option value="1">Destacada</option>
                                    <option value="0">No Destacada</option>
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="image" class="form-label">Imagen Referencial<span
                                            class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image"
                                        class="form-control border border-gray p-2"
                                        accept="image/png,image/jpeg,image/jpg" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i>
                                    Crear
                                    Noticia</button>
                                <button type="button" class="btn btn-warning me-2" data-bs-toggle="modal"
                                    data-bs-target="#CreateCategory">
                                    <i class="fa-solid fa-plus"></i> Agregar Categoria
                                </button>
                            </div>
                        </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
