<div class="modal fade" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content modal-extra-background">
      <div class="modal-header">
        <h5 class="modal-title" id="newsModalLabel"><i class="fa-solid fa-plus"></i> <span id="news-title"></span></h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">
                            <span id="big-news-title"></span>
                            <span class="badge bg-warning float-end" id="news-category"></span>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <p><span class="text-dark">Publicado el:</span> <span id="show-created-at" class="badge bg-secondary"></span></p>
                        </div>
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

<script>
    function showNews(id){
      try {
        $.ajax({
          url: 'news-main/show/' + id,
          type: 'GET',
          success: function(response){
            $('#newsModal').modal('show');
            $('#news-title').text(response.title);
            $('#big-news-title').text(response.title);
            $('#show-content').html(response.description);
            $('#news-category').text(response.category?.name || '');
            $('#show-image').attr('src', response.image);
            $('#show-created-at').text(moment(response.created_at).format('DD/MM/YYYY HH:mm:ss'));
            $('#show-featured').text(response.is_featured ? 'Destacado' : 'No Destacado');
          },
          error: function(error){
            console.error(error);
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: 'Error al mostrar articulo'
            });
          }
        });
      } catch(e){
        console.error(e);
      }
    }
</script>
