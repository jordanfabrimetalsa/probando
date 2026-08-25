<nav class="navbar navbar-main navbar-expand px-0" id="navbarBlur" data-scroll="true">
    <div class="container-fluid px-3">
        <div class="admin-header__left">
            <button type="button" class="admin-header__menu d-xl-none" id="iconNavbarSidenav" aria-label="Abrir menú">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="admin-header__page">
                <span>Panel institucional</span>
                <strong>@yield('title', 'Dashboard')</strong>
            </div>
        </div>

        <div class="dropdown">
            <button class="admin-header__user" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                <span class="admin-header__avatar">{{ mb_strtoupper(mb_substr(Auth::user()->name, 0, 1)) }}</span>
                <span class="admin-header__identity">
                    <strong>{{ Auth::user()->name }}</strong>
                    <small>{{ str_replace('_', ' ', Auth::user()->role) }}</small>
                </span>
                <i class="fa-solid fa-chevron-down admin-header__chevron"></i>
            </button>
            <ul class="dropdown-menu dropdown-menu-end admin-header__dropdown">
                <li class="admin-header__dropdown-title">
                    <span>Sesión iniciada como</span>
                    <strong>{{ Auth::user()->email }}</strong>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item" href="{{ route('profile') }}">
                        <i class="fa-regular fa-user"></i><span>Mi perfil</span>
                    </a>
                </li>
                <li>
                    <button type="button" class="dropdown-item fixed-plugin-button-nav">
                        <i class="fa-solid fa-sliders"></i><span>Apariencia</span>
                    </button>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <a class="dropdown-item admin-header__logout" href="{{ route('logout') }}">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i><span>Cerrar sesión</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
