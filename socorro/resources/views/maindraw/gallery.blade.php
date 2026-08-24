<!-- Gallery Section -->
<section id="galeria" class="gallery">
    <div class="reveal container">
        <div class="section-header">
            <h2 class="section-title text-dark">Operaciones de Rescate</h2>
            <hr style="border-top: 3px solid rgb(102, 204, 251); width: 20%; margin: 0 auto; margin-bottom: 1rem;">
            <p class="section-subtitle text-dark">Imágenes de nuestras operaciones en terreno</p>
        </div>
        <div class="album-toolbar">
            <div><i class="fa-regular fa-images"></i><span>Álbum institucional</span></div>
            <span class="album-count">4 fotografías</span>
        </div>
        <div class="gallery-grid">
            <button type="button" class="gallery-item gallery-item--featured" data-bs-toggle="modal"
                data-bs-target="#galleryModal" data-image="{{ asset('assets/img/foto1.jpg') }}"
                data-title="Rescate Aerotransportado" data-description="Evacuación en Cordillera de los Andes">
                <img src="{{asset('assets/img/foto1.jpg')}}" alt="Rescate en helicóptero">
                <span class="gallery-number">01</span>
                <div class="gallery-overlay">
                    <i class="fa-solid fa-helicopter"></i>
                    <h4>Rescate Aerotransportado</h4>
                    <p>Evacuación en Cordillera de los Andes</p>
                </div>
            </button>
            <button type="button" class="gallery-item" data-bs-toggle="modal" data-bs-target="#galleryModal"
                data-image="{{ asset('assets/img/foto2.jpg') }}" data-title="Rescate Técnico"
                data-description="Operación en pared vertical">
                <img src="{{asset('assets/img/foto2.jpg')}}" alt="Rescate técnico">
                <span class="gallery-number">02</span>
                <div class="gallery-overlay">
                    <i class="fa-solid fa-mountain"></i>
                    <h4>Rescate Técnico</h4>
                    <p>Operación en pared vertical</p>
                </div>
            </button>
            <button type="button" class="gallery-item" data-bs-toggle="modal" data-bs-target="#galleryModal"
                data-image="{{ asset('assets/img/foto4.jpg') }}" data-title="Operación Nocturna"
                data-description="Rescate en condiciones extremas">
                <img src="{{asset('assets/img/foto4.jpg')}}" alt="Rescate nocturno">
                <span class="gallery-number">03</span>
                <div class="gallery-overlay">
                    <i class="fa-solid fa-moon"></i>
                    <h4>Operación Nocturna</h4>
                    <p>Rescate en condiciones extremas</p>
                </div>
            </button>
            <button type="button" class="gallery-item" data-bs-toggle="modal" data-bs-target="#galleryModal"
                data-image="{{ asset('assets/img/foto6.jpg') }}" data-title="Base de Operaciones"
                data-description="Centro de comando y control">
                <img src="{{asset('assets/img/foto6.jpg')}}" alt="Base de operaciones">
                <span class="gallery-number">04</span>
                <div class="gallery-overlay">
                    <i class="fa-solid fa-home"></i>
                    <h4>Base de Operaciones</h4>
                    <p>Centro de comando y control</p>
                </div>
            </button>
        </div>
    </div>
</section>

<div class="modal fade gallery-album-modal" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content modal-extra-background">
            <div class="modal-header">
                <div>
                    <span class="gallery-modal-kicker">Álbum de operaciones</span>
                    <h5 class="modal-title" id="galleryModalTitle"></h5>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>
            <div class="modal-body p-0">
                <img id="galleryModalImage" src="" alt="" class="gallery-modal-image">
                <p id="galleryModalDescription" class="gallery-modal-description"></p>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        document.querySelectorAll('.gallery-item[data-image]').forEach(function (item) {
            item.addEventListener('click', function () {
                const image = document.getElementById('galleryModalImage');
                const title = document.getElementById('galleryModalTitle');
                const description = document.getElementById('galleryModalDescription');
                image.src = item.dataset.image;
                image.alt = item.dataset.title;
                title.textContent = item.dataset.title;
                description.textContent = item.dataset.description;
            });
        });
    });
</script>
