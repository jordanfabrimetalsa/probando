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
    <link href="https://cdn.datatables.net/1.13.8/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        @media (min-width: 992px) {
            #mainNav .container {
                display: flex;
                align-items: center;
            }

            #mainNav .navbar-brand {
                flex: 0 0 30%;
                max-width: 30%;
            }

            #mainNav #navbarNav {
                flex: 0 0 70%;
                max-width: 70%;
                display: flex !important;
                align-items: center;
                gap: 1rem;
            }

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

            #mainNav .right-nav input.form-control {
                max-width: 200px;
            }
        }

        @media (max-width: 991.98px) {

            #mainNav .right-nav input.form-control {
                width: 100%;
            }
        }

        .floating-buttons {
            position: fixed;
            right: 0;
            top: 40%;
            display: flex;
            flex-direction: column;
            z-index: 1050;
            align-items: flex-end;
        }

        .floating-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: #333;
            color: white;
            text-decoration: none;
            overflow: hidden;
            transition: width 0.3s ease;
            padding: 0;
            border: 0;
        }

        .border-floating {
            border-radius: 5px 0 0 0;
        }

        .border-floating-1 {
            border-radius: 0 0 0 5px;
        }


        .floating-btn,
        .floating-icon {
            width: 50px;
            text-align: center;
            font-size: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: opacity 0.15s ease, width 0.15s ease;
        }

        .floating-btn .floating-text {
            white-space: nowrap;
            opacity: 0;
            transition: opacity 0.2s ease;
            width: 0;
            padding: 0;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        /* Hover effect */
        .floating-btn:hover {
            width: 180px;
            color: white;
            border-radius: 5px 0 0 5px;
        }

        .floating-btn:hover .floating-icon {
            opacity: 0;
            width: 0;
        }

        .floating-btn:hover .floating-text {
            width: auto;
            padding: 0 15px;
            opacity: 1;
        }

        /* Colores opcionales */
        .btn-1 {
            background: #455A64;
        }

        .btn-2 {
            background: #1565C0;
        }

        .btn-3 {
            background: #EF6C00;
        }

        .btn-4 {
            background: #C62828;
        }

        .btn-5 {
            background: #006570;
        }
    </style>

    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#0b1220">
</head>

<body data-bs-theme="light">

    <div class="floating-buttons">
        <div class="btn-wrapper-1">
            <a href="#" class="floating-btn border-floating btn-1" data-bs-toggle="modal"
                data-bs-target="#avisoModal">
                <span class="floating-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M3 10c0-3.771 0-5.657 1.172-6.828S7.229 2 11 2h2c3.771 0 5.657 0 6.828 1.172S21 6.229 21 10v4c0 3.771 0 5.657-1.172 6.828S16.771 22 13 22h-2c-3.771 0-5.657 0-6.828-1.172S3 17.771 3 14z"
                            opacity="0.5" />
                        <path fill="currentColor"
                            d="M16.519 16.501c.175-.136.334-.295.651-.612l3.957-3.958c.096-.095.052-.26-.075-.305a4.3 4.3 0 0 1-1.644-1.034a4.3 4.3 0 0 1-1.034-1.644c-.045-.127-.21-.171-.305-.075L14.11 12.83c-.317.317-.476.476-.612.651q-.243.311-.412.666c-.095.2-.166.414-.308.84l-.184.55l-.292.875l-.273.82a.584.584 0 0 0 .738.738l.82-.273l.875-.292l.55-.184c.426-.142.64-.212.84-.308q.355-.17.666-.412m5.849-5.809a2.163 2.163 0 1 0-3.06-3.059l-.126.128a.52.52 0 0 0-.148.465c.02.107.055.265.12.452c.13.375.376.867.839 1.33s.955.709 1.33.839c.188.065.345.1.452.12a.53.53 0 0 0 .465-.148z" />
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M7.25 9A.75.75 0 0 1 8 8.25h6.5a.75.75 0 0 1 0 1.5H8A.75.75 0 0 1 7.25 9m0 4a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 0 1.5H8a.75.75 0 0 1-.75-.75m0 4a.75.75 0 0 1 .75-.75h1.5a.75.75 0 0 1 0 1.5H8a.75.75 0 0 1-.75-.75"
                            clip-rule="evenodd" />
                    </svg></span>
                <span class="floating-text">Aviso de salida</span>
            </a>
        </div>

        <div class="btn-wrapper">
            <a href="#" class="floating-btn btn-2" data-bs-toggle="modal" data-bs-target="#departureModal">
                <span class="floating-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M2 12c0-4.714 0-7.071 1.464-8.536C4.93 2 7.286 2 12 2s7.071 0 8.535 1.464C22 4.93 22 7.286 22 12s0 7.071-1.465 8.535C19.072 22 16.714 22 12 22s-7.071 0-8.536-1.465C2 19.072 2 16.714 2 12"
                            opacity="0.5" />
                        <path fill="currentColor"
                            d="M10.543 7.517a.75.75 0 1 0-1.086-1.034l-2.314 2.43l-.6-.63a.75.75 0 1 0-1.086 1.034l1.143 1.2a.75.75 0 0 0 1.086 0zM13 8.25a.75.75 0 0 0 0 1.5h5a.75.75 0 0 0 0-1.5zm-2.457 6.267a.75.75 0 1 0-1.086-1.034l-2.314 2.43l-.6-.63a.75.75 0 1 0-1.086 1.034l1.143 1.2a.75.75 0 0 0 1.086 0zM13 15.25a.75.75 0 0 0 0 1.5h5a.75.75 0 0 0 0-1.5z" />
                    </svg></span>
                <span class="floating-text">Detalle Salida</span>
            </a>
        </div>

        <div class="btn-wrapper-4">
            <a href="tel:136" class="floating-btn btn-4">
                <span class="floating-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="m14.556 15.548l-.455.48s-1.083 1.139-4.038-1.972s-1.872-4.25-1.872-4.25l.287-.303c.706-.744.773-1.938.156-2.81L7.374 4.91C6.61 3.83 5.135 3.688 4.26 4.609L2.691 6.26c-.433.457-.723 1.048-.688 1.705c.09 1.68.808 5.293 4.812 9.51c4.247 4.47 8.232 4.648 9.861 4.487c.516-.05.964-.329 1.325-.709l1.42-1.496c.96-1.01.69-2.74-.538-3.446l-1.91-1.1c-.806-.463-1.787-.327-2.417.336"
                            opacity="0.5" />
                        <path fill="currentColor"
                            d="M17 12a5 5 0 1 0-4.478-2.774a.82.82 0 0 1 .067.574l-.298 1.113a.65.65 0 0 0 .796.796l1.113-.298a.82.82 0 0 1 .574.067A5 5 0 0 0 17 12" />
                    </svg></span>
                <span class="floating-text">Llamar</span>
            </a>
        </div>

        <div class="btn-wrapper">
            <a href="{{ url('/login') }}" class="floating-btn btn-3">
                <span class="floating-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M16 2h-1c-2.829 0-4.242 0-5.121.879S9 5.172 9 8v8c0 2.829 0 4.243.879 5.122c.878.878 2.292.878 5.119.878H16c2.828 0 4.242 0 5.121-.879C22 20.243 22 18.828 22 16V8c0-2.828 0-4.243-.879-5.121S18.828 2 16 2"
                            opacity="0.5" />
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M1.251 11.999a.75.75 0 0 1 .75-.75h11.973l-1.961-1.68a.75.75 0 0 1 .976-1.14l3.5 3a.75.75 0 0 1 0 1.14l-3.5 3a.75.75 0 0 1-.976-1.14l1.96-1.68H2.002a.75.75 0 0 1-.75-.75"
                            clip-rule="evenodd" />
                    </svg></span>
                <span class="floating-text">Iniciar Sesión</span>
            </a>
        </div>

        <div class="btn-wrapper">
            <a href="#" id="btnInstall" style="display:none;" class="floating-btn border-floating btn-5">
                <span class="floating-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path fill="currentColor"
                            d="M6.5 18v-.09c0-.865 0-1.659.087-2.304c.095-.711.32-1.463.938-2.08c.618-.619 1.37-.844 2.08-.94c.646-.086 1.44-.086 2.306-.086h.178c.866 0 1.66 0 2.305.087c.711.095 1.463.32 2.08.938c.619.618.844 1.37.94 2.08c.085.637.086 1.416.086 2.267c2.573-.55 4.5-2.812 4.5-5.52c0-2.47-1.607-4.572-3.845-5.337C17.837 4.194 15.415 2 12.476 2C9.32 2 6.762 4.528 6.762 7.647c0 .69.125 1.35.354 1.962a4.4 4.4 0 0 0-.83-.08C3.919 9.53 2 11.426 2 13.765S3.919 18 6.286 18z"
                            opacity="0.5" />
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M12 22c-1.886 0-2.828 0-3.414-.586S8 19.886 8 18s0-2.828.586-3.414S10.114 14 12 14s2.828 0 3.414.586S16 16.114 16 18s0 2.828-.586 3.414S13.886 22 12 22m1.805-3.084l-1.334 1.333a.667.667 0 0 1-.942 0l-1.334-1.333a.667.667 0 1 1 .943-.943l.195.195v-1.946a.667.667 0 0 1 1.334 0v1.946l.195-.195a.667.667 0 0 1 .943.943"
                            clip-rule="evenodd" />
                    </svg></span>
                <span class="floating-text">Instalar</span>
            </a>
        </div>


        <div class="btn-wrapper-4">
            <a href="#" onclick="cambiarTema()" class="floating-btn border-floating-1 btn-4">
                <span class="floating-icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24">
                        <path fill="currentColor" d="M11.5 8a3.5 3.5 0 1 1-7 0a3.5 3.5 0 0 1 7 0" opacity="0.5" />
                        <path fill="currentColor" fill-rule="evenodd"
                            d="M7.5 1.25a.75.75 0 0 1 .75.75v.5a.75.75 0 0 1-1.5 0V2a.75.75 0 0 1 .75-.75M3.08 3.08a.75.75 0 0 1 1.062 0l.216.217a.75.75 0 0 1-1.061 1.06l-.216-.216a.75.75 0 0 1 0-1.06m8.839 0a.75.75 0 0 1 0 1.061l-.216.216a.75.75 0 1 1-1.06-1.06l.215-.216a.75.75 0 0 1 1.061 0M1.25 7.5A.75.75 0 0 1 2 6.75h.5a.75.75 0 0 1 0 1.5H2a.75.75 0 0 1-.75-.75m3.108 3.143a.75.75 0 0 1 0 1.06l-.216.216a.75.75 0 0 1-1.061-1.06l.216-.216a.75.75 0 0 1 1.06 0"
                            clip-rule="evenodd" opacity="0.5" />
                        <path fill="currentColor"
                            d="M16.286 22C19.442 22 22 19.472 22 16.353c0-2.472-1.607-4.573-3.845-5.338C17.837 8.194 15.415 6 12.476 6C9.32 6 6.762 8.528 6.762 11.647c0 .69.125 1.35.354 1.962a4.4 4.4 0 0 0-.83-.08C3.919 13.53 2 15.426 2 17.765S3.919 22 6.286 22z" />
                    </svg></span>
                <span class="floating-text">Modo oscuro</span>
            </a>
        </div>


    </div>


    <div class="top-bar">
        <div class="container">
            <div class="top-bar-content">
                <div class="contact-info">
                    <a href="tel:136" class="emergency-link">
                        <i class="fas fa-phone-alt"></i> EMERGENCIAS: 136
                    </a>
                    <span class="divider">|</span>
                    <a href="tel:112" class="emergency-link">
                        Registra tú salida.
                    </a>
                </div>
                <div class="social-links">
                    <a href="https://www.facebook.com/people/Cuerpo-de-Socorro-Andino-de-Chile/100063757382183/" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://www.instagram.com/socorroandinodechile/" class="social-icon"><i class="fab fa-instagram"></i></a>
                    <a href="https://x.com/socorroandinocl" class="social-icon"><i class="fab fa-twitter"></i></a>
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
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" style="background: rgb(97 97 97)">
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
                            <a href="https://www.facebook.com/people/Cuerpo-de-Socorro-Andino-de-Chile/100063757382183/" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                            <a href="https://x.com/socorroandinocl" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.instagram.com/socorroandinodechile/" class="text-white"><i class="fab fa-instagram"></i></a>
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
                            <a href="https://www.facebook.com/people/Cuerpo-de-Socorro-Andino-de-Chile/100063757382183/" class="text-white me-3"><i class="fab fa-facebook"></i></a>
                            <a href="https://x.com/socorroandinocl" class="text-white me-3"><i class="fab fa-twitter"></i></a>
                            <a href="https://www.instagram.com/socorroandinodechile/" class="text-white"><i class="fab fa-instagram"></i></a>
                        </div>
                        <h1 class="hero-title">Haz tu aviso <span style="color:#65bce4;"> de salida</span></h1>
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

    @include('maindraw.boss')

    @include('maindraw.postulations')

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
    <script src="https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.8/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/maindraw/maindraw.js') }}"></script>
    <script src="{{ asset('assets/js/maindraw/darkmode.js') }}"></script>
    <script src="{{ asset('assets/js/maindraw/progresive.js') }}"></script>

    <script>
        (function () {
            const newsSection = document.getElementById('noticias');
            if (!newsSection) return;

            const onClickPagination = async (e) => {
                const link = e.target.closest('#noticias .pagination a');
                if (!link) return;

                e.preventDefault();

                const url = link.getAttribute('href');
                if (!url) return;

                const container = document.getElementById('newsContainer');
                if (!container) return;

                try {
                    container.style.opacity = '0.6';
                    container.style.pointerEvents = 'none';

                    const response = await fetch(url, {
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    });

                    if (!response.ok) {
                        window.location.href = url;
                        return;
                    }

                    const html = await response.text();
                    const doc = new DOMParser().parseFromString(html, 'text/html');
                    const newContainer = doc.getElementById('newsContainer');
                    if (!newContainer) {
                        window.location.href = url;
                        return;
                    }

                    container.replaceWith(newContainer);
                    history.pushState({}, '', url);

                    const sectionTop = newsSection.getBoundingClientRect().top + window.pageYOffset;
                    window.scrollTo({ top: sectionTop - 20, behavior: 'smooth' });
                } catch (err) {
                    window.location.href = url;
                }
            };

            newsSection.addEventListener('click', onClickPagination);

            window.addEventListener('popstate', () => {
                window.location.reload();
            });
        })();
    </script>

    <script>
        function showPostulations(id) {
            $('.btn-postulations-load').html(
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><rect width="7.33" height="7.33" x="1" y="1" fill="currentColor"><animate id="SVGzjrPLenI" attributeName="x" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="1" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="1" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="1" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="1" y="15.66" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="15.66" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="15.66" fill="currentColor"><animate id="SVGXAURnSRI" attributeName="x" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/></rect></svg> Espere...'
                ).prop('disabled', true);

            $.ajax({
                url: '/postulations/data/' + id,
                type: 'GET',
                success: function(response) {
                    if (response.length > 0) {
                        $('#postulationsModal').modal('show');
                        $('.btn-postulations-load').html('Postulación Abierta').prop('disabled', false);

                        var postulation = response[response.length -
                            1]; // Tomar el ultimo registro de postulación
                        var html = `
                            <div class=""><strong>${postulation.title}</strong></div><br>
                            <div>
                            La postulación comienza el <span class="text-danger" style="font-weight: bold;">${
                                new Date(postulation.start_date).toLocaleDateString('es-CL')
                            }
                            </span> y termina el <span class="text-danger" style="font-weight: bold;">${
                                new Date(postulation.end_date).toLocaleDateString('es-CL')
                            }
                            </span>
                            </div><br>
                            <div class="">Con respecto a la postulación, favor leer la siguiente información: ${postulation.description}. Ante cualquier duda hacerla por el formulario de contacto. Evite usar el 136 número exclusivo para emergencias!.</div><br><hr>
                            <form id="form-postulation" type="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <textarea class="form-control" id="presentation" name="presentation" placeholder="Ingrese su presentacion" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="Ingrese su nombre" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Ingrese su apellido" required>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" id="rut" name="rut" placeholder="Ingrese su rut" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <input type="number" class="form-control" id="phone" name="phone" placeholder="Ingrese su telefono" required>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <input type="email" class="form-control" id="email" name="email" placeholder="Ingrese su correo" required>
                                        </div>
                                    </div>
                                    <input type="hidden" value="${postulation.id}" name="postulation_id" id="postulation_id">
                                    <div class="col-6">
                                        <div class="mb-3">
                                            <button type="button" onclick="submitFormulation()" class="btn btn-dark btn-postulations-send-load">Enviar</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        `;
                    } else {
                        var html = `
                            <div class="pt-2 pb-2"><strong class="text-warning">No hay postulaciones disponibles para esta delegación</strong></div>
                        `;
                    }
                    $('#postulations-reflect').html(html);
                },
                error: function(error) {
                    console.log(error);
                    $('.btn-postulations-load').html('Postulación Cerrada').prop('disabled', true);
                    $('#postulations-reflect').html(
                        '<div class="text-danger">Error al cargar postulaciones</div>' + error + error
                        .responseJSON.message);
                }
            })
        }

        function submitFormulation() {
            $('.btn-postulations-send-load').html(
                '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><rect width="7.33" height="7.33" x="1" y="1" fill="currentColor"><animate id="SVGzjrPLenI" attributeName="x" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="1" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="1" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="1" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="1" y="15.66" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="15.66" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="15.66" fill="currentColor"><animate id="SVGXAURnSRI" attributeName="x" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/></rect></svg> Espere...'
                ).prop('disabled', true);

            let form = document.getElementById('form-postulation');
            let formData = new FormData(form);
            $.ajax({
                url: '/postulations-people/store',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message || 'Postulación enviada correctamente'
                    });
                    form.reset();
                    $('.btn-postulations-send-load').html('Enviar').prop('disabled', false);
                    $('#postulationsModal').modal('hide');
                },
                error: function(error) {
                    let errorMsg = 'Error al enviar postulación';
                    if (error.responseJSON && error.responseJSON.error) {
                        errorMsg = error.responseJSON.error;
                    }
                    $('.btn-postulations-send-load').html('Enviar').prop('disabled', false);
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMsg
                    });
                }
            });
        }

        $(document).ready(function() {
            $('#form-postulation').submit(function(e) {
                e.preventDefault();
                e.stopPropagation();

                let formData = new FormData(this);

                $.ajax({
                    url: '/postulations-people/store',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Éxito',
                            text: response.message ||
                                'Postulación enviada correctamente'
                        });
                        $('#form-postulation')[0].reset();
                        $('#postulationsModal').modal('hide');
                    },
                    error: function(error) {
                        let errorMsg = 'Error al enviar postulación';
                        if (error.responseJSON && error.responseJSON.error) {
                            errorMsg = error.responseJSON.error;
                        }
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: errorMsg
                        });
                    }
                });

                return false; // Prevenir el envío tradicional
            });
        });
    </script>


    <script>
        var datatableUser;
        $(document).ready(function() {
            datatableUser = $('#datatableUser').DataTable({
                language: {
                    "sProcessing": "Procesando...",
                    "sLengthMenu": "Mostrar _MENU_ registros",
                    "sZeroRecords": "No se encontraron resultados",
                    "sEmptyTable": "Ningún dato disponible en esta tabla",
                    "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix": "",
                    "sSearch": "Buscar:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Primero",
                        "sLast": "Último",
                        "sNext": "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                }
            });
        });
    </script>

    <script>
        $('#form_departure').submit(function(e) {
            console.log('entra 1');
            e.preventDefault();

            $('.btn-save-load')
                .html(
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><rect width="7.33" height="7.33" x="1" y="1" fill="currentColor"><animate id="SVGzjrPLenI" attributeName="x" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="1" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="1" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="1" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="1" y="15.66" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="15.66" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="15.66" fill="currentColor"><animate id="SVGXAURnSRI" attributeName="x" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/></rect></svg> Espere...'
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
        function clearSearch() {
            $('#form_departure_search')[0].reset();
            if (datatableUser) {
                datatableUser.clear().draw();
            } else {
                $('#datatableUser tbody').html('');
            }
            $('.btn-search-load').html('Buscar').prop('disabled', false);
        }

        $('#contact-form').submit(function(e) {
            e.preventDefault();

            $('.btn-contact-load')
                .html(
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><rect width="7.33" height="7.33" x="1" y="1" fill="currentColor"><animate id="SVGzjrPLenI" attributeName="x" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="1" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="1" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="1" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="1" y="15.66" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="15.66" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="15.66" fill="currentColor"><animate id="SVGXAURnSRI" attributeName="x" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/></rect></svg> Espere'
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
            if (datatableUser) {
                datatableUser.clear().draw();
            } else {
                $('#datatableUser tbody').html('');
            }

            $('.btn-search-load')
                .html(
                    '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><rect width="7.33" height="7.33" x="1" y="1" fill="currentColor"><animate id="SVGzjrPLenI" attributeName="x" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="1" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="1" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="1" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="1" y="15.66" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="15.66" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="15.66" fill="currentColor"><animate id="SVGXAURnSRI" attributeName="x" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/></rect></svg> Espere...'
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
                    var data = response.data || [];
                    var count = 0;
                    var active_data = 0;

                    if (data.length === 0) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Ups',
                            text: 'No se ha encontrado a nadie con este rut.'
                        });
                        if (datatableUser) {
                            datatableUser.clear().draw();
                        } else {
                            $('#datatableUser tbody').html('');
                        }
                        $('.btn-search-load').html('Buscar').prop('disabled', false);
                        return;
                    }

                    for (const item of data) {
                        count++;
                        if (item.active == true) {
                            active_data++;
                            var active =
                                `<button class="btn btn-dark" onclick="finishDeparture(${item.id})">Terminar</button>`;
                        } else {
                            var active = `<span class="badge bg-success">Finalizado</span>`;
                        }

                        if (datatableUser) {
                            datatableUser.row.add([
                                item.name,
                                item.destination,
                                item.departure_date,
                                item.return_date,
                                active
                            ]);
                        } else {
                            $('#datatableUser tbody').append(
                                `<tr>
                                    <td>${item.name}</td>
                                    <td>${item.destination}</td>
                                    <td>${item.departure_date}</td>
                                    <td>${item.return_date}</td>
                                    <td>${active}</td>
                                </tr>`
                            );
                        }
                    }

                    if (datatableUser) {
                        datatableUser.draw();
                    }

                    Swal.fire({
                        position: "top-end",
                        icon: "success",
                        title: `Se han encontrado ${count} registros, ${active_data} activos`,
                        showConfirmButton: false,
                        timer: 5000
                    });
                    $('.btn-search-load').html('Buscar').prop('disabled', false);
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Ups',
                        text: 'Error al buscar salida'
                    });
                    if (datatableUser) {
                        datatableUser.clear().draw();
                    } else {
                        $('#datatableUser tbody').html('');
                    }
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
                            $('#form_departure_search').trigger('submit');
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
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '{{ session('error') }}'
            });
        @endif

        // Animación al hacer scroll
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add("show");
            });
        }, {
            threshold: 0.2
        });

        document.querySelectorAll(".history-year").forEach(y => observer.observe(y));

        // Función para alternar left/right
        function reorderYears() {
            const allYears = document.querySelectorAll(".history-year");
            let lastSide = "right";
            allYears.forEach(item => {
                item.classList.remove("left", "right");
                if (lastSide === "right") {
                    item.classList.add("left");
                    lastSide = "left";
                } else {
                    item.classList.add("right");
                    lastSide = "right";
                }
            });
        }

        // Inicializar alternancia
        reorderYears();

        // Estado inicial: solo 2 primeros visibles
        document.querySelectorAll('.history-hidden').forEach(item => {
            item.style.display = 'none';
        });
        const toggleBtn = document.getElementById("toggleHistory");
        if (toggleBtn) toggleBtn.textContent = 'Saber más';

        // Función para alternar contenido individual de historia
        function toggleHistoryItem(button) {
            const yearItem = button.closest('.history-year');
            if (!yearItem) return;

            const content = button.closest('.history-content');
            const summary = content ? content.querySelector('.history-summary') : null;
            const full = content ? content.querySelector('.history-full') : null;

            // Si existe estructura summary/full, mantener ese comportamiento
            if (summary && full) {
                const isCollapsed = full.style.display === 'none' || full.style.display === '';
                if (isCollapsed) {
                    summary.style.display = 'none';
                    full.style.display = 'block';
                    button.textContent = 'Leer menos';
                    button.classList.add('expanded');
                } else {
                    summary.style.display = 'block';
                    full.style.display = 'none';
                    button.textContent = 'Leer más';
                    button.classList.remove('expanded');
                }
                return;
            }

            // Caso general: usa line-clamp vía clase .expanded en el contenedor
            const isExpanded = yearItem.classList.toggle('expanded');
            button.textContent = isExpanded ? 'Leer menos' : 'Leer más';
            button.classList.toggle('expanded', isExpanded);
        }

        // Asegurar que todos los items de historia tengan botón
        function getHistoryTextElement(item) {
            const summary = item.querySelector('.history-summary');
            if (summary) return summary;
            return item.querySelector('p');
        }

        function ensureHistoryButtons() {
            document.querySelectorAll('.history-year').forEach(item => {
                const p = getHistoryTextElement(item);
                if (!p) return;

                let btn = item.querySelector('.btn-read-more');
                if (!btn) {
                    btn = document.createElement('button');
                    btn.type = 'button';
                    btn.className = 'btn-read-more';
                    btn.textContent = 'Leer más';
                    btn.addEventListener('click', function() { toggleHistoryItem(btn); });

                    // dentro del contenedor (si existe) o debajo del párrafo
                    const content = item.querySelector('.history-content');
                    if (content) content.appendChild(btn);
                    else p.insertAdjacentElement('afterend', btn);
                }
            });
        }

        function updateHistoryButtonsVisibility() {
            document.querySelectorAll('.history-year').forEach(item => {
                const btn = item.querySelector('.btn-read-more');
                const textEl = getHistoryTextElement(item);
                if (!btn || !textEl) return;

                // Si el item está oculto (display:none), no podemos medir bien
                if (item.offsetParent === null) return;

                // Solo mostrar el botón si realmente hay recorte (más de 2 líneas)
                const isOverflowing = textEl.scrollHeight > (textEl.clientHeight + 1);
                btn.style.display = isOverflowing ? '' : 'none';

                // Si no hay overflow, asegurar estado colapsado
                if (!isOverflowing) {
                    item.classList.remove('expanded');
                    btn.classList.remove('expanded');
                    btn.textContent = 'Leer más';

                    const summary = item.querySelector('.history-summary');
                    const full = item.querySelector('.history-full');
                    if (summary && full) {
                        summary.style.display = 'block';
                        full.style.display = 'none';
                    }
                }
            });
        }

        ensureHistoryButtons();
        // espera un tick para que el layout calcule line-clamp antes de medir
        setTimeout(updateHistoryButtonsVisibility, 0);

        // Toggle Saber más
        toggleBtn.addEventListener("click", () => {
            document.querySelectorAll(".history-hidden").forEach(item => item.style.display = item.style.display ===
                "block" ?
                "none" : "block");
            toggleBtn.textContent = document.querySelector(".history-hidden").style.display === "block" ?
                "Ver menos" :
                "Saber más";
            reorderYears(); // recalcula alternancia

            // Recalcular botones después de mostrar/ocultar items
            setTimeout(() => {
                ensureHistoryButtons();
                updateHistoryButtonsVisibility();
            }, 0);
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
