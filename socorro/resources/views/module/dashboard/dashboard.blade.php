  @extends('layout.main')

  @section('title', 'Dashboard')

  @section('content')
    <div class="container-fluid py-2">
      <div class="row">
        <div class="ms-3">
            <div class="col-12">
                <h3>
                    Bievenido al sistema de centralización de información del CSA.
                </h3>

                <div class="card">
                    <div class="card-header">
                        Favor jamas hacer uso de información confidencial fuera de la institución.
                    </div>
                    <div class="card-footer">
                        <p>Esta información es confidencial y solo accesible para miembros autorizados del CSA.</p>
                    </div>
                </div>
            </div>
        <!--
          <h3 class="mb-0 h4 font-weight-bolder text-white">Analitica del CSA</h3>
          <p class="mb-4">
            Datos primordiales a conocer.
          </p>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-capitalize">Activo Inventario </p>
                  <h4 class="mb-0">$ {{ number_format($add->total ?? 0, 0, ',', '.') }} </h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                  <i class="fa-solid fa-wallet"></i>
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
              <p class="mb-0 text-sm">General</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-capitalize">Voluntarios Activos</p>
                  <h4 class="mb-0">{{ $cant_voluntaries }}</h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                  <i class="fa-solid fa-people-group"></i>
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
              <p class="mb-0 text-sm">Activos Totales</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-capitalize">Voluntarios Impagos</p>
                  <h4 class="mb-0">{{ $cant_voluntaries_no_payment }}</h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                  <i class="fa-solid fa-lock"></i>
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
              <p class="mb-0 text-sm">Sin pago de cuota</p>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-header p-2 ps-3">
              <div class="d-flex justify-content-between">
                <div>
                  <p class="text-sm mb-0 text-capitalize">Sales</p>
                  <h4 class="mb-0">$103,430</h4>
                </div>
                <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                  <i class="material-symbols-rounded opacity-10">weekend</i>
                </div>
              </div>
            </div>
            <hr class="dark horizontal my-0">
            <div class="card-footer p-2 ps-3">
              <p class="mb-0 text-sm"><span class="text-success font-weight-bolder">+5% </span>than yesterday</p>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card">
            <div class="card-body">
              <h6 class="mb-0 "><i class="fa-solid fa-people-group"></i> Voluntarios por Delegación</h6>
              <p class="text-sm ">No aparecen los inactivos aquí</p>
              <div class="pe-2">
                <div class="chart">
                  <canvas id="chart" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm"> campaign sent 2 days ago </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6 mt-4 mb-4">
          <div class="card ">
            <div class="card-body">
              <h6 class="mb-0 "> Daily Sales </h6>
              <p class="text-sm "> (<span class="font-weight-bolder">+15%</span>) increase in today sales. </p>
              <div class="pe-2">
                <div class="chart">
                  <canvas id="chart-line" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm"> updated 4 min ago </p>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 mt-4 mb-3">
          <div class="card">
            <div class="card-body">
              <h6 class="mb-0 ">Completed Tasks</h6>
              <p class="text-sm ">Last Campaign Performance</p>
              <div class="pe-2">
                <div class="chart">
                  <canvas id="chart-line-tasks" class="chart-canvas" height="170"></canvas>
                </div>
              </div>
              <hr class="dark horizontal">
              <div class="d-flex ">
                <i class="material-symbols-rounded text-sm my-auto me-1">schedule</i>
                <p class="mb-0 text-sm">just updated</p>
              </div>
            </div>
          </div>
        </div> -->
      </div>
    </div>
  @endsection

  @push('script')
    <script>
      $(document).ready(function(){
        const data = {
          labels: @json($data->pluck('delegation_name')),
          datasets: [{
              label: 'Voluntarios por delegación',
              backgroundColor: 'rgba(255, 99, 132, 0.3)',
              borderColor: 'rgb(255, 99, 132)',
              data: @json($data->pluck('aggregate')),
          }]
        };
        const config = {
            type: 'bar',
            data: data
        };
        const myChart = new Chart(
            document.getElementById('chart'),
            config
        );
      })
    </script>
  @endpush
