@extends('layout.main')

@section('title', 'Voluntarios')

@section('content')

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
              <div class="w-100 p-2 mb-4">
                
                <table id="datatableInventories" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                  <thead class="bg-gradient-dark text-center">
                    <tr class="text-center">
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Codigo</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Stock</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Costo Unitario</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Costo Total</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">IVA</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Estado</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Acciones</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">

                  </tbody>
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
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Cantidad</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Costo Unitario</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Costo Total</th>
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

@include('module.inventario.create')
@include('module.inventario.category')
@include('module.inventario.warehouse')
@include('module.inventario.show')
@include('module.inventario.add')
@include('module.inventario.reduce')

@endsection

@push('script')

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
        { data: 'name', render: d => `<p class="text-xs text-secondary mb-0">${d}</p>` },
        { data: 'stock', render: d => `<p class="text-xs text-secondary mb-0">${d}</p>` },
        {
          data: null,
          render: d => {
            const unitary = d.stock > 0 ? d.total / d.stock : 0;
            return `<p class="text-xs text-secondary mb-0 text-success">$${Intl.NumberFormat('es-CL').format(unitary)}</p>`;
          }
        },
        {
          data: 'total',
          render: d => `<p class="text-xs text-secondary mb-0 text-success">$${Intl.NumberFormat('es-CL').format(d)}</p>`
        },
        {
          data: null,
          render: d => {
            const tax = d.stock > 0 ? (d.total * 19) / 100 : 0;
            return `<p class="text-xs text-secondary mb-0 text-success">$${Intl.NumberFormat('es-CL').format(tax)}</p>`;
          }
        },
        {
          data: 'status',
          render: d => d == '1'
            ? '<span class="badge bg-success">Disponible</span>'
            : '<span class="badge bg-danger">Agotado</span>'
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
          text: '<i class="fa-solid fa-warehouse"></i>',
          className: 'btn btn-dark text-white gap-2 me-2',
          action: () => $("#CreateWarehouseModal").modal('show')
        },
        {
          text: '<i class="fa-solid fa-table-list"></i>',
          className: 'btn btn-dark text-white gap-2 me-2',
          action: () => $("#CreateCategoryModal").modal('show')
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
        search: "Buscar:",
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
      order: [[6, 'asc']], 
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
          { data: 'quantity',
            render: function(data, type, row){
              let color = row.type === 'add' ? 'text-success' : 'text-danger';
              let negative = row.type === 'add' ? '' : '-';
              return data = '<p class="text-xs '+color+' mb-0">'+negative+data+'</p>'
            }
          },
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
          { data: 'user_name',
            render: function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
            }
          },
          { data: 'created_at',
            render:  function(data){
              return data = '<p class="text-xs text-secondary mb-0">'+moment(data).format('DD-MM-YYYY')+'</p>'
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
                "search": "Buscar:",
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
                $('#total_show').text(response[0].total.toLocaleString('es-CL', {style: 'currency', currency: 'CLP'}));

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
                    text: 'Error al mostrar inventario',
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
          $('#CreateModal').modal('hide');
          datatableInventories.ajax.reload();
          datatableStockMovements.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al registrar inventario',
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
          $('#AddStockModal').modal('hide');
          datatableInventories.ajax.reload();
          datatableStockMovements.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al agregar stock',
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
          $('#ReduceStockModal').modal('hide');
          datatableInventories.ajax.reload();
          datatableStockMovements.ajax.reload();
        },
        error: function(error){
          Swal.fire({
            icon: 'error',
            title: 'Error.',
            text: 'Error al reducir stock',
          });
          $('#ReduceStockModal').modal('hide');
        }
      })
    })
</script>

@endpush