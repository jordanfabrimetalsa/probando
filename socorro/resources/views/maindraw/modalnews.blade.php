<div class="modal fade news-detail-modal" id="newsModal" tabindex="-1" aria-labelledby="newsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content modal-extra-background">
      <div class="modal-header">
        <h5 class="modal-title" id="newsModalLabel"><i class="fa-regular fa-newspaper me-2"></i> Noticia</h5>
        <button type="button" class="btn-close btn-close-black" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body p-0">
        <div class="news-detail-hero">
            <img id="show-image" src="" alt="Imagen de la noticia">
            <div class="news-detail-heading">
                <div><span class="news-category" id="news-category"></span> <span id="show-featured" class="badge bg-danger"></span></div>
                <h3 id="big-news-title"></h3>
                <small><i class="fa-regular fa-calendar me-1"></i> <span id="show-created-at"></span></small>
            </div>
        </div>
        <div class="news-detail-copy" id="show-content"></div>
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
            $('#big-news-title').text(response.title);
            $('#show-content').html(response.description);
            $('#news-category').text(response.category?.name || '');
            $('#show-image').attr('src', response.image);
            $('#show-created-at').text(moment(response.created_at).format('DD/MM/YYYY HH:mm:ss'));
            $('#show-featured').text(response.is_featured ? 'Destacada' : '').toggle(!!response.is_featured);
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
