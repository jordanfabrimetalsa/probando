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
                            <span class="contact-icon"><i class="fas fa-map-marker-alt"></i></span>
                            <div>
                                <h4>Ubicación</h4>
                                <p>Av. Ricardo Cumming 329, Santiago, Chile</p>
                            </div>
                        </div>
                        <div class="contact-item">
                            <div>
                                <h4>Transparencia</h4>
                                <p>
                                    Documentación del Cuerpo de Socorro Andino
                                    Convenio de transferencia de recursos entre el Gobierno Regional y el Cuerpo de Socorro Andino de Chile, para ejecutar el programa denominada «TRANSFERENCIA PROGRAMADA FORTALECIMIENTO, PREVENCIÓN Y EDUCACIÓN DE SEGURIDAD DE MONTAÑA RM» CÓDIGO INI N°40058998
                                    Santiago, 28-12-2023.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <form id="contact-form" method="POST" class="contact-form">
                    @csrf
                    <h3 class="text-dark">Información General</h3>
                    <div class="form-group">
                        <input type="text" name="name" placeholder="Nombre completo" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <input type="email" name="email" placeholder="Correo electrónico" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <select name="type" required>
                            <option value="">Tipo de consulta</option>
                            <option value="capacitacion" {{ old('type')=='capacitacion' ? 'selected' : '' }}>Capacitación</option>
                            <option value="servicios" {{ old('type')=='servicios' ? 'selected' : '' }}>Servicios</option>
                            <option value="colaboracion" {{ old('type')=='colaboracion' ? 'selected' : '' }}>Colaboración</option>
                            <option value="otro" {{ old('type')=='otro' ? 'selected' : '' }}>Otro</option>
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
