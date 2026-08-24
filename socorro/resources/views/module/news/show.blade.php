<div class="modal fade news-reader-modal" id="ShowModal" tabindex="-1" aria-labelledby="ShowModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <article class="modal-content">
            <header class="news-reader__hero">
                <img id="show-image" src="" alt="Portada de la noticia" class="news-reader__image">
                <div class="news-reader__shade"></div>
                <button type="button" class="news-reader__close" data-bs-dismiss="modal" aria-label="Cerrar"><i class="fa-solid fa-xmark"></i></button>
                <div class="news-reader__heading">
                    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
                        <span class="news-reader__category" id="show-category"></span>
                        <span class="news-reader__featured" id="show-featured"><i class="fa-solid fa-star"></i> Destacada</span>
                    </div>
                    <h2 id="ShowModalLabel"><span id="show-title"></span></h2>
                    <div class="news-reader__meta">
                        <span><i class="fa-regular fa-calendar"></i> <span id="show-created-at"></span></span>
                        <span><i class="fa-regular fa-user"></i> <span id="show-author"></span></span>
                    </div>
                </div>
            </header>
            <div class="modal-body news-reader__body"><div id="show-content" class="news-reader__content"></div></div>
            <footer class="modal-footer news-reader__footer">
                <span><i class="fa-solid fa-mountain-sun"></i> Cuerpo de Socorro Andino de Chile</span>
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cerrar noticia</button>
            </footer>
        </article>
    </div>
</div>
