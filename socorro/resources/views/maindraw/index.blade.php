<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuerpo de Socorro Andino</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/img/logo-socorro.png')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark text-white" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <img src="{{asset('assets/img/logo-socorro.png')}}" alt="Logo" class="logo-img" style="width: 50px; height: 50px;">
                <span class="ms-2"></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#inicio">Inicio</a></li>
                    </li>
                    <li class="nav-item">
                        <li class="nav-item"><a class="nav-link" href="#noticias">Noticias</a></li>
                    </li>
                    <li class="nav-item">
                        <li class="nav-item"><a class="nav-link" href="#servicios">Nosotros</a></li>
                    </li>
                    <li class="nav-item">
                        <li class="nav-item"><a class="nav-link" href="#historia">Historia</a></li>
                    </li>
                    <li class="nav-item">
                        <li class="nav-item"><a class="nav-link" href="#equipo">Equipo</a></li>
                    </li>
                    <li class="nav-item">
                        <li class="nav-item"><a class="nav-link" href="#galeria">Galería</a></li>
                    </li>
                    <li class="nav-item">
                        <li class="nav-item"><a class="nav-link" href="#contacto">Contacto</a></li>
                    </li>
                    <li class="nav-item">
                        <li class="nav-item"><a class="nav-link btn btn-danger" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i></a></li>
                    </li>
                </ul>
            </div>
        </div>
    </nav>


    <!-- Hero Section -->
    <section id="inicio" class="hero">
        <div class="hero-background">
            <div class="hero-overlay"></div>
        </div>
        <div class="hero-content">
            <div class="social-links mb-2">
                <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
            </div>
            <div class="hero-text">
                <h1 class="hero-title">Especialistas en Rescate de Montaña</h1>
                <p class="hero-subtitle">Institucion sin fines de lucro</p>
                <div class="hero-buttons">
                    <a href="tel:136" class="btn btn-danger"> <i class="fa-solid fa-phone"></i> Llamar Emergencia</a>
                    <a href="tel:136" class="btn btn-primary"> <i class="fa-solid fa-exclamation"></i> Aviso de Salida</a>
                </div>
            </div>
            <div class="hero-stats">
                <div class="stat">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Rescates Exitosos</span>
                </div>
                <div class="stat">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Disponibilidad</span>
                </div>
                <div class="stat">
                    <span class="stat-number">60</span>
                    <span class="stat-label">Años de Experiencia</span>
                </div>
                <div class="stat">
                    <span class="stat-number">0$</span>
                    <span class="stat-label">Cobro por rescate</span>
                </div>
                <div class="stat">
                    <span class="stat-number">8</span>
                    <span class="stat-label">Delegaciones</span>
                </div>
            </div>
        </div>

    </section>

    @include('maindraw.news')

    @include('maindraw.service')

    @include('maindraw.history')

    @include('maindraw.gallery')


    <section class="delegaciones-carousel py-5">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-dark">Delegaciones</h2>
                <p class="section-subtitle">Mantente informado sobre nuestras operaciones y novedades del rescate de montaña</p>
            </div>
          <div id="delegacionesCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
              <!-- Cada slide contendrá 3 items -->
              <div class="carousel-item active">
                <div class="row">
                  <div class="col-md-4">
                    <div class="card card-delegacion" style=" border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                      <img src="{{asset('assets/img/metropolitana.png')}}" class="card-img-top" alt="Delegación 1">
                      <div class="card-body">
                        <h5 class="card-title">Delegación Metropolitana</h5>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card card-delegacion" style=" border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                        <img src="{{asset('assets/img/antofagasta.png')}}" class="card-img-top" alt="Delegación 2">
                      <div class="card-body">
                        <h5 class="card-title">Delegación Antofagasta</h5>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card card-delegacion" style=" border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                      <img src="{{asset('assets/img/magallanes.png')}}" class="card-img-top" alt="Delegación 3">
                      <div class="card-body">
                        <h5 class="card-title">Delegación Magallanes</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="carousel-item">
                <div class="row">
                  <div class="col-md-4">
                    <div class="card card-delegacion" style=" border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                      <img src="{{asset('assets/img/coquimbo.png')}}" class="card-img-top" alt="Delegación 2">
                      <div class="card-body">
                        <h5 class="card-title">Delegación Coquimbo</h5>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card card-delegacion" style=" border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                      <img src="{{asset('assets/img/ohiggins.png')}}" class="card-img-top" alt="Delegación 3">
                      <div class="card-body">
                        <h5 class="card-title">Delegación O Higgins</h5>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card card-delegacion" style=" border: none; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                      <img src="{{asset('assets/img/losrios.png')}}" class="card-img-top" alt="Delegación 4">
                      <div class="card-body">
                        <h5 class="card-title">Delegación Los Ríos</h5>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
            <div class="carousel-buttons">
            <button class="carousel-control-prev" type="button" data-bs-target="#delegacionesCarousel" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#delegacionesCarousel" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
          </div>
        </div>
      </section>


    @include('maindraw.team')

    @include('maindraw.contact')


    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-start">
                        <div class="col-md-12">
                            <h4 class="text-danger">Sponsor</h4>
                            <div class="sponsors-grid d-flex align-items-center">
                                <div class="sponsor-item me-2">
                                    <img src="{{asset('assets/img/gremm.png')}}" alt="Sponsor 1" class="sponsor-logo rounded-circle border border-danger" style="width: 50px; height: 50px;">
                                </div>
                                <div class="sponsor-item ms-2 me-2">
                                    <img src="{{asset('assets/img/estilo.png')}}" alt="Sponsor 2" class="sponsor-logo rounded-circle border border-danger" style="width: 50px; height: 50px;">
                                </div>
                                <div class="sponsor-item ms-2">
                                    <img src="{{asset('assets/img/andinismo.png')}}" alt="Sponsor 3" class="sponsor-logo rounded-circle border border-danger" style="width: 50px; height: 50px;">
                                </div>
                                <div class="sponsor-item ms-2">
                                    <img src="{{asset('assets/img/museo.png')}}" alt="Sponsor 3" class="sponsor-logo rounded-circle border border-danger" style="width: 50px; height: 50px;">
                                </div>
                                <div class="sponsor-item ms-2">
                                    <img src="{{asset('assets/img/fundacion.png')}}" alt="Sponsor 3" class="sponsor-logo rounded-circle border border-danger" style="width: 50px; height: 50px;">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <p>&copy; 2024 Cuerpo de Socorro Andino - Chile. Todos los derechos reservados.</p>
                        </div>
                        <div class="col-md-6 text-md-end">
                            <div class="social-links">
                                <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                                <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                                <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Animación al hacer scroll
        const observer = new IntersectionObserver(entries => {
          entries.forEach(entry => {
            if (entry.isIntersecting) entry.target.classList.add("show");
          });
        }, { threshold: 0.2 });

        document.querySelectorAll(".history-year").forEach(y => observer.observe(y));

        // Función para alternar left/right
        function reorderYears() {
          const allYears = document.querySelectorAll(".history-year");
          let lastSide = "right";
          allYears.forEach(item => {
            item.classList.remove("left","right");
            if(lastSide === "right") { item.classList.add("left"); lastSide="left"; }
            else { item.classList.add("right"); lastSide="right"; }
          });
        }

        // Inicializar alternancia
        reorderYears();

        // Toggle Saber más
        const toggleBtn = document.getElementById("toggleHistory");
        toggleBtn.addEventListener("click", () => {
          document.querySelectorAll(".history-hidden").forEach(item => item.style.display = item.style.display === "block" ? "none" : "block");
          toggleBtn.textContent = document.querySelector(".history-hidden").style.display === "block" ? "Ver menos" : "Saber más";
          reorderYears(); // recalcula alternancia
        });
        </script>
    <script src="{{asset('assets/js/script.js')}}"></script>
</body>
</html>
