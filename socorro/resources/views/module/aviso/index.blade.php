@extends('layout.main')

@section('title', 'Usuarios')

@section('content')

<div class="container-fluid py-2">
    <div class="row">
        <div class="col-12">
          <div class="card my-4">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
              <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-user-tie"></i> Administración de Avisos de Salidas.</h6>
              </div>
            </div>
            <div class="card-body p-4">

            <div class="row">
                <div class="col-md-6 col-lg-6 col-sm-12 mb-2">
                    <h6 class=" text-capitalize ps-3 text-dark"><i class="fa-solid fa-map-location-dot"></i> Mapas</h6>
                    <ul class="list-group list-group-flush border">
                        <li class="list-group-item">Google Earth <a href="https://earth.google.com/" target="_blank" class="badge bg-gradient-dark float-end"><i class="fa-solid fa-link"></i></a></li>
                        <li class="list-group-item">Maps.me <a href="https://www.maps.me/" target="_blank" class="badge bg-gradient-dark float-end"><i class="fa-solid fa-link"></i></a></li>
                        <li class="list-group-item">Gaia GPS <a href="https://gaia.gps.com/" target="_blank" class="badge bg-gradient-dark float-end"><i class="fa-solid fa-link"></i></a></li>
                        <li class="list-group-item">Suda Outdoor <a href="https://www.sudaoutdoor.com/" target="_blank" class="badge bg-gradient-dark float-end"><i class="fa-solid fa-link"></i></a></li>
                        <li class="list-group-item">Wikiloc <a href="https://www.wikiloc.com/" target="_blank" class="badge bg-gradient-dark float-end"><i class="fa-solid fa-link"></i></a></li>
                      </ul>
                </div>
                <div class="col-md-6 col-lg-6 col-sm-12">
                    <h6 class=" text-capitalize ps-3 text-dark"><i class="fa-solid fa-poo-storm"></i> Meteorologia</h6>
                    <ul class="list-group list-group-flush border">
                        <li class="list-group-item">Mountain Forecast<a href="https://mountainforecast.com/" target="_blank" class="badge bg-gradient-dark float-end"><i class="fa-solid fa-link"></i></a></li>
                        <li class="list-group-item">Windy<a href="https://windy.com/" target="_blank" class="badge bg-gradient-dark float-end"><i class="fa-solid fa-link"></i></a></li>
                        <li class="list-group-item">AccuWeather<a href="https://www.accuweather.com/" target="_blank" class="badge bg-gradient-dark float-end"><i class="fa-solid fa-link"></i></a></li>
                        <li class="list-group-item">MeteoRed<a href="https://www.meteored.com/" target="_blank" class="badge bg-gradient-dark float-end"><i class="fa-solid fa-link"></i></a></li>
                        <li class="list-group-item">MeteoBlue<a href="https://www.meteoblue.com/" target="_blank" class="badge bg-gradient-dark float-end"><i class="fa-solid fa-link"></i></a></li>
                      </ul>
                </div>
            </div>
            <br>
            <hr>
            <br>
            <p>Lista de salidas, aquí puedes visualizar todas las salidas que han sido registradas. Si esta activo, es porque aun el deportista aún no da aviso de salida.</p>
              <div class="w-100 p-2 mb-4">
                <table id="datatableAviso" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                  <thead class="bg-gradient-dark text-center">
                    <tr class="text-center">
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombre</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Región</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Destino</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Numero de participantes</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Fecha de ida</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Fecha de vuelta</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Estado</th>
                      <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Acciones</th>
                    </tr>
                  </thead>
                  <tbody class="text-center">
                  </tbody>
                </table>
              </div>
              <!-- Modal único para mostrar el mensaje -->
              <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="messageModalLabel">Mensaje</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <!-- El contenido se inyectará dinámicamente -->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>

@include('module.usuario.create')
@include('module.usuario.edit')

@endsection

@push('script')
    <script>
          var datatableAviso;
          var disabled_aperture = '';

          $(document).ready(function(){
            datatableAviso = $('#datatableAviso').DataTable({
              ajax: {
                url: '{{ route("aviso.data") }}',
                dataSrc: ''
              },
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
              responsive: {
                details: {
                  type: 'inline'
                }
              },
              order: [[5, 'desc']], // Ordena por columna 5 (fecha de ida) en orden descendente
              dom:
                "<'row mb-2'<'col-md-6 d-flex align-items-center'B><'col-md-6'f>>" +
                "<'row'<'col-12'tr>>" +
                "<'row mt-2'<'col-md-6'i><'col-md-6'p>>",
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
              columns: [
                { data: null,
                render: function(data, type, row) {
                    return data = '<p class="text-xs text-secondary mb-0">'+row.name+' ' +row.lastname+'</p>'
                }
                },
                { data: 'region' ,
                render:function(data){

                    switch(data){
                        case 1:
                            return data = '<p class="text-xs text-secondary mb-0">Región de Arica</p>'
                        case 2:
                            return data = '<p class="text-xs text-secondary mb-0">Región de Parinacota</p>'
                        case 3:
                            return data = '<p class="text-xs text-secondary mb-0">Región de Tarapacá</p>'
                        case 4:
                            return data = '<p class="text-xs text-secondary mb-0">Región de Antofagasta</p>'
                        case 5:
                            return data = '<p class="text-xs text-secondary mb-0">Región de Atacama</p>'
                        case 6:
                            return data = '<p class="text-xs text-secondary mb-0">Región de Coquimbo</p>'
                        case 7:
                            return data = '<p class="text-xs text-secondary mb-0">Región de Valparaíso</p>'
                        case 8:
                            return data = '<p class="text-xs text-secondary mb-0">Región de Metropolitana</p>'
                        case 9:
                            return data = '<p class="text-xs text-secondary mb-0">Región de OHiggins</p>'
                        case 10:
                            return data = '<p class="text-xs text-secondary mb-0">Región de Maule</p>'
                        case 11:
                            return data = '<p class="text-xs text-secondary mb-0">Región de Los Lagos</p>'
                        case 12:
                            return data = '<p class="text-xs text-secondary mb-0">Región de Aysén</p>'
                        case 13:
                            return data = '<p class="text-xs text-secondary mb-0">Región de Magallanes</p>'
                        default:
                            return data = '<p class="text-xs text-secondary mb-0">Región de Desconocida</p>'
                    }
                  }
                },
                { data: 'destination' ,
                  render:function(data){
                    return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
                  }
                },
                { data: 'number_participants' ,
                  render:function(data){
                    return data = '<p class="text-xs text-secondary mb-0">'+data+'</p>'
                  }
                },
                { data: 'departure_date' ,
                  render:function(data){
                    return data = '<p class="text-xs text-secondary mb-0">'+moment(data).format('DD-MM-YYYY HH:mm')+'</p>'
                  }
                },
                { data: 'return_date' ,
                  render:function(data){
                        if(moment(data).isSame(moment(), 'day')){
                            return data = '<p class="text-xs text-secondary mb-0">'+moment(data).format('DD-MM-YYYY HH:mm')+'</p>'
                        }else if(moment(data).isAfter(moment())){
                            return data = '<p class="text-xs text-secondary mb-0 text-danger">'+moment(data).format('DD-MM-YYYY HH:mm')+'</p>'
                        }else{
                            return data = '<p class="text-xs text-secondary mb-0">'+moment(data).format('DD-MM-YYYY HH:mm')+'</p>'
                        }
                  }
                },
                { data: 'active' ,
                  render:function(data){
                    return data = '<p class="text-xs text-secondary mb-0">' + (data == 1 ? '<span class="badge bg-gradient-success">Activo</span>' : '<span class="badge bg-gradient-danger">Inactivo</span>') +'</p>'
                  }
                },
                {
                  data: null,
                  orderable: false,
                  searchable: false,
                  render: function(data, type, row) {
                    if (data.download_url) {
                      disabled_aperture = data.active == 1 ? '<button class="btn btn-success" onclick="cambiarEstado('+data.id+')"><i class="fa-solid fa-calendar-check"></i></button>' : '';

                      return `
                      ${disabled_aperture}
                      <a class="btn btn-danger" href="tel:${data.phone}"><i class="fa-solid fa-phone"></i></a>
                      <a href="${data.download_url}" class="btn btn-dark"><i class="fa-solid fa-map-location-dot"></i></a>`;
                    }
                    return 'Sin archivo';
                  }
                }
              ]
            });

            $('#datatableAviso tbody').on('click', 'button.btn-view-message', function () {
              var message = $(this).data('message') || '';
              $('#messageModal .modal-body').text(message);
            });
          });

          function cambiarEstado(id){
            Swal.fire({
                title: "¿Esta seguro de cambiar el estado? el",
                text: "No podras volver a cambiarlo!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, cambiarlo!"
                }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'POST',
                        url: '/aviso/cambiar-estado/'+id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response){
                            Swal.fire({
                                title: "Cambiado!",
                                text: "El estado ha sido cambiado.",
                                icon: "success"
                            });
                            datatableAviso.ajax.reload();
                        },error: function(error){
                            Swal.fire({
                                title: "No ha podido cambiar el estado!",
                                text: "Intente nuevamente.",
                                icon: "error"
                            });
                        }
                    })

                }
            });
          }
    </script>
@endpush

