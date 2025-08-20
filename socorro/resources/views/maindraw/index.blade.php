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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .floating-buttons {
            position: fixed;
            top: 50%;
            right: 20px;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            z-index: 1050;
        }

        .floating-buttons .btn {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        }

        .pulse {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.1);
            }
            100% {
                transform: scale(1);
            }
        }
    </style>
</head>
<body>
    <div class="floating-buttons reveal">
        <button class="btn btn-dark rounded-circle mb-2 pulse">
          <i class="fas fa-phone"></i>
        </button>
        <button class="btn btn-dark rounded-circle mb-2 pulse"  data-bs-toggle="modal" data-bs-target="#avisoModal">
            <i class="fa-brands fa-wpforms"></i>
        </button>
        <button class="btn btn-dark rounded-circle pulse">
            <i class="fa-brands fa-whatsapp"></i>
        </button>
    </div>

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
                        <li class="nav-item"><a class="nav-link" href="#galeria">Galería</a></li>
                    </li>
                    <li class="nav-item">
                        <li class="nav-item"><a class="nav-link" href="#equipo">Directiva</a></li>
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
                </div>
            </div>
            <div class="hero-stats">
                <div class="stat">
                    <span class="stat-count stat-number" data-target="3600">0</span>
                    <span class="stat-label">Rescates Exitosos</span>
                </div>
                <div class="stat">
                    <span class="stat-number">24/7</span>
                    <span class="stat-label">Disponibilidad</span>
                </div>
                <div class="stat">
                    <span class="stat-count stat-number" data-target="72">0</span>
                    <span class="stat-label">Años de Experiencia</span>
                </div>
                <div class="stat">
                    <span class="stat-number">0$</span>
                    <span class="stat-label">Cobro por rescate</span>
                </div>
                <div class="stat">
                    <span class="stat-count stat-number" data-target="8">0</span>
                    <span class="stat-label">Delegaciones Activas</span>
                </div>
            </div>
        </div>
    </section>

    @include('maindraw.news')

    @include('maindraw.service')

    @include('maindraw.history')

    @include('maindraw.gallery')


    {{-- @include('maindraw.delegation') 

    @include('maindraw.team')--}}

    @include('maindraw.contact')


    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row justify-content-start">
                        <div class="col-md-12">
                            <h4 style="color: #EA4E1A;">Sponsor</h4>
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

    @include('maindraw.form')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        @if(session('success'))
            <script>
            Swal.fire({ icon: 'success', title: 'Éxito', text: '{{ session('success') }}' });
            </script>
        @endif

        @if(session('error'))
            <script>
            Swal.fire({ icon: 'error', title: 'Error', text: '{{ session('error') }}' });
            </script>
        @endif

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

    <script>
        document.addEventListener("scroll", function() {
            const reveals = document.querySelectorAll(".reveal");
            reveals.forEach((el) => {
                const windowHeight = window.innerHeight;
                const elementTop = el.getBoundingClientRect().top;
                const elementVisible = 100; // px antes de que aparezca

                if (elementTop < windowHeight - elementVisible) {
                el.classList.add("active");
                }
            });
        });
    </script>

    <script>
        function animateCounter(el) {
        const target = +el.getAttribute("data-target");
        let count = 0;
        const increment = target / 200; // velocidad (más grande = más rápido)

        function updateCounter() {
            count += increment;
            if (count < target) {
            el.innerText = Math.floor(count);
            requestAnimationFrame(updateCounter);
            } else {
            el.innerText = target; // añade el "+" al final
            }
        }

        updateCounter();
        }

        // Animar solo cuando aparece en pantalla
        document.addEventListener("scroll", () => {
        const counters = document.querySelectorAll(".stat-count");
        counters.forEach(counter => {
            const rect = counter.getBoundingClientRect();
            if (rect.top < window.innerHeight && !counter.started) {
            counter.started = true;
            animateCounter(counter);
            }
        });
        });
  </script>



</body>
</html>
