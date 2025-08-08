<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title')</title>

  <!-- Favicon e íconos -->
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" crossorigin="anonymous" />

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,900" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded" />

  <!-- Material Dashboard -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
  <link id="pagestyle" href="../assets/css/material-dashboard.css?v=3.2.0" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/css/bootstrap.min.css" rel="stylesheet">
  <!-- DataTables + Responsive + Buttons -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/rowgroup/1.4.1/css/rowGroup.dataTables.min.css">
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.18/index.global.min.js'></script>

  <style>
      body{
        font-family: 'Inter', sans-serif;
      }

      body {
        background: #ededed;
        background: linear-gradient(90deg, rgba(237, 237, 237, 1) 0%, rgba(247, 134, 134, 1) 0%, rgba(252, 176, 69, 1) 100%);         
        min-height: 100vh;
        width: 100%;
        justify-content: center;
        align-items: center;
      }
      
  </style>
  @stack('styles')
</head>

<body class="g-sidenav-show">
  @include('shared.aside')

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg text-white">
    @include('shared.header')

    <div class="container-fluid py-2 ">
      @yield('content')
    </div>

    @include('shared.footer')
  </main>

  @include('shared.config_user')

  <!-- JS Libs -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/chartjs.min.js"></script>

  <!-- DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/rowgroup/1.4.1/js/dataTables.rowGroup.min.js"></script>

  <!-- SweetAlert -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Material Dashboard -->
  <script src="../assets/js/material-dashboard.min.js?v=3.2.0"></script>

  <!-- html5-qrcode -->
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

  <!-- filer select -->
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <!-- Scrollbar para Windows -->
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), { damping: '0.5' });
    }
  </script>

  <!-- Notificaciones -->
  @if(session('success'))
    <script>
      Swal.fire({ icon: 'success', title: 'Éxito', text: '{{ session('success') }}' });
    </script>
  @endif

  @if(session('error'))
    <script>
      Swal.fire({ icon: 'error', title: 'Error', text: '{{ session('error') }}' });
    </script>
  @endif

  <style>
    .modal-backdrop {
      z-index: 1050 !important;
    }
    .modal {
      z-index: 1060 !important;
    }
    .sidenav {
      z-index: 1038 !important;
    }
  </style>

  <!-- Scripts de cada vista -->
  @stack('script')

  <!-- Scripts para activar select2 -->
  <script>
    $(document).ready(function() {
      // Inicializar select2 con configuración para modales
      $('.select2').each(function() {
        $(this).select2({
          placeholder: 'Seleccione',
          allowClear: true,
          width: '100%',
          dropdownParent: $(this).closest('.modal').length ? $(this).closest('.modal') : $(document.body),
          language: {
            noResults: function () {
              return "No hay resultados";
            }
          },
          dropdownAutoWidth: true,
          dropdownCssClass: 'select2-dropdown-modal'
        });
      });

      // Agregar estilos de form-select de Bootstrap
      $('.select2').addClass('form-select p-2');
    });
  </script>
  <style>
    /* Asegurar que el dropdown de select2 esté por encima del modal */
    .select2-container--open {
      z-index: 1070 !important;
    }
    .select2-dropdown {
      z-index: 1061 !important;
    }
    .select2-container {
      z-index: 1000 !important;
    }

    .select2-selection{
      border: none !important;
    }

    .select2-selection--single{
      border: none !important;
    }

    .select2-selection--clearable {
      border: none !important;
    }
  </style>
</body>
</html>
