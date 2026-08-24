<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Acceso institucional · Socorro Andino</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/logo-socorro.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/loading-overlay.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/login-modern.css') }}">
</head>

<body class="login-modern">
    @include('partials.loading-overlay')

    <main class="login-page">
        <a href="{{ route('maindraw') }}" class="login-back" data-no-loading>
            <i class="fa-solid fa-arrow-left"></i> Volver al sitio
        </a>

        <div class="login-shell">
            <section class="login-context" aria-label="Cuerpo de Socorro Andino">
                <div class="login-context-content">
                    <span class="login-kicker">Acceso institucional</span>
                    <h1>Preparados para responder cuando más importa.</h1>
                    <p>Plataforma de gestión del Cuerpo de Socorro Andino de Chile.</p>
                    <div class="login-context-stats">
                        <div><strong>24/7</strong><span>Disponibilidad</span></div>
                        <div><strong>Chile</strong><span>Cobertura nacional</span></div>
                    </div>
                </div>
                <div class="login-context-footer">
                    <span class="login-status-dot"></span> Sistema institucional
                </div>
            </section>

            <section class="login-panel">
                <div class="login-brand">
                    <img src="{{ asset('assets/img/logo-socorro.png') }}" alt="Logo del Cuerpo de Socorro Andino"
                        class="csa-pulse-logo">
                    <div><strong>Cuerpo de Socorro Andino</strong><span>Chile</span></div>
                </div>

                <div class="login-heading">
                    <h2>Bienvenido</h2>
                    <p>Ingresa tus credenciales para continuar.</p>
                </div>

                <form method="POST" action="{{ route('logear') }}" data-loading-title="Iniciando sesión">
                    @csrf
                    <div class="login-field">
                        <label for="email">Correo electrónico</label>
                        <div class="login-input-wrap">
                            <i class="fa-regular fa-envelope"></i>
                            <input id="email" type="email" name="email" value="{{ old('email') }}"
                                placeholder="nombre@correo.cl" autocomplete="email" required autofocus>
                        </div>
                    </div>

                    <div class="login-field">
                        <div class="login-label-row"><label for="password">Contraseña</label></div>
                        <div class="login-input-wrap">
                            <i class="fa-solid fa-lock"></i>
                            <input id="password" type="password" name="password" placeholder="Ingresa tu contraseña"
                                autocomplete="current-password" required>
                            <button type="button" class="login-password-toggle" aria-label="Mostrar contraseña"
                                aria-pressed="false" data-no-loading>
                                <i class="fa-regular fa-eye"></i>
                            </button>
                        </div>
                    </div>

                    <label class="login-remember" for="rememberMe">
                        <input type="checkbox" id="rememberMe" name="remember" value="1">
                        <span>Recordarme en este equipo</span>
                    </label>

                    <button type="submit" class="login-submit">
                        Iniciar sesión <i class="fa-solid fa-arrow-right"></i>
                    </button>
                </form>

                <div class="login-security">
                    <i class="fa-solid fa-shield-halved"></i>
                    <span>Acceso exclusivo para personal autorizado.</span>
                </div>
            </section>
        </div>

        <footer class="login-footer">© {{ date('Y') }} Cuerpo de Socorro Andino de Chile</footer>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/loading-overlay.js') }}"></script>
    <script>
        const passwordToggle = document.querySelector('.login-password-toggle');
        const passwordInput = document.getElementById('password');
        passwordToggle.addEventListener('click', function () {
            const show = passwordInput.type === 'password';
            passwordInput.type = show ? 'text' : 'password';
            this.setAttribute('aria-pressed', show ? 'true' : 'false');
            this.setAttribute('aria-label', show ? 'Ocultar contraseña' : 'Mostrar contraseña');
            this.querySelector('i').className = show ? 'fa-regular fa-eye-slash' : 'fa-regular fa-eye';
        });
    </script>

    @if (session('success'))
        <script>Swal.fire({ icon: 'success', title: 'Operación exitosa', text: @json(session('success')) });</script>
    @endif
    @if (session('error'))
        <script>Swal.fire({ icon: 'error', title: 'No fue posible ingresar', text: @json(session('error')) });</script>
    @endif
</body>
</html>
