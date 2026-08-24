@extends('layout.main')

@section('title', 'Voluntarios')

@section('content')

<div class="container mt-2 mb-2">
  <div class="ticker-container bg-gradient-dark border-radius-lg">
      <div class="ticker" id="currencyTicker">
          <span class="currency">Con fecha del {{ now()->toDateTimeString() }}</span>
          <span class="currency">USD <span class="text-success" id="usd"></span></span>
          <span class="currency">EUR <span class="text-success" id="eur"></span></span>
          <span class="currency">UF <span class="text-success" id="uf"></span></span>
          <span class="currency">UTM <span class="text-success" id="utm"></span></span>
          <span class="currency">IMACEC <span class="text-success" id="imacec"></span></span>
          <span class="currency">IPC <span class="text-success" id="ipc"></span></span>
      </div>
  </div>
</div>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-warehouse"></i> Administración de Inventario</h6>
              </div>
            </div>

            <div class="card-body p-4">
              <div class="row">
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                  <div class="card">
                    <div class="card-header p-2 ps-3">
                      <div class="d-flex justify-content-between">
                        <div>
                          <p class="text-sm mb-0 text-capitalize">Valor</p>
                          <h4 class="mb-0">$ <span id="totalCLPUF">0</span> CLP</h4>
                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow d-flex align-items-center justify-content-center border-radius-lg">
                          <p class="m-0" style="color: white">UF</p>
                        </div>
                      </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                      <input type="number" id="uf_input" class="form-control" placeholder="0 UF" oninput="calculateTotalCLPUF(this)">
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                  <div class="card">
                    <div class="card-header p-2 ps-3">
                      <div class="d-flex justify-content-between">
                        <div>
                          <p class="text-sm mb-0 text-capitalize">Valor</p>
                          <h4 class="mb-0">$ <span id="totalIVA">0</span> CLP</h4>
                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow d-flex align-items-center justify-content-center border-radius-lg">
                          <p class="m-0" style="color: white">IVA</p>
                        </div>
                      </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                      <input type="number" id="uf_input" class="form-control" placeholder="0 CLP" oninput="calculateIVA(this)">
                    </div>
                  </div>
                </div>
                <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
                  <div class="card">
                    <div class="card-header p-2 ps-3">
                      <div class="d-flex justify-content-between">
                        <div>
                          <p class="text-sm mb-0 text-capitalize">Valor</p>
                          <h4 class="mb-0">$ <span id="totalCLPUSD">0</span> CLP</h4>
                        </div>
                        <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow d-flex align-items-center justify-content-center border-radius-lg">
                          <p class="m-0" style="color: white">USD</p>
                        </div>
                      </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-2 ps-3">
                      <input type="number" id="uf_input" class="form-control" placeholder="0 USD" oninput="calculateTotalCLPUSD(this)">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-body p-4">
              <div class="w-100 p-2 mb-4">

                <table id="datatableInventories" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                  <thead class="bg-gradient-dark text-center">
                    <tr class="text-center">
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Codigo</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Imagen</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Stock</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Estado</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Acciones</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                  </tbody>
                  <tfoot  class="bg-gradient-dark text-center">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Codigo</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Imagen</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Stock</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Estado</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Acciones</th>
                    </tr>
                </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>

        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-arrow-right-arrow-left"></i> Movimientos del Stock</h6>
              </div>
            </div>
            <div class="card-body p-4">
              <div class="w-100 p-2 mb-4">
                <table id="datatableStockMovements" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                    <thead class="bg-gradient-dark text-center">
                    <tr class="text-center">
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Producto</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Bodega</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Cantidad</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Saldo</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Costo Unitario</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Costo Total</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Motivo / Referencia</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Responsable</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Fecha</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@include('module.inventario.reduce')
@include('module.inventario.create')
@include('module.inventario.category')
@include('module.inventario.warehouse')
@include('module.inventario.show')
@include('module.inventario.add')

@endsection

@push('script')

<script>
  // https://mindicador.cl/
  $(document).ready(function(){
      Warehouse();
      Category();

      $.getJSON('https://mindicador.cl/api', function(data) {
      var dailyIndicators = data;

      $("#utm").text(dailyIndicators.utm.valor);
      $("#uf").text(dailyIndicators.uf.valor);
      $("#usd").text(dailyIndicators.dolar.valor);
      $("#eur").text(dailyIndicators.euro.valor);
      $("#imacec").text(dailyIndicators.imacec.valor);
      $("#ipc").text(dailyIndicators.ipc.valor);
    }).fail(function() {
        console.log('Error al consumir la API!');
    });
  });
</script>

<script>
  function calculateTotalCLPUF(el){
    var uf = el.value;

    if(uf === ""){
      document.getElementById("totalCLPUF").textContent = "0";
      return;
    }

    fetch('https://mindicador.cl/api')
      .then(response => response.json())
      .then(data => {
        var totalCLPUF = data.uf.valor * uf;
        document.getElementById("totalCLPUF").textContent =
          totalCLPUF.toLocaleString("es-CL", { minimumFractionDigits: 0 });
      })
      .catch(() => console.log('Error al consumir la API!'));
  }

  function calculateIVA(el){
    var valueTotal = el.value;
    var iva = 19;

    if(valueTotal === ""){
      document.getElementById("totalIVA").textContent = "0";
      return;
    }

    var totalIVA = (valueTotal * iva)/100;
    document.getElementById("totalIVA").textContent =
    totalIVA.toLocaleString("es-CL", { minimumFractionDigits: 0 });
  }

  function calculateTotalCLPUSD(el){
    var uf = el.value;

    if(uf === ""){
      document.getElementById("totalCLPUSD").textContent = "0";
      return;
    }

    fetch('https://mindicador.cl/api')
      .then(response => response.json())
      .then(data => {
        var totalCLPUF = data.dolar.valor * uf;
        document.getElementById("totalCLPUSD").textContent =
          totalCLPUF.toLocaleString("es-CL", { minimumFractionDigits: 0 });
      })
      .catch(() => console.log('Error al consumir la API!'));
  }

</script>

<script>
    let scannerRunning = false;

    document.getElementById("startScanner").addEventListener("click", function () {
        const readerDiv = document.getElementById("reader");

        if (scannerRunning) return;

        readerDiv.style.display = "block";

        const html5QrCode = new Html5Qrcode("reader");

        html5QrCode.start(
            { facingMode: "environment" }, // cámara trasera
            {
                fps: 10,
                qrbox: 250
            },
            (decodedText, decodedResult) => {
                document.getElementById("barcode").value = decodedText;

                html5QrCode.stop().then(() => {
                    readerDiv.style.display = "none";
                    scannerRunning = false;
                }).catch(err => {
                    console.error("Error al detener escáner", err);
                });
            },
            (errorMessage) => {
                // Lectura fallida: se ignora
            }
        ).then(() => {
            scannerRunning = true;
        }).catch(err => {
            alert("Error al iniciar cámara: " + err);
            console.error(err);
        });
    });
</script>

<script>
    var datatableInventories;
    var datatableStockMovements;

    $(document).ready(function(){
      datatableInventories = $('#datatableInventories').DataTable({
      ajax: {
        url: '{{ route("inventario.data") }}',
        dataSrc: ''
      },
      columns: [
        { data: 'barcode', render: d => `<p class="text-xs text-secondary mb-0">${d}</p>` },
        { data: 'image', render: d => d ? `<img src="{{ asset('storage/') }}/${d}" alt="Imagen" width="40" height="40" onerror="this.src='{{ asset('assets/img/sinimagenproducto.png') }}'">` : '<img src="{{ asset('assets/img/sinimagenproducto.png') }}" alt="Sin imagen" width="40" height="40">' },
        { data: 'name', render: d => `<p class="text-xs text-secondary mb-0">${d}</p>` },
        { data: 'stock', render: d => `<p class="text-xs text-secondary mb-0">${d}</p>` },
        {
          data: 'status',
          render: d => d == '1'
            ? '<span class="badge bg-success">Disponible</span>'
            : '<span class="badge bg-danger">Deshabilitado</span>'
        },
        {
          data: null,
          orderable: false,
          searchable: false,
          render: d => `
            <a href="javascript:;" class="btn btn-dark text-white" onclick="addStock(${d.id})" data-bs-toggle="modal" data-bs-target="#AddStockModal">
              <i class="fa-solid fa-circle-plus"></i>
            </a>
            <a href="javascript:;" class="btn btn-dark text-white" onclick="reduceStock(${d.id})" data-bs-toggle="modal" data-bs-target="#ReduceStockModal">
              <i class="fa-solid fa-circle-minus"></i>
            </a>
            <a href="javascript:;" class="btn btn-dark text-white" onclick="showInventory(${d.id})" data-bs-toggle="modal" data-bs-target="#ShowModal">
              <i class="fa-solid fa-file-invoice-dollar"></i>
            </a>
            <a onclick="deleteInventory(${d.id})" class="btn btn-danger text-white">
              <i class="fa-solid fa-trash"></i>
            </a>
          `
        }
      ],
      buttons: [
        {
          text: '<i class="fa-solid fa-circle-plus"></i>',
          className: 'btn btn-dark text-white gap-2 me-2',
          action: () => $("#CreateModal").modal('show')
        },
        {
          extend: 'excelHtml5',
          text: '<i class="fa-solid fa-file-excel"></i>',
          className: 'btn btn-success me-2'
        },
        {
          extend: 'print',
          text: '<i class="fa-solid fa-print"></i>',
          className: 'btn btn-primary me-2'
        },
        {
          extend: 'csvHtml5',
          text: '<i class="fa-solid fa-file-csv"></i>',
          className: 'btn btn-success me-2'
        },
        {
          extend: 'pdfHtml5',
          text: '<i class="fa-solid fa-file-pdf"></i>',
          className: 'btn btn-danger me-2'
        }
      ],
      language: {
        decimal: "",
        emptyTable: "No hay información",
        info: "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        infoEmpty: "Mostrando 0 to 0 of 0 Entradas",
        infoFiltered: "(Filtrado de _MAX_ total entradas)",
        thousands: ",",
        lengthMenu: "Mostrar _MENU_ Entradas",
        loadingRecords: "Cargando...",
        processing: "Procesando...",
        search: "<i class='fa-solid fa-magnifying-glass'></i>",
        zeroRecords: "Sin resultados encontrados",
        paginate: {
          first: "Primero",
          last: "Último",
          next: "Siguiente",
          previous: "Anterior"
        }
      },
      dom:
        "<'row mb-2'<'col-md-6 d-flex align-items-center'B><'col-md-6'f>>" +
        "<'row'<'col-12'tr>>" +
        "<'row mt-2'<'col-md-6'i><'col-md-6'p>>",
      responsive: {
        details: {
          type: 'inline'
        }
      },
      order: [[1, 'asc']],
      rowGroup: {
        dataSrc: 'category_name',
        startRender: function(rows, group) {
          return $('<tr/>')
            .addClass('group-header bg-dark')
            .append(`<td colspan="12" class="ps-2 text-white" style="font-size: 12px">${group} (Cantidad ${rows.count()})</td>`);
        }
      }
    });

      datatableStockMovements = $('#datatableStockMovements').DataTable({
        ajax: {
          url: '{{ route("inventario.stock_movements") }}',
          dataSrc: ''
        },
        columns: [
          { data: 'product_name',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'warehouse_name', defaultContent: '—', render: data => '<p class="text-xs text-secondary mb-0">'+(data || '—')+'</p>' },
          { data: 'quantity',
            render: function(data, type, row){
              let color = row.type === 'add' ? 'text-success' : 'text-danger';
              let negative = row.type === 'add' ? '' : '-';
              return data = '<p class="text-xs '+color+' mb-0">'+negative+data+'</p>'
            }
          },
          { data: 'balance_after', defaultContent: null, render: (data, type, row) => '<p class="text-xs text-secondary mb-0">'+(data === null ? 'Histórico' : row.balance_before+' → '+data)+'</p>' },
          { data: 'unit_cost',
            render: function(data, type, row){
              let color = row.type === 'add' ? 'text-success' : 'text-danger';
              let negative = row.type === 'add' ? '' : '-';
              return data = '<p class="text-xs '+color+' mb-0">'+negative+'$'+Intl.NumberFormat('es-CL').format(data)+'</p>'
            }
          },
          { data: null,
            render: function(data, type, row){
              let color = row.type === 'add' ? 'text-success' : 'text-danger';
              let negative = row.type === 'add' ? '' : '-';
              var total = data.unit_cost > 0 ? (data.unit_cost*data.quantity) : 0;
              return data = '<p class="text-xs '+color+' mb-0">'+negative+'$'+Intl.NumberFormat('es-CL').format(total)+'</p>'
            }
          },
          { data: 'reason', defaultContent: '—', render: (data, type, row) => '<p class="text-xs text-secondary mb-0">'+(data || '—')+(row.reference ? '<br><small>Ref. '+row.reference+'</small>' : '')+'</p>' },
          { data: 'user_name',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'occurred_at',
            render:  function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+moment(data).format('DD-MM-YYYY HH:mm')+'</p>'
            }
          }
        ],
        buttons: [
                {
                  extend: 'excelHtml5',
                  text: '<i class="fa-solid fa-file-excel"></i>',
                  className: 'btn btn-success me-2'
                },
                {
                  extend: 'print',
                  text: '<i class="fa-solid fa-print"></i>',
                  className: 'btn btn-primary me-2'
                },
                {
                  extend: 'csvHtml5',
                  text: '<i class="fa-solid fa-file-csv"></i>',
                  className: 'btn btn-success me-2'
                },
                {
                  extend: 'pdfHtml5',
                  text: '<i class="fa-solid fa-file-pdf"></i>',
                  className: 'btn btn-danger me-2'
                }
              ],
        language: {
                "decimal": "",
                "emptyTable": "No hay información",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                "infoPostFix": "",
                "thousands": ",",
                "lengthMenu": "Mostrar _MENU_ Entradas",
                "loadingRecords": "Cargando...",
                "processing": "Procesando...",
                "search": "<i class='fa-solid fa-magnifying-glass'></i>",
                "zeroRecords": "Sin resultados encontrados",
                "paginate": {
                    "first": "Primero",
                    "last": "Ultimo",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
        },
        dom:
            "<'row mb-2'<'col-md-6 d-flex align-items-center'B><'col-md-6'f>>" +
            "<'row'<'col-12'tr>>" +
            "<'row mt-2'<'col-md-6'i><'col-md-6'p>>",
        responsive:{
          details:{
            type: 'inline'
          }
        }
      });
    });

    function showInventory(id){
        $.ajax({
            url: 'inventario/show/'+id,
            type: 'GET',
            success: function(response){
                $('#ShowModal').modal('show');
                $('#fullname_title_show').text(response[0].name);
                $('#brand_show').text(response[0].brand);
                $('#stock_show').text(response[0].stock > 0 ? response[0].stock : 'Agotado');

                $('#category_show').text(response[0].category_name);
                $('#description_category_show').text(response[0].category_description);

                $('#warehouse_show').text(response[0].warehouse_name);
                $('#description_warehouse_show').text(response[0].warehouse_description);
                $('#status_warehouse_show').text(response[0].warehouse_status == '1' ? 'Activo' : 'Inactivo');
                $('#path_warehouse_show').text(response[0].warehouse_path);
            },
            error: function(error){
                Swal.fire({
                    icon: 'error',
                    title: 'Error.',
                    text: 'Error al mostrar inventario' + error.responseJSON.message,
                });
            }
        })
    }

    $('#formInventario').submit(function(e){
      e.preventDefault();
      let formData = new FormData(this);
      $.ajax({
        url: '{{ route("inventario.store") }}',
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Inventario registrado correctamente',
          });
          $('#formInventario')[0].reset();
          $('#CreateModal').modal('hide');
          datatableInventories.ajax.reload();
          datatableStockMovements.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al registrar inventario por: ' + error.responseJSON.message,
          });
          $('#CreateModal').modal('hide');
        }
      })
    })

    $('#formCategory').submit(function(e){
            e.preventDefault();
            $.ajax({
                url: '/inventario/category',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response){
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito.',
                        text: 'Categoría registrada correctamente',
                    });
                    $('#CreateCategoryModal').modal('hide');
                    $('#formCategory')[0].reset();
                    Category();
                },
                error: function(error){
                    Swal.fire({
                        icon: 'error',
                        title: 'Error.',
                        text: 'Error al registrar categoría',
                    });
                    $('#CreateCategoryModal').modal('hide');
                }
            });
    });

    $('#formWarehouse').submit(function(e){
        e.preventDefault();
        $.ajax({
            url: '/inventario/warehouse',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response){
            Swal.fire({
                icon: 'success',
                title: 'Exito.',
                text: 'Bodega registrado correctamente',
            });
            $('#CreateWarehouseModal').modal('hide');
            $('#formWarehouse')[0].reset();
            Warehouse();
            },
            error: function(error){
            Swal.fire({
                icon: 'error',
                title: 'Error.',
                text: 'Error al registrar bodega',
            });
            $('#CreateWarehouseModal').modal('hide');
            }
        })
    })

    function deleteInventory(id){
      Swal.fire({
              title: "¿Estas seguro de eliminar el producto?",
              text: "No podrás revertir esto!",
              icon: "warning",
              showCancelButton: true,
              confirmButtonColor: "#3085d6",
              cancelButtonColor: "#d33",
              confirmButtonText: "Si, eliminarlo!",
              input: 'password',
              inputPlaceholder: 'Contraseña Oculta',
              inputValidator: (value) => {
                if (value === "contraseñaOculta") {
                  $.ajax({
                    url: 'inventario/destroy/'+id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response){
                            Swal.fire({
                                icon: 'success',
                                title: 'Exito.',
                                text: 'Producto eliminado correctamente',
                            });
                            datatableInventories.ajax.reload();
                        },
                        error: function(error){
                            Swal.fire({
                                icon: 'error',
                                title: 'Error.',
                                text: 'Error al eliminar producto',
                            });
                        }
                    });
                } else {
                  return "La contraseña no es correcta";
                }
              }
            });
    }

    function addStock(id){
      $('#product_id_show').val(id);
      $('#AddStockModal').modal('show');
    }

    $('#formAddStock').submit(function(e){
      e.preventDefault();
      $.ajax({
        url: 'inventario/add_stock',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Stock agregado correctamente',
          });
          $('#formAddStock')[0].reset();
          $('#AddStockModal').modal('hide');
          datatableInventories.ajax.reload();
          datatableStockMovements.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al agregar stock ' + error.responseJSON.message,
          });
          $('#AddStockModal').modal('hide');
        }
      })
    })

    function reduceStock(id){
      $('#product_id_reduce').val(id);
      $('#ReduceStockModal').modal('show');
    }

    $('#formReduceStock').submit(function(e){
      e.preventDefault();
      $.ajax({
        url: 'inventario/reduce_stock',
        type: 'POST',
        data: $(this).serialize(),
        success: function(response){
          Swal.fire({
            icon: 'success',
            title: 'Exito.',
            text: 'Stock reducido correctamente',
          });
          $('#formReduceStock')[0].reset();
          $('#ReduceStockModal').modal('hide');
          datatableInventories.ajax.reload();
          datatableStockMovements.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al reducir stock: ' + error.responseJSON.message,
          });
          $('#ReduceStockModal').modal('hide');
        }
      })
    })

    function Warehouse(){
      $.ajax({
        url: 'inventario/warehouse/data',
        type: 'GET',
        success: function(response){
          var responseWarehouse = '';
          responseWarehouse += '<option selected disabled>Seleccione la Bodega</option>';
          response.map(item => {
            responseWarehouse += '<option value="' + item.id + '">' + item.name + '</option>';
          })

          $('#id_warehouse').html(responseWarehouse);
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al obtener bodegas',
          });
        }
      })
    }

    function Category(){
      $.ajax({
        url: 'inventario/category/data',
        type: 'GET',
        success: function(response){
          var responseCategory = '';
          responseCategory += '<option selected disabled>Seleccione la Categoria</option>';
          response.map(item => {
            responseCategory += '<option value="' + item.id + '">' + item.name + '</option>';
          })

          $('#id_category').html(responseCategory);
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al obtener categorías',
          });
        }
      })
    }
</script>

@endpush
