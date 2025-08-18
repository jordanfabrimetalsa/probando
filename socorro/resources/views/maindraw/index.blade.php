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
                <h2 class="section-title text-dark">Sobre nosotros</h2>
                <p class="section-subtitle">El Cuerpo de Socorro Andino (CSA) es una organización de voluntarios que se especializa en la búsqueda y rescate en montañas y
                    zonas de difícil acceso en Chile. Es el organismo especializado en rescate en montaña más antiguo de Latinoamérica 1​ y su trabajo lo realiza de manera gratuita.</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <h3>Misión</h3>
                    <p>Atender voluntariamente y de forma gratuita la búsqueda, salvamento y/o rescate de personas, cualquiera sea su nacionalidad, condición, edad, estado o profesión, que se encuentren extraviadas o hayan sufrido algún
                        accidente en cualquier punto del territorio nacional, particularmente en las regiones montañosas y/o en zonas de difícil acceso.</p>
                </div>
                <div class="service-card">
                    <h3>Visión</h3>
                    <p>Ser el referente nacional de búsqueda, rescate, prevención y educación de actividades de montaña en Chile.</p>
                </div>
            </div>
        </div>
    </section>

    <section id="historia" class="history">
        <div class="container">
          <div class="section-header">
            <h2 class="section-title text-dark">Historia</h2>
            <p class="section-subtitle">Nuestra historia como institución.</p>
          </div>

          <div class="history-grid">
            <!-- Primeros 2 siempre visibles -->
            <div class="history-year">
              <h3>1949</h3>
              <p><strong>Nace la idea | </strong>Oscar Álvarez Pereira, Fue director de andinismo y vicepresidente de la Asociación de Ski y Andinismo de Santiago, perteneció al Club Andino Huelen, en su calidad de director y cumpliendo los reglamentos de esta organización, el 31 de mayo de 1949, en reunión del consejo, propone la creación del Cuerpo de Socorro Andino, la que es aprobada por unanimidad de sus participantes.</p>
            </div>
            <div class="history-year">
              <h3>1951</h3>
              <p><strong>Primer rescate | </strong>El voluntario Carlos Álvarez Reyes realiza el primer rescate a nombre del CSA.</p>
            </div>

            <!-- Ocultos inicialmente -->
            <div class="history-year history-hidden">
              <h3>1956</h3>
              <p><strong>Carácter nacional | </strong>El CSA pasa a la Federación de Andinismo de Chile y adquiere el carácter nacional, así mismo comienzan a recibir formación especializada por parte de los médicos montañistas Álvaro Yáñez, Eneas Valenzuela y Jorge Beka, que a su vez eran voluntarios del CSA.</p>
            </div>

            <div class="history-year history-hidden">
              <h3>1960</h3>
              <p><strong>Terremoto del sur | </strong>Ante la magnitud del terremoto que afecto al sur de Chile, el CSA sintió la vocación de servicio de socorro y acudió en ayuda de la ciudad de Puerto Montt, trabajando durante 25 días al mando del Voluntario Guillermo Silva (Willy) que realizo una abnegada labor por los damnificados.</p>
            </div>

            <div class="history-year history-hidden">
              <h3>1962</h3>
              <p><strong>Primer refugio posta | </strong>Se entrega terreno para construir la Posta-Refugio.</p>
            </div>

            <div class="history-year history-hidden">
              <h3>1964</h3>
              <p><strong>Delegación Rancagua | </strong>El 15 de septiembre de este año se crea la Delegación Rancagua a cargo del voluntario Dr. Augusto Figueroa</p>
            </div>

            <div class="history-year history-hidden">
              <h3>1965</h3>
              <p><strong>Primer vehículo | </strong>Se compra la ambulancia naranja Land Rover “Zanahoria”.</p>
            </div>

            <div class="history-year history-hidden">
              <h3>1969</h3>
              <p><strong>Corporación de voluntarios | </strong>El Cuerpo de Socorro Andino de Chile fue establecido oficialmente como una corporación de derecho privado sin fines de lucro en 1969.</p>
            </div>

            <div class="history-year history-hidden">
                <h3>1972</h3>
                <p><strong>Avion de rugbistas uruguayos | </strong>Ocurre uno de los hechos mas singulares de la aviación mundial, luego que 16 jóvenes uruguayos sobreviven 72 días en la alta montaña, 2 sobrevivientes logran hacer contacto con un arriero, posteriormente entre el SAR y CSA proceden a la evacuación del resto de los sobrevivientes y dan sepultura en el lugar al resto de los cuerpos.</p>
            </div>

            <div class="history-year history-hidden">
                <h3>1973</h3>
                <p><strong>Adquisición del cuartel | </strong>En abril de ese año se compra el cuartel de la 12ª compañía de bomberos de Santiago, se cumple el anhelo del CSA de tener su propia sede. Años después se vende para la construcción de un edificio manteniéndose el cuartel en el primer piso de la nueva construcción hasta el día de hoy.</p>
            </div>

            <div class="history-year history-hidden">
                <h3>1981</h3>
                <p><strong>Refugio Baños Morales | </strong>CSA adquiere su nuevo refugio en Baños Morales con la finalidad de atender esta importante zona de practica de andinismo deportivo y para el entrenamiento de sus voluntarios.</p>
            </div>
            <div class="history-year history-hidden">
                <h3>1989</h3>
                <p><strong>Diplomático alemán | </strong>En búsqueda del diplomático alemán Sr Hans Buss en el Volcán Casablanca, participó el militar de la embajada alemana, el Teniente Coronel Wolhart Saul. Como resultado, se estableció una amistad importante, por lo cual el Sr Saul gestionó una importante donación de equipos para nuestra institución.</p>
            </div>
            <div class="history-year history-hidden">
                <h3>2002</h3>
                <p><strong>Trabajo en Conjunto | </strong>El 17 de Mayo de este año se suscribe el "Protocolo de gestión conjunta entre ONEMI y CSA".</p>
            </div>
            <div class="history-year history-hidden">
                <h3>2005</h3>
                <p><strong>Tragedia de Antuco | </strong>Recuperación de muertos después de una marcha forzada en -35°C.</p>
            </div>
          </div>

          <div style="text-align:center; margin-top:30px;">
            <button id="toggleHistory" class="btn-history">Saber más</button>
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

    <!-- Team Section -->
    <section id="equipo" class="team">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title text-dark">Directiva Nacional</h2>
                <p class="section-subtitle">Equipo conformado por.</p>
            </div>
            <div class="team-grid">
                <div class="team-member">
                    <div class="member-image">
                        <img src="{{asset('assets/img/sin-imagen.png')}}" alt="Hernan Asencio">
                    </div>
                    <h4>Hernan Asencio</h4>
                    <p class="member-role">Secretario Nacional</p>
                    <p class="member-bio">Delegación de Socorro Andino</p>
                </div>
                <div class="team-member">
                    <div class="member-image">
                        <img src="{{asset('assets/img/felipe.jpeg')}}" alt="Felipe Silva">
                    </div>
                    <h4>Felipe Silva</h4>
                    <p class="member-role">Director Nacional</p>
                    <p class="member-bio">Delegación de Socorro Andino</p>
                </div>
                <div class="team-member">
                    <div class="member-image">
                        <img src="{{asset('assets/img/daniela.jpeg')}}" alt="Daniela Silva">
                    </div>
                    <h4>Daniela Silva</h4>
                    <p class="member-role">Directora Administrativa</p>
                    <p class="member-bio">Delegación de Socorro Andino</p>
                </div>
                <div class="team-member">
                    <div class="member-image">
                        <img src="{{asset('assets/img/sergio.jpeg')}}" alt="Sergio Merino">
                    </div>
                    <h4>Sergio Merino</h4>
                    <p class="member-role">Tesorero Nacional</p>
                    <p class="member-bio">Delegación de Socorro Andino</p>
                </div>
                <div class="team-member">
                    <div class="member-image">
                        <img src="{{asset('assets/img/mauricio.jpeg')}}" alt="Mauricio Binfa">
                    </div>
                    <h4>Mauricio Binfa</h4>
                    <p class="member-role">Director Técnico</p>
                    <p class="member-bio">Delegación de Socorro Andino</p>
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
                                <p>Av. Ricardo Cumming 329, Santiago, Chile</p>
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
