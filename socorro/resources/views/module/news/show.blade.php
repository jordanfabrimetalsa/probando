<div class="modal fade" id="ShowModal" tabindex="-1" aria-labelledby="ShowModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-extra-background">
      <div class="modal-header">
        <h5 class="modal-title" id="ShowModalLabel"><i class="fa-solid fa-plus"></i> <span id="show-title"></span></h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">
                            <span id="show-title"></span>
                            <span class="badge bg-warning float-end" id="show-category"></span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p><span class="text-dark">Publicado el:</span> <span id="show-created-at" class="badge bg-secondary"></span></p>
                            <p><span class="text-dark">Autor:</span> <span id="show-author"></span></p>
                        </div>
                        <hr><br>
                        <div class="text-justify border-radius border p-2">
                            <p id="show-content"></p>
                            <img id="show-image" src="" alt="Imagen de la noticia" class="img-fluid w-100 border-radius">
                        </div>
                        <br><br>
                        <span class="badge bg-danger" id="show-featured"></span>
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
