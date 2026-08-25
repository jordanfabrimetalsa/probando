@php
    $user = auth()->user();
    $operationsOpen = request()->routeIs('aviso.*', 'calendario*', 'registro-rescate*');
    $peopleOpen = request()->routeIs('voluntarios*', 'postulations.*');
    $adminOpen = request()->routeIs('delegaciones*', 'usuarios*', 'roles.*', 'inventario*', 'finances.*');
    $communicationsOpen = request()->routeIs('news*', 'contacto*');
@endphp

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2 bg-white my-2"
    id="sidenav-main" style="box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5)">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand px-4 py-3 m-0" href="{{ route('dashboard') }}">
            <img src="{{ asset('assets/img/logo-socorro.png') }}" class="navbar-brand-img" width="26" height="26" alt="CSA Chile">
            <span class="ms-1 text-sm text-gray opacity-5">CSA Chile</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-dark {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                    <i class="fa-solid fa-chart-line opacity-5"></i><span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

            @if($user->hasPermission('departures.manage') || $user->hasPermission('calendar.manage') || $user->hasPermission('rescues.manage'))
                <li class="nav-item">
                    <a class="nav-link text-dark" data-bs-toggle="collapse" href="#collapseOperations" aria-expanded="{{ $operationsOpen ? 'true' : 'false' }}" aria-controls="collapseOperations">
                        <i class="fa-solid fa-person-hiking opacity-5"></i><span class="nav-link-text ms-1">Operaciones</span>
                    </a>
                    <div class="collapse {{ $operationsOpen ? 'show' : '' }}" id="collapseOperations"><ul class="nav ms-4">
                        @if($user->hasPermission('departures.manage'))
                            <li class="nav-item"><a class="nav-link text-dark {{ request()->routeIs('aviso.*') ? 'active' : '' }}" href="{{ route('aviso.list') }}"><i class="material-symbols-rounded opacity-5">hiking</i><span class="nav-link-text ms-1">Avisos de salida</span></a></li>
                        @endif
                        @if($user->hasPermission('calendar.manage'))
                            <li class="nav-item"><a class="nav-link text-dark {{ request()->routeIs('calendario*') ? 'active' : '' }}" href="{{ route('calendario') }}"><i class="fa-solid fa-calendar opacity-5"></i><span class="nav-link-text ms-1">Calendario y guardias</span></a></li>
                        @endif
                        @if($user->hasPermission('rescues.manage'))
                            <li class="nav-item"><a class="nav-link text-dark {{ request()->routeIs('registro-rescate*') ? 'active' : '' }}" href="{{ route('registro-rescate') }}"><i class="material-symbols-rounded opacity-5">medical_services</i><span class="nav-link-text ms-1">Registros de rescate</span></a></li>
                        @endif
                    </ul></div>
                </li>
            @endif

            @if($user->hasPermission('volunteers.manage') || $user->hasPermission('delegations.manage'))
                <li class="nav-item">
                    <a class="nav-link text-dark" data-bs-toggle="collapse" href="#collapsePeople" aria-expanded="{{ $peopleOpen ? 'true' : 'false' }}" aria-controls="collapsePeople">
                        <i class="fa-solid fa-users opacity-5"></i><span class="nav-link-text ms-1">Personas</span>
                    </a>
                    <div class="collapse {{ $peopleOpen ? 'show' : '' }}" id="collapsePeople"><ul class="nav ms-4">
                        @if($user->hasPermission('volunteers.manage'))
                            <li class="nav-item"><a class="nav-link text-dark {{ request()->routeIs('voluntarios*') ? 'active' : '' }}" href="{{ route('voluntarios') }}"><i class="material-symbols-rounded opacity-5">person</i><span class="nav-link-text ms-1">Voluntarios</span></a></li>
                        @endif
                        @if($user->hasPermission('delegations.manage'))
                            <li class="nav-item"><a class="nav-link text-dark {{ request()->routeIs('postulations.*') ? 'active' : '' }}" href="{{ route('postulations.index') }}"><i class="material-symbols-rounded opacity-5">how_to_reg</i><span class="nav-link-text ms-1">Postulaciones</span></a></li>
                        @endif
                    </ul></div>
                </li>
            @endif

            @if($user->hasPermission('delegations.manage') || $user->hasPermission('users.manage') || $user->hasPermission('roles.manage') || $user->hasPermission('inventory.manage') || $user->hasPermission('finances.manage'))
                <li class="nav-item">
                    <a class="nav-link text-dark" data-bs-toggle="collapse" href="#collapseAdmin" aria-expanded="{{ $adminOpen ? 'true' : 'false' }}" aria-controls="collapseAdmin">
                        <i class="fa-solid fa-lock-open opacity-5"></i><span class="nav-link-text ms-1">Administración</span>
                    </a>
                    <div class="collapse {{ $adminOpen ? 'show' : '' }}" id="collapseAdmin"><ul class="nav ms-4">
                        @if($user->hasPermission('delegations.manage'))
                            <li class="nav-item"><a class="nav-link text-dark {{ request()->routeIs('delegaciones*') ? 'active' : '' }}" href="{{ route('delegaciones') }}"><i class="material-symbols-rounded opacity-5">home</i><span class="nav-link-text ms-1">Delegaciones</span></a></li>
                        @endif
                        @if($user->hasPermission('users.manage'))
                            <li class="nav-item"><a class="nav-link text-dark {{ request()->routeIs('usuarios*') ? 'active' : '' }}" href="{{ route('usuarios') }}"><i class="material-symbols-rounded opacity-5">person</i><span class="nav-link-text ms-1">Usuarios</span></a></li>
                        @endif
                        @if($user->hasPermission('roles.manage') && \App\Support\DelegationAccess::isNational())
                            <li class="nav-item"><a class="nav-link text-dark {{ request()->routeIs('roles.*') ? 'active' : '' }}" href="{{ route('roles.index') }}"><i class="fa-solid fa-user-shield opacity-5"></i><span class="nav-link-text ms-1">Roles y permisos</span></a></li>
                        @endif
                        @if($user->hasPermission('inventory.manage'))
                            <li class="nav-item"><a class="nav-link text-dark {{ request()->routeIs('inventario*') ? 'active' : '' }}" href="{{ route('inventario') }}"><i class="material-symbols-rounded opacity-5">inventory_2</i><span class="nav-link-text ms-1">Inventario</span></a></li>
                        @endif
                        @if($user->hasPermission('finances.manage'))
                            <li class="nav-item"><a class="nav-link text-dark {{ request()->routeIs('finances.*') ? 'active' : '' }}" href="{{ route('finances.index') }}"><i class="fa-solid fa-wallet opacity-5"></i><span class="nav-link-text ms-1">Finanzas</span></a></li>
                        @endif
                    </ul></div>
                </li>
            @endif

            @if($user->hasPermission('news.manage') || $user->hasPermission('contacts.manage'))
                <li class="nav-item">
                    <a class="nav-link text-dark" data-bs-toggle="collapse" href="#collapseCommunications" aria-expanded="{{ $communicationsOpen ? 'true' : 'false' }}" aria-controls="collapseCommunications">
                        <i class="fa-solid fa-bullhorn opacity-5"></i><span class="nav-link-text ms-1">Comunicaciones</span>
                    </a>
                    <div class="collapse {{ $communicationsOpen ? 'show' : '' }}" id="collapseCommunications"><ul class="nav ms-4">
                        @if($user->hasPermission('news.manage'))
                            <li class="nav-item"><a class="nav-link text-dark {{ request()->routeIs('news*') ? 'active' : '' }}" href="{{ route('news') }}"><i class="material-symbols-rounded opacity-5">newspaper</i><span class="nav-link-text ms-1">Noticias</span></a></li>
                        @endif
                        @if($user->hasPermission('contacts.manage'))
                            <li class="nav-item"><a class="nav-link text-dark {{ request()->routeIs('contacto*') ? 'active' : '' }}" href="{{ route('contacto') }}"><i class="material-symbols-rounded opacity-5">contact_support</i><span class="nav-link-text ms-1">Contactos</span></a></li>
                        @endif
                    </ul></div>
                </li>
            @endif

            <li class="nav-item"><a class="nav-link text-dark {{ request()->routeIs('profile') ? 'active' : '' }}" href="{{ route('profile') }}"><i class="material-symbols-rounded opacity-5">person</i><span class="nav-link-text ms-1">Mi Perfil</span></a></li>
        </ul>
    </div>
</aside>
