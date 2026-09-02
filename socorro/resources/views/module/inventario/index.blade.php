@extends('layout.main')

@section('title', 'Inventario')

@push('styles')
<style>
.inventory-page-header{display:flex;align-items:center;justify-content:space-between;gap:1.5rem;padding:1.4rem 1.5rem;border-radius:1rem;color:#fff;background:linear-gradient(125deg,#212529,#455a64);box-shadow:0 12px 30px rgba(20,30,40,.18)}.inventory-page-header h1{margin:0;color:#fff;font-size:1.75rem}.inventory-page-header p{margin:.25rem 0 0;color:rgba(255,255,255,.68)}.inventory-stat{height:100%;padding:1.05rem;background:#fff;border:1px solid rgba(38,50,56,.08);border-radius:.85rem;box-shadow:0 8px 22px rgba(20,30,40,.06)}.inventory-stat>span{display:grid;place-items:center;width:2.35rem;height:2.35rem;border-radius:.65rem;background:#263238;color:#fff}.inventory-stat small{display:block;margin-top:.65rem;color:#78909c;font-weight:700}.inventory-stat strong{display:block;color:#263238;font-size:1.65rem;line-height:1.15}.inventory-stat p{margin:.25rem 0 0;color:#90a4ae;font-size:.72rem}.inventory-panel{border:0!important;border-radius:.95rem!important;box-shadow:0 8px 24px rgba(20,30,40,.07)!important;overflow:hidden}.inventory-panel-heading{display:flex;align-items:center;justify-content:space-between;padding:1.25rem 1.5rem}.inventory-panel-heading span{color:#EA4E1A;font-size:.68rem;font-weight:800;text-transform:uppercase;letter-spacing:.07em}.inventory-panel-heading h2{margin:.12rem 0;color:#263238;font-size:1.05rem;font-weight:800}.inventory-panel-heading p{margin:0;color:#78909c;font-size:.78rem}.inventory-panel-heading>i{display:grid;place-items:center;width:2.7rem;height:2.7rem;border-radius:.7rem;background:#edf2f4;color:#455a64}.inventory-panel table thead,.inventory-panel table tfoot{background:#263238!important}.inventory-panel .dataTables_filter input{border:1px solid #dce3e7;border-radius:.6rem;padding:.45rem .7rem}.inventory-panel .dt-buttons .btn{border-radius:.55rem}.inventory-panel table tbody td{vertical-align:middle}.inventory-panel table tbody img{border-radius:.55rem;object-fit:cover}.inventory-panel .group-header td{background:#455a64!important}.inventory-panel .pagination .page-link{border-radius:.4rem!important;margin:0 .1rem}@media(max-width:767.98px){.inventory-page-header{align-items:flex-start;flex-direction:column;padding:1.1rem}.inventory-page-header .btn{flex:1}.inventory-stat strong{font-size:1.4rem}.inventory-panel-heading{padding:1rem}.inventory-panel .card-body{padding:1rem!important}}
</style>
@endpush

@section('content')

<div class="inventory-page-header mb-4">
  <div><span class="badge bg-warning text-dark mb-2">Logística institucional</span><h1>Inventario y bodegas</h1><p>Controla existencias, ubicaciones y movimientos con trazabilidad completa.</p></div>
  <div class="d-flex flex-wrap gap-2">
    <a class="btn btn-outline-light mb-0" href="{{ route('inventario.movements') }}"><i class="fa-solid fa-clock-rotate-left me-2"></i>Historial</a>
    <button class="btn btn-outline-light mb-0" data-bs-toggle="modal" data-bs-target="#CreateCategoryModal"><i class="fa-solid fa-tags me-2"></i>Nueva categoría</button>
    <button class="btn btn-outline-light mb-0" data-bs-toggle="modal" data-bs-target="#CreateWarehouseModal"><i class="fa-solid fa-warehouse me-2"></i>Nueva bodega</button>
    <button class="btn btn-warning mb-0" data-bs-toggle="modal" data-bs-target="#CreateModal"><i class="fa-solid fa-plus me-2"></i>Nuevo producto</button>
  </div>
</div>

<div class="row g-3 mb-4">
  @foreach([
    ['boxes-stacked','Productos',$inventorySummary['products'],'Referencias registradas'],
    ['cubes-stacked','Unidades',$inventorySummary['units'],'Existencias disponibles'],
    ['triangle-exclamation','Stock bajo',$inventorySummary['low_stock'],'Entre 1 y 5 unidades'],
    ['circle-xmark','Agotados',$inventorySummary['out_of_stock'],'Requieren reposición'],
    ['warehouse','Bodegas activas',$inventorySummary['warehouses'],'Ubicaciones operativas'],
  ] as [$icon,$label,$value,$copy])
  <div class="col-6 col-lg"><div class="inventory-stat"><span><i class="fa-solid fa-{{ $icon }}"></i></span><small>{{ $label }}</small><strong>{{ number_format($value,0,',','.') }}</strong><p>{{ $copy }}</p></div></div>
  @endforeach
</div>

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
          <div class="card inventory-panel my-3">
            <div class="inventory-panel-heading"><div><span>Catálogo</span><h2>Productos y existencias</h2><p>Consulta el stock y registra entradas o salidas desde las acciones de cada producto.</p></div><i class="fa-solid fa-boxes-stacked"></i></div>
            <div class="card-body p-4 pt-2">
              <div class="w-100 p-2 mb-4">

                <table id="datatableInventories" class="table table-hover align-middle dt-responsive nowrap" style="width: 100%;">
                  <thead class="bg-gradient-dark text-center">
                    <tr class="text-center">
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Código</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Imagen</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Categoría</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Bodega</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Stock</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Estado</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Acciones</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                  </tbody>
                  <tfoot  class="bg-gradient-dark text-center">
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Código</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Imagen</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Categoría</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Bodega</th>
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

<script>$(document).ready(function(){ Warehouse(); Category(); });</script>

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
        { data: 'category_name', render: d => `<span class="badge bg-light text-dark border">${d || 'Sin categoría'}</span>` },
        { data: 'warehouse_name', render: d => `<p class="text-xs text-secondary mb-0"><i class="fa-solid fa-warehouse me-1"></i>${d || 'Sin bodega'}</p>` },
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
            <a href="javascript:;" class="btn btn-success text-white" onclick="addStock(${d.id})" data-bs-toggle="modal" data-bs-target="#AddStockModal" title="Ingresar existencias">
              <i class="fa-solid fa-circle-plus"></i>
            </a>
            <a href="javascript:;" class="btn btn-warning text-dark" onclick="reduceStock(${d.id})" data-bs-toggle="modal" data-bs-target="#ReduceStockModal" title="Registrar salida">
              <i class="fa-solid fa-circle-minus"></i>
            </a>
            <a href="javascript:;" class="btn btn-info text-white" onclick="showInventory(${d.id})" data-bs-toggle="modal" data-bs-target="#ShowModal" title="Ver ficha del producto">
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

      if ($('#datatableStockMovements').length) {
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
      }
    });

    function showInventory(id){
        $.ajax({
            url: 'inventario/show/'+id,
            type: 'GET',
            success: function(response){
                $('#ShowModal').modal('show');
                $('#fullname_title_show').text(response[0].name);
                $('#brand_show').text(response[0].brand);
                $('#barcode_show').text(response[0].barcode || 'SIN CÓDIGO');
                $('#description_product_show').text(response[0].description || 'Sin descripción registrada.');
                $('#colour_show').text(response[0].colour || 'Sin color');
                $('#size_show').text(response[0].size || 'Sin talla');
                $('#stock_show').text(response[0].stock);
                $('#product_status_show').text(response[0].stock > 0 ? 'Disponible' : 'Agotado');
                $('#inventory_image_show').attr('src', response[0].image ? '{{ asset('storage') }}/' + response[0].image : '{{ asset('assets/img/sinimagenproducto.png') }}');

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
          if (datatableStockMovements) datatableStockMovements.ajax.reload();
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

    function loadStockProduct(id, mode){
      $('#' + mode + '_stock_product_name').text('Cargando…');
      $('#' + mode + '_stock_current').text('—');
      $('#' + mode + '_stock_warehouse').text('—');
      $.ajax({
        url: 'inventario/show/' + id,
        type: 'GET',
        success: function(response){
          const product = response[0];
          if (!product) return;
          $('#' + mode + '_stock_product_name').text(product.name || 'Producto');
          $('#' + mode + '_stock_current').text(product.stock || 0);
          $('#' + mode + '_stock_warehouse').text(product.warehouse_name || 'Sin bodega');
          if (mode === 'reduce') $('#reduce_quantity').attr('max', product.stock).val('');
          if (mode === 'add') $('#add_quantity').val('');
          updateStockPreview(mode);
        }
      });
    }

    function updateStockPreview(mode){
      const current = parseInt($('#' + mode + '_stock_current').text(), 10) || 0;
      const quantity = parseInt($('#' + mode + '_quantity').val(), 10) || 0;
      const result = mode === 'add' ? current + quantity : Math.max(0, current - quantity);
      $('#' + mode + '_stock_result').text(result);
    }

    function addStock(id){
      $('#product_id_show').val(id);
      loadStockProduct(id, 'add');
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
          if (datatableStockMovements) datatableStockMovements.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al agregar stock ' + error.responseJSON.message,
          });
        }
      })
    })

    function reduceStock(id){
      $('#product_id_reduce').val(id);
      loadStockProduct(id, 'reduce');
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
        }
      })
    })

    $(document).on('input', '#add_quantity', function(){ updateStockPreview('add'); });
    $(document).on('input', '#reduce_quantity', function(){ updateStockPreview('reduce'); });
    $(document).on('click', '.inventory-step', function(){
      const input = document.getElementById($(this).data('target'));
      if (!input) return;
      const step = parseInt($(this).data('step'), 10);
      const min = parseInt(input.min || '1', 10);
      const max = input.max ? parseInt(input.max, 10) : Number.MAX_SAFE_INTEGER;
      const current = parseInt(input.value || '0', 10);
      input.value = Math.min(max, Math.max(min, current + step));
      $(input).trigger('input');
    });

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
