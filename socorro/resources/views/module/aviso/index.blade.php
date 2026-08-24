@extends('layout.main')

@section('title', 'Usuarios')

@section('content')

    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-user-tie"></i> Administración de
                                Avisos de Salidas.</h6>
                        </div>
                    </div>
                    <div class="card-body p-4">

                        @php
                            $resourceGroups = [
                                ['title' => 'Mapas y navegación', 'copy' => 'Herramientas para planificar y consultar rutas.', 'icon' => 'fa-map-location-dot', 'links' => [
                                    ['Google Earth', 'https://earth.google.com/'], ['Maps.me', 'https://www.maps.me/'],
                                    ['Gaia GPS', 'https://gaia.gps.com/'], ['Suda Outdoor', 'https://www.sudaoutdoor.com/'], ['Wikiloc', 'https://www.wikiloc.com/'],
                                ]],
                                ['title' => 'Meteorología', 'copy' => 'Pronósticos para evaluar las condiciones de montaña.', 'icon' => 'fa-cloud-sun', 'links' => [
                                    ['Mountain Forecast', 'https://mountainforecast.com/'], ['Windy', 'https://windy.com/'],
                                    ['AccuWeather', 'https://www.accuweather.com/'], ['MeteoRed', 'https://www.meteored.com/'], ['MeteoBlue', 'https://www.meteoblue.com/'],
                                ]],
                            ];
                        @endphp
                        <section class="departure-resources" aria-label="Recursos para salidas">
                            @foreach($resourceGroups as $group)
                                <article class="resource-panel">
                                    <header class="resource-panel__header">
                                        <span class="resource-panel__icon"><i class="fa-solid {{ $group['icon'] }}"></i></span>
                                        <div><h6>{{ $group['title'] }}</h6><p>{{ $group['copy'] }}</p></div>
                                    </header>
                                    <div class="resource-links">
                                        @foreach($group['links'] as [$label, $url])
                                            <a href="{{ $url }}" target="_blank" rel="noopener noreferrer">
                                                <span>{{ $label }}</span><i class="fa-solid fa-arrow-up-right-from-square"></i>
                                            </a>
                                        @endforeach
                                    </div>
                                </article>
                            @endforeach
                        </section>
                        <div class="departure-section-divider"></div>
                        <p>Lista de salidas, aquí puedes visualizar todas las salidas que han sido registradas. Si esta
                            activo, es porque aun el deportista aún no da aviso de salida.</p>
                        <div class="w-100 p-2 mb-4">
                            <table id="datatableAviso" class="table table-striped dt-responsive nowrap"
                                style="width: 100%;">
                                <thead class="bg-gradient-dark text-center">
                                    <tr class="text-center">
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">
                                            N°</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">
                                            Nombre</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">
                                            Región</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">
                                            Destino</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">
                                            N° de participantes</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">
                                            Fecha de ida</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">
                                            Fecha de vuelta</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">
                                            Estado</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">
                                            Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                </tbody>
                            </table>
                        </div>

                        <!-- Modal único para mostrar el mensaje -->
                        <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="messageModalLabel">Mensaje</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- El contenido se inyectará dinámicamente -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="infoModalLabel">Información Aviso de Salida</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="infoModalContent">
                                            <form id="form_departure" type="POST" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Nombres</label>
                                                                <input type="text" class="form-control" id="name"
                                                                    name="name"
                                                                    required readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Apellidos</label>
                                                                <input type="text" class="form-control" id="last_name"
                                                                    name="last_name"
                                                                    required readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Tipo</label>
                                                                <input type="text" class="form-control"
                                                                    id="document_type" readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for=""
                                                                    class="form-label">Rut/Pasaporte</label>
                                                                <input type="text" class="form-control"
                                                                    id="document_number" name="document_number" required
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row border-bottom mb-2">
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">E-mail</label>
                                                                <input type="email" class="form-control" id="email"
                                                                    name="email" required
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Telefono</label>
                                                                <input type="number" class="form-control" id="phone"
                                                                    name="phone" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Región de
                                                                    Destino</label>
                                                                <input type="text" class="form-control" id="region"
                                                                    name="region" required
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Lugar
                                                                    Destino</label>
                                                                <input type="text" class="form-control"
                                                                    id="destination" name="destination" required
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Ruta</label>
                                                                <input type="text" class="form-control" id="route"
                                                                    name="route"  required
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Actividad</label>
                                                                <input type="text" class="form-control" id="activity"
                                                                    name="activity"
                                                                    required readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">N°
                                                                    Participantes</label>
                                                                <input type="number" class="form-control"
                                                                    id="number_participants" name="number_participants"
                                                                    required readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Fecha de
                                                                    Salida</label>
                                                                <input type="text" class="form-control"
                                                                    id="departure_date" name="departure_date" required
                                                                    readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Fecha de
                                                                    Regreso</label>
                                                                <input type="text" class="form-control"
                                                                    id="return_date" name="return_date" required readonly>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="col-4">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Nombre de Emergencia</label>
                                                                <input type="text" class="form-control" id="name_emergency_family" name="name_emergency_family" required readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Parentesco Emergencia</label>
                                                                <input type="text" class="form-control" id="parentesco_family_emergency" name="parentesco_family_emergency" required readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Numero de Emergencia</label>
                                                                <input type="text" class="form-control" id="number_family_emergency" name="number_family_emergency" required readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Nombre de Emergencia 2</label>
                                                                <input type="text" class="form-control" id="name_emergency_family_2" name="name_emergency_family_2" required readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Parentesco Emergencia 2</label>
                                                                <input type="text" class="form-control" id="parentesco_family_emergency_2" name="parentesco_family_emergency_2" required readonly>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="mb-3">
                                                                <label for="" class="form-label">Numero de Emergencia 2</label>
                                                                <input type="text" class="form-control" id="number_family_emergency_2" name="number_family_emergency_2" required readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Cerrar</button>
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

<div class="modal fade" id="trackModal" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-xl modal-dialog-centered"><div class="modal-content track-modal">
    <div class="modal-header"><div><span class="track-kicker">Ruta de montaña</span><h5 class="modal-title">Visualización del track GPX</h5></div><button class="btn-close" data-bs-dismiss="modal"></button></div>
    <div class="modal-body p-0"><div class="track-map-wrap"><div id="trackMap"></div><div id="trackLoading" class="track-loading"><span class="spinner-border spinner-border-sm"></span><strong>Cargando recorrido…</strong></div></div><div class="track-summary"><span><i class="fa-solid fa-route"></i><small>Distancia estimada</small><strong id="trackDistance">—</strong></span><span><i class="fa-solid fa-location-dot"></i><small>Puntos del track</small><strong id="trackPoints">—</strong></span><span><i class="fa-solid fa-person-hiking"></i><small>Aviso</small><strong id="trackDepartureName">—</strong></span><a id="trackDownload" class="btn btn-outline-dark btn-sm" href="#"><i class="fa-solid fa-download me-1"></i>Descargar GPX</a></div></div>
</div></div></div>
@endsection

@push('script')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>
    <script>
        var datatableAviso;
        var disabled_aperture = '';
        var departureTrackMap = null;
        var departureTrackLayer = null;

        $(document).ready(function() {
            datatableAviso = $('#datatableAviso').DataTable({
                ajax: {
                    url: '{{ route('aviso.data') }}',
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
                order: [
                    [0, 'desc']
                ], // Ordena por columna 5 (fecha de ida) en orden descendente
                dom: "<'row mb-2'<'col-md-6 d-flex align-items-center'B><'col-md-6'f>>" +
                    "<'row'<'col-12'tr>>" +
                    "<'row mt-2'<'col-md-6'i><'col-md-6'p>>",
                buttons: [{
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
                columns: [{
                        data: 'id',
                        render: function(data) {
                            return data = '<p class="text-xs text-secondary mb-0">' + data + '</p>'
                        }
                    },
                    {
                        data: null,
                        render: function(data, type, row) {
                            return data = '<p class="text-xs text-secondary mb-0">' + row.name +
                                ' ' + row.lastname + '</p>'
                        }
                    },
                    {
                        data: 'region',
                        render: function(data) {

                            switch (data) {
                                case "0":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Arica y Parinacota</p>'
                                case "1":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Tarapacá</p>'
                                case "2":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Antofagasta</p>'
                                case "3":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Atacama</p>'
                                case "4":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Coquimbo</p>'
                                case "5":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Valparaiso</p>'
                                case "6":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Metropolitana</p>'
                                case "7":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de OHiggins</p>'
                                case "8":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Maule</p>'
                                case "9":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Ñuble</p>'
                                case "10":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Bio Bio</p>'
                                case "11":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Araucania</p>'
                                case "12":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Los Rios</p>'
                                case "13":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Los Lagos</p>'
                                case "14":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Aysén</p>'
                                case "15":
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Magallanes</p>'
                                default:
                                    return data =
                                        '<p class="text-xs text-secondary mb-0">Región de Desconocida</p>'
                            }
                        }
                    },
                    {
                        data: 'destination',
                        render: function(data) {
                            return data = '<p class="text-xs text-secondary mb-0">' + data + '</p>'
                        }
                    },
                    {
                        data: 'number_participants',
                        render: function(data) {
                            return data = '<p class="text-xs text-secondary mb-0">' + data + '</p>'
                        }
                    },
                    {
                        data: 'departure_date',
                        render: function(data) {
                            return data = '<p class="text-xs text-secondary mb-0">' + moment(data)
                                .format('DD-MM-YYYY HH:mm') + '</p>'
                        }
                    },
                    {
                        data: 'return_date',
                        render: function(data) {
                            if (moment(data).isSame(moment(), 'day')) {
                                return data = '<p class="text-xs text-secondary mb-0">' + moment(
                                    data).format('DD-MM-YYYY HH:mm') + '</p>'
                            } else if (moment(data).isAfter(moment())) {
                                return data =
                                    '<p class="text-xs text-secondary mb-0 text-danger">' + moment(
                                        data).format('DD-MM-YYYY HH:mm') + '</p>'
                            } else {
                                return data = '<p class="text-xs text-secondary mb-0">' + moment(
                                    data).format('DD-MM-YYYY HH:mm') + '</p>'
                            }
                        }
                    },
                    {
                        data: 'active',
                        render: function(data) {
                            return data = '<p class="text-xs text-secondary mb-0">' + (data == 1 ?
                                    '<span class="badge bg-gradient-success">Activo</span>' :
                                    '<span class="badge bg-gradient-danger">Inactivo</span>') +
                                '</p>'
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            if (data.download_url) {
                                disabled_aperture = data.active == 1 ?
                                    '<button class="btn btn-success" onclick="cambiarEstado(' + data
                                    .id + ')"><i class="fa-solid fa-calendar-check"></i></button>' :
                                    '';

                                const trackButton = data.has_gpx ? `<button class="btn btn-track" title="Ver track GPX" onclick="openTrack(${data.id}, '${data.track_url}', '${String(data.name + ' ' + data.lastname).replace(/'/g, "\\'")}', '${data.download_url}')"><i class="fa-solid fa-route"></i></button>` : '';
                                return `
                                    <button class="btn btn-success" onclick="cambiarEstado('${data.id}')"><i class="fa-solid fa-calendar-check"></i></button>
                                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="showInfo(${data.id})"><i class="fa-solid fa-file-invoice"></i></button>
                                    <a class="btn btn-danger" href="tel:${data.phone}"><i class="fa-solid fa-phone"></i></a>
                                    ${trackButton}<a href="${data.download_url}" class="btn btn-dark" title="Descargar archivo"><i class="fa-solid fa-download"></i></a>`;
                            }
                            return `<button class="btn btn-success" onclick="cambiarEstado('${data.id}')"><i class="fa-solid fa-calendar-check"></i></button>
                                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="showInfo(${data.id})"><i class="fa-solid fa-file-invoice"></i></button>
                                    <a class="btn btn-danger" href="tel:${data.phone}"><i class="fa-solid fa-phone"></i></a>`;
                        }
                    }
                ]
            });

            $('#datatableAviso tbody').on('click', 'button.btn-view-message', function() {
                var message = $(this).data('message') || '';
                $('#messageModal .modal-body').text(message);
            });
        });

        function cambiarEstado(id) {
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
                        url: '/aviso/cambiar-estado/' + id,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Cambiado!",
                                text: "El estado ha sido cambiado.",
                                icon: "success"
                            });
                            datatableAviso.ajax.reload();
                        },
                        error: function(error) {
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

        function calculateTrackDistance(points) {
            let total=0, radius=6371;
            for(let i=1;i<points.length;i++){const a=points[i-1],b=points[i],dLat=(b[0]-a[0])*Math.PI/180,dLon=(b[1]-a[1])*Math.PI/180,v=Math.sin(dLat/2)**2+Math.cos(a[0]*Math.PI/180)*Math.cos(b[0]*Math.PI/180)*Math.sin(dLon/2)**2;total+=radius*2*Math.atan2(Math.sqrt(v),Math.sqrt(1-v));}
            return total;
        }

        async function openTrack(id, trackUrl, name, downloadUrl) {
            bootstrap.Modal.getOrCreateInstance(document.getElementById('trackModal')).show();
            $('#trackLoading').removeClass('is-hidden').html('<span class="spinner-border spinner-border-sm"></span><strong>Cargando recorrido…</strong>');
            $('#trackDistance, #trackPoints').text('—'); $('#trackDepartureName').text(name); $('#trackDownload').attr('href',downloadUrl);
            if(!departureTrackMap){departureTrackMap=L.map('trackMap').setView([-33.45,-70.66],7);L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',{maxZoom:19,attribution:'© OpenStreetMap'}).addTo(departureTrackMap);}
            setTimeout(()=>departureTrackMap.invalidateSize(),250); if(departureTrackLayer)departureTrackLayer.remove();
            try {
                const response=await fetch(trackUrl,{headers:{Accept:'application/gpx+xml'}}); if(!response.ok)throw new Error('No fue posible abrir el archivo.');
                const xml=new DOMParser().parseFromString(await response.text(),'application/xml'); if(xml.querySelector('parsererror'))throw new Error('El archivo GPX no tiene un formato válido.');
                const points=[...xml.querySelectorAll('trkpt, rtept')].map(n=>[Number(n.getAttribute('lat')),Number(n.getAttribute('lon'))]).filter(p=>Number.isFinite(p[0])&&Number.isFinite(p[1]));
                if(points.length<2)throw new Error('El GPX no contiene suficientes puntos para dibujar una ruta.');
                departureTrackLayer=L.featureGroup([L.polyline(points,{color:'#ea4e1a',weight:4,opacity:.92}),L.circleMarker(points[0],{radius:7,color:'#fff',weight:3,fillColor:'#23845d',fillOpacity:1}).bindTooltip('Inicio'),L.circleMarker(points.at(-1),{radius:7,color:'#fff',weight:3,fillColor:'#c84317',fillOpacity:1}).bindTooltip('Término')]).addTo(departureTrackMap);
                departureTrackMap.fitBounds(departureTrackLayer.getBounds(),{padding:[35,35]}); $('#trackDistance').text(calculateTrackDistance(points).toFixed(1)+' km'); $('#trackPoints').text(points.length.toLocaleString('es-CL')); $('#trackLoading').addClass('is-hidden');
            } catch(error) { $('#trackLoading').html(`<i class="fa-solid fa-triangle-exclamation"></i><strong>${error.message}</strong>`); }
        }

        function showInfo(id) {
            $('#form_departure')[0].reset();

            $.ajax({
                type: 'GET',
                url: '/aviso/show-info/' + id,
                success: function(response) {
                    var region;
                    var document_type;
                    var activity;

                    switch (response.region) {
                        case "0":
                            region = 'Región Arica y Parinacota';
                            break;

                        case "1":
                            region = 'Región Tarapaca';
                            break;

                        case "2":
                            region = 'RegiÖn Antofagasta';
                            break;

                        case "3":
                            region = 'Región Atacama';
                            break;

                        case "4":
                            region = 'Región Coquimbo';
                            break;

                        case "5":
                            region = 'Región Valparaiso';
                            break;

                        case "6":
                            region = 'Región Metropolitana';
                            break;

                        case "7":
                            region = 'Región O\'Higgins';
                            break;

                        case "8":
                            region = 'Región Maule';
                            break;

                        case "9":
                            region = 'Región Ñuble';
                            break;

                        case "10":
                            region = 'Región Bio Bío';
                            break;

                        case "11":
                            region = 'Región Araucania';
                            break;

                        case "12":
                            region = 'Región Los Ríos';
                            break;

                        case "13":
                            region = 'Región Los Lagos';
                            break;

                        case "14":
                            region = 'Región Aysen';
                            break;

                        case "15":
                            region = 'Región Magallanes';
                            break;
                    }

                    if (response.document_type == 0) {
                        document_type = 'Pasaporte';
                    } else {
                        document_type = 'Rut';
                    }

                    switch(response.activity){
                        case "0":
                            activity = 'Trekking';
                            break;
                        case "1":
                            activity = 'Hikking';
                            break;
                        case "2":
                            activity = 'Mountain Bike';
                            break;
                        case "3":
                            activity = 'Escalada';
                            break;
                        case "4":
                            activity = 'Escalada en Hielo';
                            break;
                        case "5":
                            activity = 'Randonee';
                            break;
                        case "6":
                            activity = 'Kayak';
                            break;
                        case "7":
                            activity = 'Kitesurf';
                            break;
                    }

                    $('#name').val(response.name);
                    $('#last_name').val(response.lastname);
                    $('#document_type').val(document_type);
                    $('#document_number').val(response.document_number);
                    $('#email').val(response.email);
                    $('#phone').val(response.phone);
                    $('#region').val(region);
                    $('#destination').val(response.destination);
                    $('#route').val(response.route);
                    $('#activity').val(activity);
                    $('#name_emergency_family').val(response.name_emergency_family);
                    $('#parentesco_family_emergency').val(response.parentesco_family_emergency);
                    $('#number_family_emergency').val(response.number_family_emergency);
                    $('#name_emergency_family_2').val(response.name_emergency_family_2);
                    $('#parentesco_family_emergency_2').val(response.parentesco_family_emergency_2);
                    $('#number_family_emergency_2').val(response.number_family_emergency_2);

                    $('#number_participants').val(response.number_participants);
                    $('#departure_date').val(moment(response.departure_date).format('DD-MM-YYYY HH:MM'));
                    $('#return_date').val(moment(response.return_date).format('DD-MM-YYYY HH:MM'));
                },
                error: function(error) {
                    console.log(error);
                }
            })
        }
    </script>
@endpush

@push('styles')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" crossorigin="">
<style>
    .departure-resources{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:14px;margin-bottom:26px}.resource-panel{padding:17px;border:1px solid #dfe8eb;border-radius:13px;background:#fbfcfd}.resource-panel__header{display:flex;align-items:center;gap:11px;margin-bottom:14px}.resource-panel__icon{display:grid;flex:0 0 37px;height:37px;place-items:center;border-radius:9px;background:#e8f3f6;color:#176985;font-size:.85rem}.resource-panel__header h6{margin:0;color:#29444f;font-size:.79rem;font-weight:750}.resource-panel__header p{margin:3px 0 0;color:#80929a;font-size:.62rem}.resource-links{display:grid;grid-template-columns:repeat(2,minmax(0,1fr));gap:7px}.resource-links a{display:flex;min-height:38px;align-items:center;justify-content:space-between;gap:8px;padding:8px 10px;border:1px solid #e5ecef;border-radius:8px;background:#fff;color:#526b75;font-size:.69rem;font-weight:650;transition:border-color .18s,background .18s,color .18s,transform .18s}.resource-links a:last-child:nth-child(odd){grid-column:1/-1}.resource-links a i{color:#96aab2;font-size:.58rem}.resource-links a:hover{border-color:#b9d4dd;background:#f1f8fa;color:#176985;transform:translateY(-1px)}.resource-links a:hover i{color:#ea4e1a}.departure-section-divider{height:1px;margin:0 0 24px;background:linear-gradient(90deg,transparent,#dce6e9 10%,#dce6e9 90%,transparent)}
    @media(max-width:767.98px){.departure-resources{grid-template-columns:1fr}.resource-panel{padding:14px}.resource-links{grid-template-columns:1fr}.resource-links a:last-child:nth-child(odd){grid-column:auto}.resource-panel__header p{font-size:.6rem}}
    .btn-track{background:#eaf5f7!important;color:#176985!important}.track-kicker{color:#ea4e1a;font-size:.62rem;font-weight:800;letter-spacing:.09em;text-transform:uppercase}.track-map-wrap{position:relative}.track-map-wrap #trackMap{height:min(62vh,560px);min-height:390px;background:#e9eff1}.track-loading{position:absolute;inset:0;z-index:500;display:flex;align-items:center;justify-content:center;gap:10px;background:#f7fafbe8;color:#48616b;font-size:.75rem}.track-loading.is-hidden{display:none}.track-loading>i{color:#ea4e1a}.track-summary{display:flex;align-items:center;gap:28px;padding:16px 20px;border-top:1px solid #dce6e9}.track-summary>span{display:grid;grid-template-columns:auto 1fr;column-gap:9px}.track-summary>span>i{grid-row:1/3;align-self:center;color:#176985}.track-summary small{color:#84969e;font-size:.58rem;text-transform:uppercase}.track-summary strong{color:#29444f;font-size:.73rem}.track-summary>a{margin-left:auto}@media(max-width:767.98px){.track-map-wrap #trackMap{height:52vh;min-height:330px}.track-summary{display:grid;grid-template-columns:1fr 1fr;gap:13px}.track-summary>a{grid-column:1/-1;width:100%;margin:0}}
</style>
@endpush
