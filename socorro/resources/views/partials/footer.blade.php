<footer class="site-footer bg-dark text-white pt-5">
    <div class="container">
        <div class="row g-4">
            <!-- About / Brand -->
            <div class="col-12 col-md-6 col-lg-3">
                <div class="footer-brand d-flex align-items-center mb-3">
                    <img src="{{ asset('assets/img/logo-socorro.png') }}" alt="CSA" width="48" height="48" class="me-2">
                    <div>
                        <strong class="d-block">Cuerpo de Socorro Andino</strong>
                    </div>
                </div>
                <p class="footer-text small mb-3">
                    Voluntarios especialistas en rescate de montaña. Prevención, educación y respuesta 24/7.
                </p>
                <div class="footer-social d-flex gap-3">
                    <a href="#" aria-label="Facebook" class="text-white-50 hover-white"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Instagram" class="text-white-50 hover-white"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="X" class="text-white-50 hover-white"><i class="fab fa-x-twitter"></i></a>
                    <a href="#" aria-label="YouTube" class="text-white-50 hover-white"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="col-6 col-lg-2">
                <h6 class="footer-title text-uppercase">Enlaces</h6>
                <ul class="list-unstyled footer-links">
                    <li><a href="#inicio">Inicio</a></li>
                    <li><a href="#noticias">Noticias</a></li>
                    <li><a href="#servicios">Servicios</a></li>
                    <li><a href="#historia">Historia</a></li>
                    <li><a href="#galeria">Galería</a></li>
                    <li><a href="#contacto">Contacto</a></li>
                </ul>
            </div>

            <!-- Info -->
            <div class="col-6 col-lg-3">
                <h6 class="footer-title text-uppercase">Contacto</h6>
                <ul class="list-unstyled footer-contact small">
                    <li class="d-flex align-items-start gap-2 mb-2">
                        <i class="fa-solid fa-location-dot mt-1 text-white-50"></i>
                        <span>Quinta Normal, Santiago de Chile</span>
                    </li>
                    <li class="d-flex align-items-start gap-2 mb-2">
                        <i class="fa-solid fa-envelope mt-1 text-white-50"></i>
                        <a href="mailto:contacto@csa.cl">contacto@csa.cl</a>
                    </li>
                    <li class="d-flex align-items-start gap-2 mb-2">
                        <i class="fa-solid fa-phone mt-1 text-white-50"></i>
                        <a href="tel:+136">136</a>
                    </li>
                    <li class="d-flex align-items-start gap-2">
                        <i class="fa-solid fa-clock mt-1 text-white-50"></i>
                        <span>Lun - Dom: 24/7 emergencias</span>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div class="col-12 col-lg-4">
                <h6 class="footer-title text-uppercase">Boletín</h6>
                <p class="small text-white-50 mb-3">Recibe noticias y recomendaciones de seguridad de montaña.</p>
                <form class="footer-newsletter" onsubmit="event.preventDefault(); this.reset();">
                    <div class="input-group input-group-lg">
                        <input type="email" class="form-control bg-transparent text-white border-secondary" placeholder="Tu correo" required disabled>
                        <button class="btn btn-danger" type="submit">Suscribirme</button>
                    </div>
                    <small class="d-block mt-2 text-white-50">Puedes darte de baja cuando quieras.</small>
                </form>
            </div>
        </div>

        <!-- Sponsors (optional row) -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="footer-sponsors d-flex flex-wrap align-items-center gap-3 opacity-75">
                    <span class="small text-white-50 me-2">Auspician:</span>
                    <img src="{{ asset('assets/img/gremm.png') }}" alt="Sponsor" width="60" height="60" class="rounded-circle border border-secondary">
                    <img src="{{ asset('assets/img/estilo.png') }}" alt="Sponsor" width="60" height="60" class="rounded-circle border border-secondary">
                    <img src="{{ asset('assets/img/andinismo.png') }}" alt="Sponsor" width="60" height="60" class="rounded-circle border border-secondary">
                    <img src="{{ asset('assets/img/museo.png') }}" alt="Sponsor" width="60" height="60" class="rounded-circle border border-secondary">
                    <img src="{{ asset('assets/img/fundacion.png') }}" alt="Sponsor" width="60" height="60" class="rounded-circle border border-secondary">
                </div>
            </div>
        </div>

        <hr class="footer-divider my-4 border-secondary" />

        <!-- Legal bar -->
        <div class="footer-legal d-flex flex-column flex-md-row justify-content-between align-items-center py-3">
            <div class="small text-white-50">&copy; {{ date('Y') }} Cuerpo de Socorro Andino. Todos los derechos reservados.</div>
            <ul class="list-inline m-0 small">
                <li class="list-inline-item"><a href="#">Privacidad</a></li>
                <li class="list-inline-item"><a href="#">Términos</a></li>
                <li class="list-inline-item"><a href="#contacto">Contacto</a></li>
            </ul>
        </div>
    </div>
</footer>
