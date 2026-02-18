    <!-- Services Section -->
    <section id="servicios" class="services">
        <div class="reveal container">
            <div class="section-header">
                <h2 class="section-title text-dark">Sobre nosotros</h2>
                <hr style="border-top: 3px solid rgb(102, 204, 251); width: 20%; margin: 0 auto; margin-bottom: 1rem;">
                <p class="section-subtitle">El Cuerpo de Socorro Andino (CSA) es una organización voluntaria chilena,
                    pionera en Latinoamérica, dedicada de forma gratuita a la búsqueda y rescate en montañas y zonas de
                    difícil acceso.</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <h3>Misión</h3>
                    <p>Brindar de forma voluntaria y gratuita apoyo en la búsqueda, salvamento y rescate de personas
                        extraviadas o accidentadas en todo el país, especialmente en zonas montañosas o de difícil
                        acceso.</p>

                    <hr
                        style="border-top: 3px solid rgb(102, 204, 251); width: 20%; margin: 0 auto; margin-bottom: 1rem;">

                    <h3>Visión</h3>
                    <p>Ser el referente nacional de búsqueda, rescate, prevención y educación de actividades de montaña
                        en Chile.</p>

                    <hr
                        style="border-top: 3px solid rgb(102, 204, 251); width: 20%; margin: 0 auto; margin-bottom: 1rem;">

                    <button type="button" class="btn btn-outline-danger p-2" data-bs-toggle="modal" data-bs-target="#directivaModal">Directiva Nacional</button>
                </div>
                <div class="service-card">
                    <h3>Delegaciones</h3>
                    <p>Aquí puede visualizar si hay postulaciones abiertas.</p>
                    <div class="carousel slide" data-bs-interval="false" id="carouselExampleCaptions">
                        <div class="carousel-inner">
                            @foreach ($delegations as $delegation)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    <img src="storage/{{ $delegation->image }}" class="d-block w-100 rounded dark-img"
                                        alt="..." style="background-color: rgba(0,0,0,0.5);">
                                    <div class="carousel-caption d-block">
                                        <h5>Delegación {{ $delegation->name }}</h5>
                                        <button type="button"
                                            @if ($delegation->postulation_status == 'A') onclick="showPostulations({{ $delegation->id }})" @endif
                                            class="btn btn-postulations-load {{ $delegation->postulation_status == 'A' ? 'btn-outline-success' : 'btn-outline-danger' }}"> Postulación {{ $delegation->postulation_status == 'A' ? 'Abierta' : 'Cerrada' }}
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
