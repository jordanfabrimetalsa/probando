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
                    </div>
                </div>
                <form action="{{ route('contact') }}" method="POST" class="contact-form">
                    @csrf
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
