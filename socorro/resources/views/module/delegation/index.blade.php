@extends('layout.main')

@section('title', 'Voluntarios')

@section('content')

    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-people-roof"></i> Administración
                                de Delegaciones</h6>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="w-100 p-2 mb-4">
                            <table id="datatableDelegations" class="table table-striped dt-responsive nowrap"
                                style="width: 100%;">
                                <thead class="bg-gradient-dark text-center">
                                    <tr class="text-center">
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">
                                            Nombre</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">
                                            Región</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">
                                            Imagen</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">
                                            Acciones</th>
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

    @include('module.delegation.create')
    @include('module.delegation.edit')

@endsection

@push('script')
    <script>
        var datatableDelegations;
        var datatableVoluntaries;
        var datatablePostulations;
        var datatablePostulationsPeople;

        $(document).ready(function() {
            datatableDelegations = $('#datatableDelegations').DataTable({
                ajax: {
                    url: '{{ route('delegaciones.data') }}',
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
                dom: "<'row mb-2'<'col-md-6 d-flex align-items-center'B><'col-md-6'f>>" +
                    "<'row'<'col-12'tr>>" +
                    "<'row mt-2'<'col-md-6'i><'col-md-6'p>>",
                responsive: {
                    details: {
                        type: 'inline'
                    }
                },
                buttons: [{
                        text: '<i class="fa-solid fa-circle-plus"></i>',
                        className: 'btn btn-dark text-white gap-2 me-2',
                        action: () => $('#CreateModal').modal('show')
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
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'region.name'
                    },
                    {
                        data: 'image',
                        render: function(data, type, row) {
                            if (data) {
                                return `<img src="/storage/${data}" width="80" class="img-thumbnail">`;
                            } else {
                                return 'Sin imagen';
                            }
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                     <a href="javascript:;" class="btn btn-dark text-white btn-load" onclick="editDelegation(${data.id})">
                        <i class="fa-solid fa-pen-to-square"></i>
                      </a>
                      <a onclick="deleteDelegation(${data.id})" class="btn btn-danger text-white">
                        <i class="fa-solid fa-trash"></i>
                      </a>`;
                        }
                    }
                ]
            });
        });

        $('#formDelegation').submit(function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: '{{ route('delegaciones.store') }}',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.success,
                    });
                    $('#formDelegation')[0].reset();
                    $('#CreateModal').modal('hide');
                    datatableDelegations.ajax.reload();
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error.',
                        text: error.responseJSON.error,
                    });
                    $('#CreateModal').modal('hide');
                }
            });
        });

        function editDelegation(id) {
            $('.btn-load').html('<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><rect width="7.33" height="7.33" x="1" y="1" fill="currentColor"><animate id="SVGzjrPLenI" attributeName="x" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="0;SVGXAURnSRI.end+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="1" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="1" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.1s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="1" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="1" y="15.66" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="1;4;1"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.2s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="8.33" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="8.33" y="15.66" fill="currentColor"><animate attributeName="x" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="8.33;11.33;8.33"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.3s" dur="0.6s" values="7.33;1.33;7.33"/></rect><rect width="7.33" height="7.33" x="15.66" y="15.66" fill="currentColor"><animate id="SVGXAURnSRI" attributeName="x" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="y" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="15.66;18.66;15.66"/><animate attributeName="width" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/><animate attributeName="height" begin="SVGzjrPLenI.begin+0.4s" dur="0.6s" values="7.33;1.33;7.33"/></rect></svg>').prop('disabled', true);
            $.ajax({
                url: 'delegaciones/edit/' + id,
                type: 'GET',
                success: function(response) {
                    $('.btn-load').html('<i class="fa-solid fa-pen-to-square"></i>').prop('disabled', false)
                    $('#EditModal').modal('show');
                    $('#id').val(response.id);
                    $('#delegation_id_postulation').val(response.id);
                    $('#name_edit').val(response.name);
                    $('#postulation_status').val(response.postulation_status == 'C' ? 'Cerrado' : 'Abierto');
                },
                error: function(error) {
                    $('.btn-load').html('<i class="fa-solid fa-pen-to-square"></i>').prop('disabled', false)
                    Swal.fire({
                        icon: 'error',
                        title: 'Error.',
                        text: 'Error al editar delegación',
                    });
                }
            });

            if ($('#datatablePostulations').length) {
            datatablePostulations = $('#datatablePostulations').DataTable({
                ajax: {
                    url: 'postulations/data/' + id,
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
                dom: "<'row mb-2'<'col-md-6 d-flex align-items-center'B><'col-md-6'f>>" +
                    "<'row'<'col-12'tr>>" +
                    "<'row mt-2'<'col-md-6'i><'col-md-6'p>>",
                responsive: {
                    details: {
                        type: 'inline'
                    }
                },
                buttons: [{
                        text: '<i class="fa-solid fa-circle-plus"></i>',
                        className: 'btn btn-dark text-white gap-2 me-2',
                        action: () => {
                            $('#CreateModalEventPostulation').modal('show')
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fa-solid fa-file-excel"></i>',
                        className: 'btn btn-success me-2'
                    }
                ],
                columns: [{
                        data: 'title'
                    },
                    {
                        data: 'status',
                        render: function(data) {
                            return data == 'A' ? '<span class="badge bg-success">Abierto</span>' :
                                '<span class="badge bg-danger">Cerrado</span>';
                        }
                    },
                    {
                        data: 'start_date',
                        render: function(data) {
                            return moment(data).format('DD/MM/YYYY HH:mm:ss');
                        }
                    },
                    {
                        data: 'end_date',
                        render: function(data) {

                            var today = moment();
                            var date = moment(data);

                            if (today.isAfter(date)) {
                                return '<span style="color:red;">' + date.format('DD/MM/YYYY HH:mm:ss') +
                                    '</span>';
                            } else {
                                return date.format('DD/MM/YYYY HH:mm:ss');
                            }
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                    <a href="javascript:;" class="btn btn-info text-white" onclick="detailsPostulation(${data.id})" data-bs-toggle="modal" data-bs-target="#DetailsModalPostulation">
                            <i class="fa-solid fa-circle-info"></i>
                        </a>`;
                        }
                    }
                ],
                destroy: true
            });
            }



            datatableVoluntaries = $('#datatableVoluntaries').DataTable({
                destroy: true,
                ajax: {
                    url: 'postulations/voluntaries/data/' + id,
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
                dom: "<'row mb-2'<'col-md-6 d-flex align-items-center'B><'col-md-6'f>>" +
                    "<'row'<'col-12'tr>>" +
                    "<'row mt-2'<'col-md-6'i><'col-md-6'p>>",
                responsive: {
                    details: {
                        type: 'inline'
                    }
                },
                buttons: [{
                    extend: 'excelHtml5',
                    text: '<i class="fa-solid fa-file-excel"></i>',
                    className: 'btn btn-success me-2'
                }],
                columns: [{
                        data: 'name'
                    },
                    {
                        data: 'type',
                        render: function(data, type, row) {
                            return data == 'V' ? 'Voluntario' : 'Aspirante';
                        }
                    }
                ],
                destroy: true
            });
        }



        $('#formDelegationEventPostulation').submit(function(e) {
            e.preventDefault();
            $.ajax({
                url: '{{ route('postulations.store') }}',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: response.message + ' - Titular: ' + response.postulation.title,
                        confirmButtonText: 'Aceptar'
                    });
                    $('#formDelegationEventPostulation')[0].reset();
                    $('#CreateModalEventPostulation').modal('hide');
                    datatablePostulations.ajax.reload();
                },
                error: function(error) {
                    let errorMsg = 'Error al registrar postulación';
                    if (error.status === 422) {
                        // Errores de validación
                        errorMsg = Object.values(error.responseJSON.errors).flat().join(', ');
                    } else if (error.responseJSON?.error) {
                        errorMsg = error.responseJSON.error;
                    }
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: errorMsg,
                        confirmButtonText: 'Aceptar'
                    });
                    $('#CreateModalEventPostulation').modal('hide');
                }
            });
        });

        $('#formDelegationEdit').submit(function(e) {
            e.preventDefault();
            let id = $('#id').val();

            $.ajax({
                url: 'delegaciones/update/' + id,
                type: 'PUT',
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito',
                        text: 'Delegación actualizada correctamente',
                    });
                    $('#EditModal').modal('hide');
                    datatableDelegations.ajax.reload();
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: error.responseJSON?.error || 'Error al actualizar delegación',
                    });
                }
            });
        });

        function deleteDelegation(id) {
            Swal.fire({
                title: "¿Estas seguro de eliminar el usuario?",
                text: "No podrás revertir esto!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Si, eliminarlo!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'delegaciones/destroy/' + id,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Exito.',
                                text: 'Delegación eliminada correctamente',
                            });
                            datatableDelegations.ajax.reload();
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error.',
                                text: 'Error al eliminar delegación: ' + JSON.stringify(error),
                            });
                        }
                    });
                }
            });
        }

        function detailsPostulation(id) {
            console.log('detailsPostulation called with id:', id);
            $.ajax({
                url: 'postulations/details/' + id,
                type: 'GET',
                success: function(response) {
                    console.log('Postulation details:', response);
                    $('#DetailsModalPostulation').modal('show');
                    $('#titlePostulation').val(response.title);
                    $('#cant_people_selectedPostulation').val(response.cant_people_selected);
                    $('#descriptionPostulation').val(response.description);
                    $('#start_datePostulation').val(response.start_date);
                    $('#endDatePostulation').val(response.end_date);

                    datatablePostulationsPeople = $('#datatablePostulationsPeople').DataTable({
                        destroy: true,
                        ajax: {
                            url: '/postulations-people/data/' + id,
                            dataSrc: '',
                            beforeSend: function() {
                                console.log('Cargando postulantes para postulation_id:', id);
                            },
                            error: function(xhr, error, thrown) {
                                console.log('Error en DataTable:', xhr.responseText);
                                console.log('ID usado:', id);
                            }
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
                        dom: "<'row mb-2'<'col-md-6 d-flex align-items-center'B><'col-md-6'f>>" +
                            "<'row'<'col-12'tr>>" +
                            "<'row mt-2'<'col-md-6'i><'col-md-6'p>>",
                        responsive: {
                            details: {
                                type: 'inline'
                            }
                        },
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
                        columns: [
                            { data: 'name', title: 'Nombre' },
                            { data: 'last_name', title: 'Apellido' },
                            { data: 'rut', title: 'RUT' },
                            { data: 'phone', title: 'Teléfono' },
                            { data: 'email', title: 'Email' },
                            { data: 'presentation', title: 'Presentación' }

                        ],
                        destroy: true
                    });
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error.',
                        text: 'Error al editar delegación',
                    });
                }
            });
        }
    </script>
@endpush
