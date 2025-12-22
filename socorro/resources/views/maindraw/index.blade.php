<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Cuerpo de Socorro Andino</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-socorro.png') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        crossorigin="anonymous" />
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
    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <div class="contact-info">
                    <a href="tel:136" class="emergency-link">
                        <i class="fas fa-phone-alt"></i> EMERGENCIAS: 136
                    </a>
                    <span class="divider">|</span>
                    <a href="tel:112" class="emergency-link">
                        Recuerda registrar tú salida.
                    </a>
                </div>
                <div class="social-links">
                    <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-youtube"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white" id="mainNav">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img src="{{ asset('assets/img/logo-socorro.png') }}" alt="Logo" class="logo-img"
                    style="height: 60px;">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#inicio">INICIO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#noticias">NOTICIAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#servicios">SERVICIOS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#historia">HISTORIA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#galeria">GALERÍA</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#contacto">CONTACTO</a>
                    </li>
                    @auth
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i> {{ Auth::user()->name }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="{{ route('dashboard') }}">Mi Cuenta</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">
                                            <i class="fas fa-sign-out-alt me-2"></i> Cerrar Sesión
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item border border-dark rounded">
                            <a class="nav-link" href="{{ route('login') }}">INICIAR SESIÓN</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <section id="inicio" class="hero">
        <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="hero-background"
                        style="background-image: url('{{ asset('assets/img/recuehelo.jpg') }}');">
                        <div class="hero-overlay"></div>
                    </div>
                    <div class="hero-content">
                        <div class="social-links mb-2">
                            <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        </div>
                        <div class="hero-text">
                            <h1 class="hero-title">Especialistas en Rescate <span style="color:#65bce4;">de
                                    Montaña</span></h1>
                            <p class="hero-subtitle">Institucion sin fines de lucro</p>
                            <div class="hero-buttons">
                                <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
                                    data-bs-target="#avisoModal">Aviso de Salida</button>
                                <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
                                    data-bs-target="#departureModal">Detalle Salida</button>
                                <!--<button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#donationModal" disabled>Donación</button>-->
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
                    <div class="hero-background"
                        style="background-image: url('{{ asset('assets/img/header2.png') }}');">
                        <div class="hero-overlay"></div>
                    </div>
                    <div class="hero-content">
                        <div class="social-links mb-2">
                            <a href="#" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                            <a href="#" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                            <a href="#" class="text-white"><i class="fab fa-instagram"></i></a>
                        </div>
                        <h1 class="hero-title">Has tu aviso <span style="color:#65bce4;"> de salida</span></h1>
                        <p class="hero-subtitle">Es información relevante para tu seguridad.</p>
                        <div class="hero-buttons">
                            <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
                                data-bs-target="#avisoModal">Aviso de Salida</button>
                            <button type="button" class="btn btn-outline-light" data-bs-toggle="modal"
                                data-bs-target="#departureModal">Detalle Salida</button>
                            <!--<button type="button" class="btn btn-outline-light" data-bs-toggle="modal" data-bs-target="#donationModal" disabled>Donación</button>-->
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
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Anterior</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Siguiente</span>
            </button>
        </div>
    </section>

    <!-- Bottom-centered emergency toast -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
        <div id="emergencyToast" class="toast align-items-center text-bg-dark border-0" role="alert"
            aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
            <div class="d-flex align-items-center">
                <div class="toast-body">
                    Si tienes una emergencia
                    <a href="tel:" class="btn btn-danger btn-sm my-auto ms-2">Llamar ahora </a>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                    aria-label="Close"></button>
            </div>
        </div>
    </div>


    @include('maindraw.news')

    @include('maindraw.service')

    @include('maindraw.history')

    @include('maindraw.gallery')

    @include('maindraw.donation')

    @include('maindraw.departure')

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
            myCarousel.addEventListener('slid.bs.carousel', function() {
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
        document.addEventListener('DOMContentLoaded', function() {
            const nav = document.getElementById('mainNav');
            const collapseEl = document.getElementById('navbarNav');
            const togglerBtn = document.querySelector('#mainNav .navbar-toggler');
            let backdropEl = null;

            const ensureBackdrop = () => {
                if (backdropEl) return backdropEl;
                backdropEl = document.createElement('div');
                backdropEl.className = 'mainnav-backdrop';
                backdropEl.addEventListener('click', () => {
                    requestCloseCollapse();
                });
                return backdropEl;
            };

            const openMobileMenu = () => {
                if (window.innerWidth >= 992) return;
                document.body.style.overflow = 'hidden';
                document.body.appendChild(ensureBackdrop());
            };

            const closeMobileMenu = () => {
                document.body.style.overflow = '';
                if (backdropEl && backdropEl.parentNode) backdropEl.parentNode.removeChild(backdropEl);
                backdropEl = null;
            };

            const requestCloseCollapse = () => {
                if (!collapseEl) return;
                if (!window.bootstrap || !window.bootstrap.Collapse) return;
                const instance = window.bootstrap.Collapse.getOrCreateInstance(collapseEl, {
                    toggle: false
                });
                instance.hide();
            };

            if (togglerBtn) {
                togglerBtn.addEventListener('click', (e) => {
                    if (window.innerWidth >= 992) return;
                    if (!collapseEl || !collapseEl.classList.contains('show')) return;
                    e.preventDefault();
                    e.stopPropagation();
                    requestCloseCollapse();
                });
            }

            const onScroll = () => {
                const isMobile = window.innerWidth < 992;
                // Mobile: always dark
                if (isMobile) {
                    nav.classList.add('scrolled');
                } else {
                    // Desktop: dark only after scrolling down
                    if (window.scrollY > 10) {
                        nav.classList.add('scrolled');
                    } else {
                        nav.classList.remove('scrolled');
                    }
                }
            };
            onScroll();
            window.addEventListener('scroll', onScroll, {
                passive: true
            });

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

            // Show emergency toast on load
            const toastEl = document.getElementById('emergencyToast');
            if (toastEl && window.bootstrap && window.bootstrap.Toast) {
                const toast = new bootstrap.Toast(toastEl, {
                    autohide: false
                });
                toast.show();
            } else if (toastEl) {
                // Fallback: show via class if Bootstrap JS not available
                toastEl.classList.add('show');
            }

            // Prevent body scroll when navbar is shown on mobile
            if (collapseEl) {
                collapseEl.addEventListener('show.bs.collapse', function() {
                    openMobileMenu();
                });
                collapseEl.addEventListener('hidden.bs.collapse', () => {
                    closeMobileMenu();
                    updateOffsets();
                });

                collapseEl.querySelectorAll('a.nav-link').forEach((link) => {
                    link.addEventListener('click', () => {
                        if (window.innerWidth >= 992) return;
                        requestCloseCollapse();
                    });
                });
            }

            document.addEventListener('keydown', (e) => {
                if (e.key !== 'Escape') return;
                if (!collapseEl || !collapseEl.classList.contains('show')) return;
                requestCloseCollapse();
            });

            window.addEventListener('resize', () => {
                if (window.innerWidth >= 992) {
                    requestCloseCollapse();
                    closeMobileMenu();
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('#form_departure').submit(function(e) {
            console.log('entra 1');
            e.preventDefault();

            $('.btn-save-load')
                .html(
                    '  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Espere...'
                )
                .prop('disabled', true);

            var formdata = new FormData(this);

            $.ajax({
                url: '{{ route('departure.create') }}',
                type: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
                header: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    console.log('entra 2')
                    Swal.fire({
                        icon: response.success ? 'success' : 'error',
                        title: response.success ? 'Éxito' : 'Error',
                        text: response.message
                    });
                    $('#form_departure')[0].reset();
                    $('.btn-save-load').html('Guardar').prop('disabled', false);
                    $('#avisoModal').modal('hide');
                },
                error: function(error) {
                    console.log(error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.responseJSON?.error
                    });
                    $('.btn-save-load').html('Guardar').prop('disabled', false);
                }
            })
        });
    </script>

    <script>
        $('#contact-form').submit(function(e) {
            e.preventDefault();

            $('.btn-contact-load')
                .html(
                    '  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Espere...'
                )
                .prop('disabled', true);

            $.ajax({
                url: '{{ route('contact') }}',
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message
                    });
                    $('#contact-form')[0].reset();
                    $('.btn-contact-load').html('Enviar Mensaje').prop('disabled', false);
                },
                error: function(xhr) {
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

        $('#form_departure_search').submit(function(e) {
            e.preventDefault();

            $('.btn-search-load')
                .html(
                    '  <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span> Espere...'
                )
                .prop('disabled', true);

            $.ajax({
                url: '{{ route('departure.search') }}',
                type: 'POST',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    var data = response.data;

                    if (data.length === 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ups',
                            text: 'No se ha encontrado a nadie con este rut.'
                        });
                        $('#datatableUser tbody').html('');
                        $('.btn-search-load').html('Buscar').prop('disabled', false);
                        return;
                    }

                    for (const item of data) {

                        if (item.active == true) {
                            var active =
                                `<button class="btn btn-dark" onclick="finishDeparture(${item.id})">Terminar</button>`;
                        } else {
                            var active = `<span class="badge bg-success">Finalizado</span>`;
                        }

                        $('#datatableUser tbody').append(
                            `<tr>
                                <td>${item.name}</td>
                                <td>${item.route}</td>
                                <td>${item.departure_date}</td>
                                <td>${item.return_date}</td>
                                <td>${active}</td>
                            </tr>`
                        );
                    }
                    $('.btn-search-load').html('Buscar').prop('disabled', false);
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ups',
                        text: 'Error al buscar salida'
                    });
                    $('#datatableUser tbody').html('');
                    $('.btn-search-load').html('Buscar').prop('disabled', false);
                }
            })
        })

        function finishDeparture(id) {
            Swal.fire({
                icon: 'warning',
                title: '¿Estás seguro?',
                text: '¿Deseas terminar esta salida?',
                showCancelButton: true,
                confirmButtonText: 'Sí, terminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route('departure.finish') }}',
                        type: 'POST',
                        data: {
                            id: id,
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito',
                                text: response.message
                            });
                            $('#datatableUser tbody').html('');
                            $('#form_departure_search')[0].reset();
                            $('.btn-search-load').html('Buscar').prop('disabled', false);
                        },
                        error: function(xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error',
                                text: 'Error al terminar la salida'
                            });
                        }
                    })
                }
            })
        }

        @if (session('success'))
            <
            script >
                Swal.fire({
                    icon: 'success',
                    title: 'Éxito',
                    text: '{{ session('success') }}'
                });
    </script>
    @endif

    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}'
            });
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
    document.querySelectorAll(".history-hidden").forEach(item => item.style.display = item.style.display === "block"
    ? "none" : "block");
    toggleBtn.textContent = document.querySelector(".history-hidden").style.display === "block" ? "Ver menos" :
    "Saber más";
    reorderYears(); // recalcula alternancia
    });
    </script>

    <script src="{{ asset('assets/js/script.js') }}"></script>

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

    <!-- Incluir el modal de salidas -->
    @include('maindraw.departure')

    <script>
        // Inicializar tooltips
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    </script>

    @stack('scripts')
</body>

</html>
