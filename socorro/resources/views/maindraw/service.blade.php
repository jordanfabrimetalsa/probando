<!-- Services Section -->
<section id="servicios" class="services">
    <div class="reveal container">
        <div class="section-header">
            <h2 class="section-title text-dark">Sobre nosotros</h2>
            <hr style="border-top: 3px solid rgb(102, 204, 251); width: 20%; margin: 0 auto; margin-bottom: 1rem;">
            <p class="section-subtitle">Una institución voluntaria chilena, pionera en Latinoamérica, dedicada gratuitamente a la búsqueda y rescate en montaña.</p>
        </div>

        <div class="services-grid">
            <div class="service-card about-institution-card">
                <div class="about-card-heading">
                    <span class="about-kicker">Socorro Andino de Chile</span>
                    <h3>Rescate en montaña desde 1949</h3>
                    <p>Somos una institución voluntaria y sin fines de lucro. Trabajamos para que quienes recorren la montaña puedan volver a casa.</p>
                </div>
                <div class="about-values">
                    <article class="about-value">
                        <span class="about-value-number">01</span>
                        <div><h4>Nuestra misión</h4><p>Buscar, asistir y rescatar gratuitamente a personas extraviadas o accidentadas a lo largo de Chile.</p></div>
                    </article>
                    <article class="about-value">
                        <span class="about-value-number">02</span>
                        <div><h4>Nuestra mirada</h4><p>Fortalecer la prevención, la educación y la preparación para las actividades de montaña.</p></div>
                    </article>
                </div>
                <div class="about-card-footer">
                    <p>Una organización construida por voluntarios y presente en distintas regiones del país.</p>
                    <button type="button" class="about-board-link" data-bs-toggle="modal" data-bs-target="#directivaModal">Ver directiva <i class="fa-solid fa-arrow-right" aria-hidden="true"></i></button>
                </div>
            </div>

            <div class="service-card delegation-showcase-card">
                <div class="delegation-card-heading">
                    <div><span>Equipos regionales</span><h3>Nuestras delegaciones</h3></div>
                    <span class="delegation-total">{{ $delegations->count() }} sedes</span>
                </div>
                <p>Conoce el trabajo local y revisa los procesos de postulación disponibles.</p>
                <div class="carousel slide" data-bs-interval="false" id="carouselExampleCaptions">
                    <div class="carousel-inner">
                        @foreach ($delegations as $delegation)
                            <div class="carousel-item @if ($loop->first) active @endif">
                                <img src="{{ asset('storage/'.$delegation->image) }}" class="d-block w-100 dark-img" alt="Delegación {{ $delegation->name }}">
                                <div class="carousel-caption d-block">
                                    <h5>Delegación {{ $delegation->name }}</h5>
                                    <button type="button"
                                        @if ($delegation->postulation_status == 'A') onclick="showPostulations({{ $delegation->id }}, this)" @endif
                                        class="btn btn-postulations-load {{ $delegation->postulation_status == 'A' ? 'btn-outline-success' : 'btn-outline-danger' }}">
                                        Postulación {{ $delegation->postulation_status == 'A' ? 'Abierta' : 'Cerrada' }}
                                    </button>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span><span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
