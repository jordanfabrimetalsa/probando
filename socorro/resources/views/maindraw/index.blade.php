<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuerpo de Socorro Andino</title>
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" />
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
                        <li class="nav-item"><a class="nav-link" href="#servicios">Servicios</a></li>
                    </li>
                    <li class="nav-item">
                        <li class="nav-item"><a class="nav-link" href="#noticias">Noticias</a></li>
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
                        <li class="nav-item"><a class="nav-link btn btn-danger" href="{{ route('login') }}">Iniciar Sesión</a></li>
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
            <div class="hero-text">
                <h1 class="hero-title">Especialistas en Rescate de Alta Montaña</h1>
                <p class="hero-subtitle">Operaciones de rescate 24/7 con equipos certificados y tecnología de vanguardia</p>
                <div class="hero-buttons">
                    <a href="tel:136" class="btn btn-danger"> <i class="fa-solid fa-phone"></i> Llamar Emergencia</a>
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
            </div>
        </div>
    </section>

    <!-- News Section -->
    <section id="noticias" class="news">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-dark">Últimas Noticias</h2>
                <p class="section-subtitle">Mantente informado sobre nuestras operaciones y novedades del rescate de montaña</p>
            </div>
            <div class="news-grid">
                <article class="news-card featured">
                    <div class="news-image">
                        <img src="{{ asset('assets/img/foto2.jpg') }}" alt="Rescate exitoso en Los Andes">
                        <div class="news-badge">Destacada</div>
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span class="news-date">15 Enero 2025</span>
                            <span class="news-category">Operaciones</span>
                        </div>
                        <h3>Rescate Exitoso de Montañista en Cordillera de Los Andes</h3>
                        <p>Nuestro equipo logró evacuar exitosamente a un montañista herido a 4,200 metros de altitud en condiciones climáticas adversas. La operación duró 6 horas y requirió el uso de helicóptero especializado.</p>
                        <a href="#" class="news-link">Leer más →</a>
                    </div>
                </article>
                
                <article class="news-card">
                    <div class="news-image">
                        <img src="https://images.pexels.com/photos/2398220/pexels-photo-2398220.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Nuevo equipo de rescate">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span class="news-date">12 Enero 2025</span>
                            <span class="news-category">Equipamiento</span>
                        </div>
                        <h3>Incorporamos Nuevo Equipo de Detección RECCO</h3>
                        <p>Hemos adquirido la última tecnología en detectores RECCO para mejorar nuestras capacidades de búsqueda en avalanchas.</p>
                        <a href="#" class="news-link">Leer más →</a>
                    </div>
                </article>
                
                <!--<article class="news-card">
                    <div class="news-image">
                        <img src="https://images.pexels.com/photos/1261728/pexels-photo-1261728.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Capacitación de rescatistas">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span class="news-date">8 Enero 2025</span>
                            <span class="news-category">Capacitación</span>
                        </div>
                        <h3>Curso Avanzado de Rescate en Hielo</h3>
                        <p>Completamos exitosamente el entrenamiento especializado en rescate técnico sobre superficies heladas con certificación internacional.</p>
                        <a href="#" class="news-link">Leer más →</a>
                    </div>
                </article>

                <article class="news-card">
                    <div class="news-image">
                        <img src="https://images.pexels.com/photos/1933239/pexels-photo-1933239.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Temporada de invierno">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span class="news-date">2 Enero 2025</span>
                            <span class="news-category">Prevención</span>
                        </div>
                        <h3>Recomendaciones para la Temporada Invernal</h3>
                        <p>Con la llegada del invierno, compartimos consejos esenciales de seguridad para montañistas y esquiadores en alta montaña.</p>
                        <a href="#" class="news-link">Leer más →</a>
                    </div>
                </article>
                
                <article class="news-card">
                    <div class="news-image">
                        <img src="https://images.pexels.com/photos/1183986/pexels-photo-1183986.jpeg?auto=compress&cs=tinysrgb&w=600" alt="Estadísticas anuales">
                    </div>
                    <div class="news-content">
                        <div class="news-meta">
                            <span class="news-date">28 Diciembre 2024</span>
                            <span class="news-category">Estadísticas</span>
                        </div>
                        <h3>Balance Anual 2024: 500+ Rescates Exitosos</h3>
                        <p>Presentamos las estadísticas del año 2024, destacando nuestro 98% de éxito en operaciones de rescate y evacuación médica.</p>
                        <a href="#" class="news-link">Leer más →</a>
                    </div>
                </article>-->
            </div>
            <div class="news-pagination">
                <button class="pagination-btn active">1</button>
                <button class="pagination-btn">2</button>
                <button class="pagination-btn">3</button>
                <button class="pagination-btn">→</button>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="servicios" class="services">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-dark">Nuestros Servicios</h2>
                <p class="section-subtitle">Operaciones especializadas de rescate en alta montaña</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🚁</div>
                    <h3>Rescate Aerotransportado</h3>
                    <p>Evacuación mediante helicóptero para casos críticos en terrenos inaccesibles</p>
                </div>
                <div class="service-card">
                    <div class="service-icon">🧗</div>
                    <h3>Rescate Técnico Vertical</h3>
                    <p>Operaciones en pared rocosa y hielo utilizando técnicas de escalada avanzada</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section id="equipo" class="team">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-dark">Nuestro Equipo</h2>
                <p class="section-subtitle">Profesionales certificados con experiencia internacional</p>
            </div>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-image">
                        <img src="https://images.pexels.com/photos/2379004/pexels-photo-2379004.jpeg?auto=compress&cs=tinysrgb&w=400" alt="Carlos Mendoza">
                    </div>
                    <h4>Carlos Mendoza</h4>
                    <p class="member-role">Director de Operaciones</p>
                    <p class="member-bio">Guía IFMGA, especialista en rescate técnico con 15 años de experiencia</p>
                </div>
                <div class="team-member">
                    <div class="member-image">
                        <img src="https://images.pexels.com/photos/2379005/pexels-photo-2379005.jpeg?auto=compress&cs=tinysrgb&w=400" alt="Ana Rodriguez">
                    </div>
                    <h4>Ana Rodríguez</h4>
                    <p class="member-role">Médico de Montaña</p>
                    <p class="member-bio">Especialista en medicina de urgencia y alta montaña, certificada IKAR</p>
                </div>
                <div class="team-member">
                    <div class="member-image">
                        <img src="https://images.pexels.com/photos/2379006/pexels-photo-2379006.jpeg?auto=compress&cs=tinysrgb&w=400" alt="Miguel Torres">
                    </div>
                    <h4>Miguel Torres</h4>
                    <p class="member-role">Piloto de Rescate</p>
                    <p class="member-bio">Más de 2000 horas de vuelo en rescates de montaña y terreno complejo</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="galeria" class="gallery">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-dark">Operaciones de Rescate</h2>
                <p class="section-subtitle text-dark">Imágenes de nuestras operaciones en terreno</p>
            </div>
            <div class="gallery-grid">
                <div class="gallery-item">
                    <img src="{{asset('assets/img/foto1.jpg')}}" alt="Rescate en helicóptero">
                    <div class="gallery-overlay">
                        <i class="fa-solid fa-helicopter"></i>
                        <h4>Rescate Aerotransportado</h4>
                        <p>Evacuación en Cordillera de los Andes</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{asset('assets/img/foto2.jpg')}}" alt="Rescate técnico">
                    <div class="gallery-overlay">
                        <i class="fa-solid fa-mountain"></i>
                        <h4>Rescate Técnico</h4>
                        <p>Operación en pared vertical</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{asset('assets/img/foto3.jpg')}}" alt="Equipo de rescate">
                    <div class="gallery-overlay">
                        <i class="fa-solid fa-shield-halved"></i>
                        <h4>Equipo Especializado</h4>
                        <p>Tecnología de última generación</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{asset('assets/img/foto4.jpg')}}" alt="Rescate nocturno">
                    <div class="gallery-overlay">
                        <i class="fa-solid fa-moon"></i>
                        <h4>Operación Nocturna</h4>
                        <p>Rescate en condiciones extremas</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{asset('assets/img/foto5.jpg')}}" alt="Entrenamiento">
                    <div class="gallery-overlay">
                        <i class="fa-solid fa-graduation-cap"></i>
                        <h4>Entrenamiento Continuo</h4>
                        <p>Preparación del equipo</p>
                    </div>
                </div>
                <div class="gallery-item">
                    <img src="{{asset('assets/img/foto6.jpg')}}" alt="Base de operaciones">
                    <div class="gallery-overlay">
                        <i class="fa-solid fa-home"></i>
                        <h4>Base de Operaciones</h4>
                        <p>Centro de comando y control</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contacto" class="contact">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-dark">Contacto</h2>
                <p class="section-subtitle text-dark">Estamos disponibles 24/7 para emergencias</p>
            </div>
            <div class="contact-content">
                <div class="emergency-info">
                    <div class="emergency-card">
                        <h3><i class="fas fa-exclamation-triangle"></i> Emergencias</h3>
                        <p class="emergency-number">136</p>
                    </div>
                    <div class="contact-details">
                        <div class="contact-item">
                            <span class="contact-icon"><i class="fas fa-map-marker-alt"></i></span>
                            <div>
                                <h4>Ubicación</h4>
                                <p>Base El Colorado, Región Metropolitana, Chile</p>
                            </div>
                        </div>
                    </div>
                </div>
                <form class="contact-form">
                    <h3 class="text-dark">Información General</h3>
                    <div class="form-group">
                        <input type="text" placeholder="Nombre completo" required>
                    </div>
                    <div class="form-group">
                        <input type="email" placeholder="Correo electrónico" required>
                    </div>
                    <div class="form-group">
                        <select required>
                            <option value="">Tipo de consulta</option>
                            <option value="capacitacion">Capacitación</option>
                            <option value="servicios">Servicios</option>
                            <option value="colaboracion">Colaboración</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea placeholder="Mensaje" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
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
    </footer>

    <script src="{{asset('assets/js/script.js')}}"></script>
    <!-- Snow Effect Container -->
    <div id="snow-container"></div>
</body>
</html>