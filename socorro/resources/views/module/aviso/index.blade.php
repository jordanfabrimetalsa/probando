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

                        <div class="row">
                            <div class="col-md-6 col-lg-6 col-sm-12 mb-2">
                                <h6 class=" text-capitalize ps-3 text-dark"><i class="fa-solid fa-map-location-dot"></i>
                                    Mapas</h6>
                                <ul class="list-group list-group-flush border">
                                    <li class="list-group-item">Google Earth <a href="https://earth.google.com/"
                                            target="_blank" class="badge bg-gradient-dark float-end"><i
                                                class="fa-solid fa-link"></i></a></li>
                                    <li class="list-group-item">Maps.me <a href="https://www.maps.me/" target="_blank"
                                            class="badge bg-gradient-dark float-end"><i class="fa-solid fa-link"></i></a>
                                    </li>
                                    <li class="list-group-item">Gaia GPS <a href="https://gaia.gps.com/" target="_blank"
                                            class="badge bg-gradient-dark float-end"><i class="fa-solid fa-link"></i></a>
                                    </li>
                                    <li class="list-group-item">Suda Outdoor <a href="https://www.sudaoutdoor.com/"
                                            target="_blank" class="badge bg-gradient-dark float-end"><i
                                                class="fa-solid fa-link"></i></a></li>
                                    <li class="list-group-item">Wikiloc <a href="https://www.wikiloc.com/" target="_blank"
                                            class="badge bg-gradient-dark float-end"><i class="fa-solid fa-link"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <h6 class=" text-capitalize ps-3 text-dark"><i class="fa-solid fa-poo-storm"></i>
                                    Meteorologia</h6>
                                <ul class="list-group list-group-flush border">
                                    <li class="list-group-item">Mountain Forecast<a href="https://mountainforecast.com/"
                                            target="_blank" class="badge bg-gradient-dark float-end"><i
                                                class="fa-solid fa-link"></i></a></li>
                                    <li class="list-group-item">Windy<a href="https://windy.com/" target="_blank"
                                            class="badge bg-gradient-dark float-end"><i class="fa-solid fa-link"></i></a>
                                    </li>
                                    <li class="list-group-item">AccuWeather<a href="https://www.accuweather.com/"
                                            target="_blank" class="badge bg-gradient-dark float-end"><i
                                                class="fa-solid fa-link"></i></a></li>
                                    <li class="list-group-item">MeteoRed<a href="https://www.meteored.com/" target="_blank"
                                            class="badge bg-gradient-dark float-end"><i class="fa-solid fa-link"></i></a>
                                    </li>
                                    <li class="list-group-item">MeteoBlue<a href="https://www.meteoblue.com/"
                                            target="_blank" class="badge bg-gradient-dark float-end"><i
                                                class="fa-solid fa-link"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <br>
                        <hr>
                        <br>
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

@endsection

@push('script')
    <script>
        var datatableAviso;
        var disabled_aperture = '';

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

                                return `
                                    <button class="btn btn-success" onclick="cambiarEstado('${data.id}')"><i class="fa-solid fa-calendar-check"></i></button>
                                    <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#infoModal" onclick="showInfo(${data.id})"><i class="fa-solid fa-file-invoice"></i></button>
                                    <a class="btn btn-danger" href="tel:${data.phone}"><i class="fa-solid fa-phone"></i></a>
                                    <a href="${data.download_url}" class="btn btn-dark"><i class="fa-solid fa-map-location-dot"></i></a>`;
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
