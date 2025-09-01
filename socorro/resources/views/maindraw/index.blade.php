<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cuerpo de Socorro Andino</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="icon" type="image/png" href="{{asset('assets/img/logo-socorro.png')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        /* Navbar layout helpers */
        @media (min-width: 992px) {
            #mainNav .container { 
                display: flex; 
                align-items: center; 
            }
            /* 30% brand, 70% collapsible area */
            #mainNav .navbar-brand { 
                flex: 0 0 30%; 
                max-width: 30%; 
            }
            /* Collapsible area takes 60% so that inside 50/50 = 30/30 overall */
            #mainNav #navbarNav { 
                flex: 0 0 70%; 
                max-width: 70%; 
                display: flex !important; 
                align-items: center; 
                gap: 1rem;
            }
            /* Inside collapse: 30% menu centered, 30% tools right */
            #mainNav .center-nav { 
                flex: 0 0 100%; 
                max-width: 100%; 
                display: flex; 
                justify-content: flex-end; 
                white-space: nowrap;
            }
            #mainNav .right-nav { 
                flex: 0 0 50%; 
                max-width: 50%; 
                display: flex; 
                justify-content: flex-end; 
            }
            /* Limit search width on desktop */
            #mainNav .right-nav input.form-control { 
                max-width: 200px; 
            }
        }
        @media (max-width: 991.98px) {
            /* On mobile/tablet allow the search to grow full width within its column */
            #mainNav .right-nav input.form-control {
                width: 100%;
            }
        }

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

    <nav class="navbar navbar-expand-lg navbar-dark fixed-top text-white" id="mainNav">
        <div class="container">
            <!-- Left: Brand -->
            <a class="navbar-brand d-flex align-items-center" href="#home">
                <img src="{{asset('assets/img/logo-socorro.png')}}" alt="Logo" class="logo-img me-2" style="width: 42px; height: 42px;">
                <span class="fw-semibold d-none d-md-inline">Cuerpo de Socorro Andino</span>
            </a>

            <!-- Toggler (mobile) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Collapse: contains center (menu) and right (tools) -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- Center: Menu truly centered on lg+ -->
                <ul class="navbar-nav center-nav gap-lg-2 text-center">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="#inicio"><i class="fa-solid fa-house"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="#noticias"><i class="fa-solid fa-newspaper"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="#servicios"><i class="fa-solid fa-users"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="#historia"><i class="fa-solid fa-clock"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="#galeria"><i class="fa-solid fa-images"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="#contacto"><i class="fa-solid fa-envelope"></i></a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i></a></li>
                </ul>

            </div>
        </div>
    </nav>

    <section id="inicio" class="hero">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="hero-background" style="background-image: url('{{asset('assets/img/recuehelo.jpg')}}');">
                        <div class="hero-overlay"></div>
                    </div>
                    <div class="hero-content">
                        <div class="social-links mb-2">
                            <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="hero-text">
                            <h1 class="hero-title ">Especialistas en Rescate de Montaña</h1>
                            <p class="hero-subtitle">Institucion sin fines de lucro</p>
                            <div class="hero-buttons">
                                <a href="#" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#avisoModal">Aviso de Salida</a>
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
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                    <div class="hero-background" style="background-image: url('{{asset('assets/img/header2.png')}}');">
                        <div class="hero-overlay"></div>
                    </div>
                    <div class="hero-content">
                        <h1 class="hero-title">Has tu aviso de salida</h1>
                        <p class="hero-subtitle">Es información relevante para tu seguridad.</p>
                        <div class="hero-buttons">
                            <a href="#" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#avisoModal">Aviso de Salida</a>
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
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </section>

    @include('maindraw.news')

    @include('maindraw.service')

    @include('maindraw.history')

    @include('maindraw.gallery')


    {{-- @include('maindraw.delegation')

    @include('maindraw.team')--}}

    @include('maindraw.contact')

    @include('partials.footer')

    @include('maindraw.form')

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const myCarousel = document.getElementById('heroCarousel');

            // Configuración básica del carrusel
            const carousel = new bootstrap.Carousel(myCarousel, {
                interval: 10000, // 5 segundos
                wrap: true,
                touch: true,
                keyboard: true,
                pause: false
            });

            // Configurar la transición suave
            const carouselInner = myCarousel.querySelector('.carousel-inner');
            carouselInner.style.transition = 'transform 1.5s ease-in-out';

            // Manejar el evento de transición completa
            myCarousel.addEventListener('slid.bs.carousel', function () {
                // No es necesario hacer nada aquí, solo para asegurar que el evento se maneje
            });

            // Iniciar manualmente el ciclo si es necesario
            let carouselInterval = setInterval(function() {
                carousel.next();
            }, 10000);

            // Limpiar el intervalo si el carrusel se detiene
            myCarousel.addEventListener('mouseenter', function() {
                clearInterval(carouselInterval);
            });

            myCarousel.addEventListener('mouseleave', function() {
                carouselInterval = setInterval(function() {
                    carousel.next();
                }, 10000);
            });
        });
    </script>
    <script>
        // Navbar transparent at top, solid on scroll
        document.addEventListener('DOMContentLoaded', function () {
            const nav = document.getElementById('mainNav');
            const collapseEl = document.getElementById('navbarNav');
            const onScroll = () => {
                const isMobile = window.innerWidth < 992;
                // Always dark on mobile
                if (isMobile) {
                    nav.classList.add('scrolled');
                    return;
                }
                // Desktop: always transparent, never add 'scrolled'
                nav.classList.remove('scrolled');
            };
            onScroll();
            window.addEventListener('scroll', onScroll, { passive: true });

            // Mobile: do NOT push content when menu opens (overlay behavior)
            const updateOffsets = () => {
                const isMobile = window.innerWidth < 992;
                if (!isMobile) {
                    document.body.style.paddingTop = '';
                    return;
                }
                // Always keep content flush; navbar stays dark and overlays
                document.body.style.paddingTop = '0px';
                nav.classList.add('scrolled');
            };
            updateOffsets();
            window.addEventListener('resize', updateOffsets);

            if (collapseEl) {
                collapseEl.addEventListener('shown.bs.collapse', () => {
                    updateOffsets();
                });
                collapseEl.addEventListener('hidden.bs.collapse', () => {
                    updateOffsets();
                });
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('#contact-form').submit(function(e){
            e.preventDefault();

            $('.btn-contact-load')
                .html('  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Espere...')
                .prop('disabled', true);

            $.ajax({
                url: '{{ route("contact") }}',
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response){
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message
                    });
                    $('#contact-form')[0].reset();
                    $('.btn-contact-load').html('Enviar Mensaje').prop('disabled', false);
                },
                error: function(xhr){
                    let msg = xhr.responseJSON?.message || 'Error inesperado al enviar el correo';
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: msg
                    });
                    $('.btn-contact-load').html('Enviar Mensaje').prop('disabled', false);
                }
            });
        });


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
