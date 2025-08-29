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
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="flush-headingOne">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                          Convenio de transferencia de recursos con el Gobierno Regional
                                        </button>
                                      </h2>
                                      <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the first item's accordion body.</div>
                                      </div>
                                    </div>
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="flush-headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                          Documentación del Cuerpo de Socorro Andino
                                        </button>
                                      </h2>
                                      <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled with some actual content.</div>
                                      </div>
                                    </div>
                                  </div>
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
