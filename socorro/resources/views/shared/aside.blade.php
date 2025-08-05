<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-radius-lg fixed-start ms-2  bg-white my-2" id="sidenav-main" style="box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5)">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand px-4 py-3 m-0" href="https://demos.creative-tim.com/material-dashboard/pages/dashboard " target="_blank">
        <img src="../assets/img/logo-socorro.png" class="navbar-brand-img" width="26" height="26" alt="main_logo">
        <span class="ms-1 text-sm ms-1 text-gray opacity-5">CSA Chile</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0 mb-2">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active bg-gradient-dark text-white" href="{{ route('dashboard') }}">
            <i class="fa-solid fa-chart-line opacity-5"></i>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        @can('watch-admin')
        <li class="nav-item">
          <a class="nav-link text-dark" data-bs-toggle="collapse" href="#collapseAdmin" role="button" aria-expanded="false" aria-controls="collapseAdmin">
            <i class="fa-solid fa-lock-open opacity-5"></i>
            <span class="nav-link-text ms-1">Administración</span>
          </a>
          <div class="collapse" id="collapseAdmin">
            <ul class="nav ms-4">
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('usuarios') }}">
                  <i class="material-symbols-rounded opacity-5">person</i>
                  <span class="nav-link-text ms-1">Usuarios</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('delegaciones') }}">
                  <i class="material-symbols-rounded opacity-5">home</i>
                  <span class="nav-link-text ms-1">Delegaciones</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('voluntarios') }}">
                  <i class="material-symbols-rounded opacity-5">person</i>
                  <span class="nav-link-text ms-1">Voluntarios</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('inventario') }}">
                  <i class="material-symbols-rounded opacity-5">inventory</i>
                  <span class="nav-link-text ms-1">Inventario</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('vehiculo') }}">
                  <i class="material-symbols-rounded opacity-5">directions_car</i>
                  <span class="nav-link-text ms-1">Vehículos</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        @endcan
        <li class="nav-item">
          <a class="nav-link text-dark" data-bs-toggle="collapse" href="#collapseChecklist" role="button" aria-expanded="false" aria-controls="collapseChecklist">
            <i class="fa-solid fa-list-check opacity-5"></i>
            <span class="nav-link-text ms-1">Check List</span>
          </a>
          <div class="collapse" id="collapseChecklist">
            <ul class="nav ms-4">
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('checklist.categoria') }}">
                  <i class="material-symbols-rounded opacity-5">category</i>
                  <span class="nav-link-text ms-1">Categorias</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-dark" href="{{ route('checklist.respuesta') }}">
                  <i class="material-symbols-rounded opacity-5">checklist_rtl</i>
                  <span class="nav-link-text ms-1">Respuestas</span>
                </a>
              </li>
            </ul>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{ route('calendario') }}">
            <i class="fa-solid fa-calendar opacity-5"></i>
            <span class="nav-link-text ms-1">Calendario</span>
          </a>
        </li>

        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs text-dark font-weight-bolder opacity-5">Otros</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="../pages/profile.html">
            <i class="fa-regular fa-user opacity-5"></i>
            <span class="nav-link-text ms-1">Perfil</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link text-dark" href="{{ route('logout') }}">
            <i class="fa-solid fa-right-from-bracket opacity-5"></i>
            <span class="nav-link-text ms-1">Cerrar Sesión</span>
          </a>
        </li>
      </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0 ">
      <div class="mx-3">
        <a class="btn btn-outline-dark mt-4 w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/overview/material-dashboard?ref=sidebarfree" type="button">Documentation</a>
      </div>
    </div>
  </aside>