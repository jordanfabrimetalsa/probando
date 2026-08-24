@php
    $directiva = [
        ['nombre' => 'Felipe Silva', 'cargo' => 'Director Nacional', 'icono' => 'fa-shield-halved', 'principal' => true],
        ['nombre' => 'Sergio Godoy', 'cargo' => 'Secretario General', 'icono' => 'fa-file-signature'],
        ['nombre' => 'Sergio Merino', 'cargo' => 'Tesorero Nacional', 'icono' => 'fa-scale-balanced'],
        ['nombre' => 'Daniela Silva', 'cargo' => 'Directora Administrativa', 'icono' => 'fa-building-shield'],
        ['nombre' => 'Maurizio Binfa', 'cargo' => 'Director Técnico', 'icono' => 'fa-compass-drafting'],
    ];
@endphp

<div class="modal fade national-board-modal" id="directivaModal" tabindex="-1"
    aria-labelledby="directivaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content modal-extra-background">
            <div class="modal-header national-board-header">
                <div class="d-flex align-items-center gap-3">
                    <img src="{{ asset('assets/img/logo-socorro.png') }}" alt="Cuerpo de Socorro Andino"
                        class="national-board-logo">
                    <div>
                        <span class="national-board-kicker">Gobierno institucional</span>
                        <h5 class="modal-title" id="directivaModalLabel">Directiva Nacional</h5>
                        <small>Periodo {{ date('Y') }}</small>
                    </div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
            </div>

            <div class="modal-body national-board-body">
                <div class="national-board-intro">
                    <div>
                        <span class="national-board-eyebrow">Cuerpo de Socorro Andino de Chile</span>
                        <h2>Liderazgo al servicio del rescate y la comunidad</h2>
                        <p>La Directiva Nacional conduce la gestión institucional y resguarda el cumplimiento de
                            nuestra misión voluntaria, gratuita y de servicio público en todo el país.</p>
                    </div>
                    <div class="national-board-seal" aria-hidden="true">
                        <i class="fa-solid fa-mountain-sun"></i><span>Chile</span>
                    </div>
                </div>

                <div class="national-board-grid">
                    @foreach ($directiva as $miembro)
                        <article class="board-member {{ !empty($miembro['principal']) ? 'board-member--principal' : '' }}">
                            <div class="board-member-photo">
                                <img src="{{ asset('assets/img/sinperfil.png') }}" alt="Retrato de {{ $miembro['nombre'] }}">
                            </div>
                            <div class="board-member-info">
                                <span class="board-member-role"><i class="fa-solid {{ $miembro['icono'] }}"></i>
                                    {{ $miembro['cargo'] }}</span>
                                <h3>{{ $miembro['nombre'] }}</h3>
                                <span class="board-member-institution">Directiva Nacional · CSA Chile</span>
                            </div>
                            <span class="board-member-number">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                        </article>
                    @endforeach
                </div>

                <div class="national-board-footer-note">
                    <i class="fa-solid fa-handshake-angle"></i>
                    <span>Compromiso, preparación y servicio voluntario en beneficio de quienes realizan actividades
                        en montaña y zonas de difícil acceso.</span>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    <i class="fa-solid fa-xmark me-1"></i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
