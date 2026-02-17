<div class="modal fade" id="ShowModal" tabindex="-1" aria-labelledby="ShowModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content modal-extra-background">
      <div class="modal-header">
        <h5 class="modal-title" id="ShowModalLabel"><i class="fa-solid fa-plus"></i> Articulo</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center"><span id="show-title"></span></h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p><span class="text-dark">Categoria:</span> <span class="badge bg-warning" id="show-category"></span></p>
                            <p><span class="text-dark"></span> <span id="show-created-at"></span></p>
                        </div>
                        <hr><br>
                        <p id="show-content"></p>
                        <br><br>
                        <img id="show-image" src="" alt="Imagen del articulo" class="img-fluid bordered-radius">
                        <br><br><span class="badge bg-danger" id="show-featured"></span>
                        <br><hr>
                        <p><span class="text-dark">Autor:</span> <span id="show-author"></span></p>
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
