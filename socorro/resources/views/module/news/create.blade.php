<div class="modal fade news-create-modal" id="CreateModal" tabindex="-1" aria-labelledby="CreateModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header news-form__header">
                <div class="d-flex align-items-center gap-3">
                    <span class="news-form__header-icon"><i class="fa-regular fa-newspaper"></i></span>
                    <div>
                        <span class="news-form__eyebrow">CENTRO DE PUBLICACIONES</span>
                        <h5 class="modal-title" id="CreateModalLabel">Crear una nueva noticia</h5>
                        <p>Prepara el contenido que verá la comunidad.</p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <form id="formNews" method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="modal-body news-form__body">
                    <div class="row g-4">
                        <div class="col-lg-8">
                            <section class="news-form__section">
                                <div class="news-form__section-title">
                                    <span>01</span>
                                    <div><h6>Contenido editorial</h6><p>Escribe un título claro y desarrolla la noticia.</p></div>
                                </div>
                                <div class="mb-4">
                                    <label for="title" class="form-label">Título de la noticia <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="title" name="title" maxlength="180" placeholder="Ej: Entrenamiento nacional de rescate técnico" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div>
                                    <label for="editor" class="form-label">Contenido <span class="text-danger">*</span></label>
                                    <textarea name="editor" id="editor" class="form-control" rows="12" required></textarea>
                                    <div class="invalid-feedback" data-error-for="editor"></div>
                                </div>
                            </section>
                        </div>
                        <div class="col-lg-4">
                            <section class="news-form__section h-100">
                                <div class="news-form__section-title">
                                    <span>02</span>
                                    <div><h6>Publicación</h6><p>Define cómo se presentará.</p></div>
                                </div>
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Categoría <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <select name="category_id" id="category_id" class="form-select" required><option value="">Seleccione una categoría</option></select>
                                        <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#CreateCategoryModal" title="Crear categoría"><i class="fa-solid fa-plus"></i></button>
                                    </div>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <div class="mb-4">
                                    <label for="featured" class="form-label">Visibilidad <span class="text-danger">*</span></label>
                                    <select name="featured" id="featured" class="form-select" required>
                                        <option value="">Seleccione una opción</option>
                                        <option value="1">Noticia destacada</option>
                                        <option value="0">Publicación normal</option>
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                                <label class="form-label">Imagen de portada <span class="text-danger">*</span></label>
                                <label for="image" class="news-cover-upload" id="newsCoverUpload">
                                    <img id="newsImagePreview" alt="Vista previa de portada">
                                    <span class="news-cover-upload__empty">
                                        <i class="fa-regular fa-image"></i><strong>Seleccionar portada</strong>
                                        <small>JPG, PNG o WEBP · máximo 4 MB</small>
                                    </span>
                                </label>
                                <input type="file" name="image" id="image" class="visually-hidden" accept="image/png,image/jpeg,image/webp" required>
                                <div class="invalid-feedback" data-error-for="image"></div>
                            </section>
                        </div>
                    </div>
                </div>
                <div class="modal-footer news-form__footer">
                    <span><i class="fa-solid fa-circle-info"></i> Los campos con * son obligatorios</span>
                    <div class="d-flex gap-2">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-dark" id="submitNews"><i class="fa-solid fa-paper-plane me-2"></i>Publicar noticia</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
