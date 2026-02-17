    <!-- Contact Section -->
    <section id="contacto" class="contact">
        <div class="reveal container">
            <div class="section-header">
                <h2 class="section-title text-dark">Contacto</h2>
                <hr style="border-top: 3px solid rgb(102, 204, 251); width: 20%; margin: 0 auto; margin-bottom: 1rem;">
                <p class="section-subtitle text-dark">Estamos disponibles 24/7 para emergencias</p>
            </div>
            <div class="contact-content">
                <div class="emergency-info">
                    <div class="contact-details">
                        <div class="contact-item">
                            <div>
                                <h4>Ubicación</h4>
                                <p>Av. Ricardo Cumming 329, Santiago, Chile</p>
                            </div>
                            <div class="map-container">
                                <iframe
                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4152.965526420888!2d-70.67070728798907!3d-33.44126877328218!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662c5acdb6f62f5%3A0xca71efc12da5314e!2sCuerpo%20de%20Socorro%20Andino%20de%20Chile!5e1!3m2!1ses-419!2scl!4v1756588693777!5m2!1ses-419!2scl"
                                    style="width: 100%; height: 100%; border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div>
                                <h4>Transparencia</h4>
                                <hr style="border-top: 3px solid rgb(102, 204, 251); width: 20%; margin-bottom: 1rem;">
                                <p>
                                    Documentación del Cuerpo de Socorro Andino
                                    Convenio de transferencia de recursos entre el Gobierno Regional y el Cuerpo de
                                    Socorro Andino de Chile, para ejecutar el programa denominada «TRANSFERENCIA
                                    PROGRAMADA FORTALECIMIENTO, PREVENCIÓN Y EDUCACIÓN DE SEGURIDAD DE MONTAÑA RM»
                                    CÓDIGO INI N°40058998
                                    Santiago, 28-12-2023.
                                </p>
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="flush-headingOne">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                                Documentación
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                            aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <a href="{{ asset('assets/pdf/CONVENIO-ENTRE-SENAPRED-Y-CSA-2024-para-transparencia.pdf') }}"
                                                    class="btn btn-sm btn-danger" target="_blank"><i
                                                        class="fas fa-file-pdf"></i> Convenio de transferencia con el
                                                    Gobierno Regional</a>
                                                <hr
                                                    style="border-top: 3px solid rgb(102, 204, 251); width: 100%; margin: 0 auto; margin-bottom: 1rem; margin-top: 1rem;">
                                                <a href="{{ asset('assets/pdf/RESOLUCION_EXENTA_N_4298_Para-subir-a-transparencia.pdf') }}"
                                                    class="btn btn-sm btn-danger" target="_blank"><i
                                                        class="fas fa-file-pdf"></i> Documentación del Cuerpo de Socorro
                                                    Andino</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="contact-form" method="POST" class="contact-form">
                    @csrf
                    <h3 class="text-dark title-contact-form">Información General</h3>
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Nombre completo" value="{{ old('name') }}"
                            required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Correo electrónico"
                            value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <select name="type" required>
                            <option value="">Tipo de consulta</option>
                            <option value="capacitacion" {{ old('type') == 'capacitacion' ? 'selected' : '' }}>
                                Capacitación</option>
                            <option value="servicios" {{ old('type') == 'servicios' ? 'selected' : '' }}>Servicios
                            </option>
                            <option value="colaboracion" {{ old('type') == 'colaboracion' ? 'selected' : '' }}>
                                Colaboración</option>
                            <option value="otro" {{ old('type') == 'otro' ? 'selected' : '' }}>Otro</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <textarea name="message" placeholder="Mensaje" rows="5" required>{{ old('message') }}</textarea>
                    </div>
                    <button type="submit" class="btn btn-dark btn-contact-load">Enviar Mensaje</button>
                </form>
            </div>
        </div>
    </section>
