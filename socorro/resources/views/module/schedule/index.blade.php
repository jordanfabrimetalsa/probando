@extends('layout.main')

@section('title', 'Horarios')

@push('styles')
<style>
.calendar-responsive {
    height: 600px;
}

/* Responsive para móviles */
@media (max-width: 768px) {
    .calendar-responsive {
        height: 500px;
    }

    .fc .fc-toolbar {
        flex-direction: column;
        gap: 10px;
    }

    .fc .fc-toolbar-chunk {
        display: flex;
        justify-content: center;
        width: 100%;
        margin-bottom: 5px;
    }

    .fc .fc-header-toolbar {
        flex-wrap: wrap;
    }

    .fc .fc-button-group {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        gap: 2px;
    }

    .fc .fc-button {
        font-size: 12px;
        padding: 4px 8px;
        margin: 1px;
    }

    .fc .fc-toolbar-title {
        font-size: 16px;
        text-align: center;
    }

    .fc-daygrid-day-number {
        font-size: 12px;
    }

    .fc-event-title {
        font-size: 10px;
    }

    /* Modales en móviles */
    .modal-dialog {
        margin: 10px;
        max-width: calc(100% - 20px);
    }

    .modal-body {
        padding: 15px;
    }

    /* DataTables responsive */
    .dataTables_wrapper {
        font-size: 12px;
    }

    .table {
        font-size: 12px;
    }

    .btn {
        padding: 4px 8px;
        font-size: 11px;
    }
}

/* Responsive para tablets */
@media (min-width: 769px) and (max-width: 1024px) {
    .calendar-responsive {
        height: 550px;
    }

    .fc .fc-toolbar-title {
        font-size: 18px;
    }

    .fc-daygrid-day-number {
        font-size: 13px;
    }

    .fc-event-title {
        font-size: 11px;
    }
}

/* Para pantallas muy pequeñas */
@media (max-width: 480px) {
    .calendar-responsive {
        height: 400px;
    }

    .fc .fc-toolbar {
        flex-direction: column;
    }

    .fc .fc-toolbar-chunk {
        flex-direction: column;
        align-items: center;
    }

    .fc .fc-button {
        font-size: 11px;
        padding: 3px 6px;
        margin: 1px;
    }

    .fc .fc-toolbar-title {
        font-size: 14px;
    }

    .fc-daygrid-day-number {
        font-size: 11px;
    }

    /* Badges más pequeños */
    .badge {
        font-size: 8px;
        padding: 2px 4px;
    }
}

/* Ocultar días de otros meses */
.fc .fc-day-other {
    display: none !important;
    visibility: hidden !important;
}

/* Ocultar celdas vacías de otros meses */
.fc-daygrid-day.fc-day-other {
    display: none !important;
}

/* Asegurar que solo se muestren celdas del mes actual */
.fc-daygrid-day:not(.fc-day-other) {
    display: table-cell !important;
}

/* Resaltar día actual */
.fc .fc-day-today {
    background-color: #e3f2fd !important;
}

/* Responsive para eventos en móviles */
@media (max-width: 768px) {
    .fc-event {
        font-size: 10px;
        padding: 1px 2px;
        margin: 1px 0;
    }

    .fc-event-title {
        font-size: 9px;
    }
}
</style>
@endpush

@section('content')

    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-calendar"></i> Calendario CSA</h6>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <p>Categoria basada en que tipo de evento es, estos son solo administrado por directiva.</p>
                        <div class="w-100 mb-4">
                            <div id="calendar" class="calendar-responsive"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('module.schedule.create')
    @include('module.schedule.read')
    @include('module.schedule.assistant')
    @include('module.schedule.file')


@endsection

@push('script')
    <script>
        var datatableGuard;
        var datatableFile;

        $(function() {
            var selectedEvent = null;
            var calendarEl = $('#calendar')[0];
            var calendar = new FullCalendar.Calendar(calendarEl, {
                droppable: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay,listWeek'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día',
                    list: 'Lista'
                },
                views: {
                    dayGridMonth: {
                        titleFormat: { month: 'long', year: 'numeric' },
                        fixedWeekCount: true,
                        showNonCurrentDates: false,
                        displayEventTime: false
                    },
                    dayGridWeek: {
                        titleFormat: { month: 'short', day: 'numeric', year: 'numeric' }
                    },
                    dayGridDay: {
                        titleFormat: { month: 'short', day: 'numeric', year: 'numeric' }
                    },
                    listWeek: {
                        titleFormat: { month: 'short', day: 'numeric', year: 'numeric' }
                    }
                },
                navLinks: true,
                editable: true,
                displayEventTime: false,
                selectable: true,
                locale: 'es',
                height: 'auto',
                contentHeight: 'auto',
                aspectRatio: 1.8,
                windowResize: true,
                handleWindowResize: true,
                showNonCurrentDates: false,
                fixedWeekCount: false,
                events: @json($events),
                eventDidMount: function(info) {
                    const event = info.event;
                    const type = event.extendedProps.type;

                    // Cambiar colores según el tipo
                    switch(type) {
                        case 'Class':
                            info.el.style.backgroundColor = '#4f646b';
                            info.el.style.borderColor = '#4f646b';
                            break;
                        case 'Guard':
                            info.el.style.backgroundColor = '#D8433C';
                            info.el.style.borderColor = '#D8433C';
                            break;
                        default:
                            info.el.style.backgroundColor = '#CFA5B4';
                            info.el.style.borderColor = '#CFA5B4';
                    }

                    // Reemplazar el contenido de texto por el 'type'
                    const titleEl = info.el.querySelector('.fc-event-title');
                    if (titleEl && type) {
                        titleEl.textContent = info.event.extendedProps.type == 'Guard' ? 'Guardia' : (info.event.extendedProps.type == 'Event' ? 'Evento' : 'Clase');
                        titleEl.style.color = 'white';
                    }
                },
                windowResize: function() {
                    // Eliminar celdas de otros meses después de cada resize
                    setTimeout(function() {
                        $('.fc-day-other').closest('.fc-daygrid-day').remove();
                        $('.fc-daygrid-day[data-date]').each(function() {
                            const cellDate = $(this).data('date');
                            const currentMonth = new Date().getMonth();
                            const cellMonth = new Date(cellDate).getMonth();
                            if (cellMonth !== currentMonth) {
                                $(this).remove();
                            }
                        });
                    }, 100);
                },
                eventClick: function (info) {
                    selectedEvent = info.event;
                    $('#id_event').val(info.event.id);
                    $('#eventReadModal').modal('show');
                    $('#title_read').val(info.event.title);
                    $('#description_read').val(info.event.extendedProps.description);
                    $('#type_read').text(info.event.extendedProps.type == 'Guard' ? 'Guardia' : (info.event.extendedProps.type == 'Event' ? 'Evento' : 'Clase'));

                    const startDate = moment(info.event.start);
                    $('#start_read').val(startDate.isValid() ? startDate.format('DD-MM-YYYY') : 'N/A');

                    if (info.event.end) {
                        // end guardado es exclusivo para allDay; mostrar inclusivo restando 1 día
                        const endDate = moment(info.event.end).subtract(1, 'day');
                        $('#end_read').val(endDate.isValid() ? endDate.format('DD-MM-YYYY') : 'N/A');
                    } else {
                        $('#end_read').val(startDate.isValid() ? startDate.format('DD-MM-YYYY') : 'N/A');
                    }

                    if(datatableGuard){
                        datatableGuard.destroy();
                    }

                    datatableGuard = $('#datatableGuards').DataTable({
                        ajax: {
                            url: '/calendario/dataGuard/' + info.event.id,
                            dataSrc: '',
                            error: function(xhr) {
                             console.error('Error cargando guards:', xhr.responseText || xhr.statusText);
                            }
                        },
                        columns: [
                            {
                                data: null,
                                orderable: false,
                                searchable: false,
                                render: function(data,type,row){
                                    switch(data.type){
                                        case 'assitant':
                                            return `${data.voluntaries.name} ${data.voluntaries.lastname} <span class="text-xs text-lowercase badge bg-danger">guardia</span>`;
                                        case 'support':
                                            return `${data.voluntaries.name} ${data.voluntaries.lastname} <span class="text-xs text-lowercase badge bg-danger">apoyo</span>`;
                                        case 'leader':
                                            return `${data.voluntaries.name} ${data.voluntaries.lastname} <span class="text-xs text-lowercase badge bg-danger">lider</span>`;
                                        case 'speaker':
                                            return `${data.voluntaries.name} ${data.voluntaries.lastname} <span class="text-xs text-lowercase badge bg-danger">presentador</span>`;
                                        case 'guest':
                                            return `${data.voluntaries.name} ${data.voluntaries.lastname} <span class="text-xs text-lowercase badge bg-danger">invitado</span>`;
                                        default:
                                            return `${data.voluntaries.name} ${data.voluntaries.lastname} <span class="text-xs text-lowercase badge bg-danger">participante</span>`;
                                    }
                                }
                            },
                            {
                                data: null,
                                orderable: false,
                                searchable: false,
                                render: function(data, type, row) {
                                    return `
                                        <a onclick="deleteGuard(${data.id})" class="btn btn-danger text-white">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    `;
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
                        "<'row mb-2'<'col-md-6 d-flex align-items-center'B><'col-md-6'>>" +
                        "<'row'<'col-12'tr>>" +
                        "<'row mt-2'<'col-md-6'i><'col-md-6'p>>",
                    });

                    if(datatableFile){
                        datatableFile.destroy();
                    }

                    datatableFile = $('#datatableFile').DataTable({
                        ajax: {
                            url: '/calendario/dataFile/' + info.event.id,
                            dataSrc: '',
                            error: function(xhr) {
                             console.error('Error cargando guards:', xhr.responseText || xhr.statusText);
                            }
                        },
                        columns: [
                            { data: 'name' },
                            { data: 'type' },
                            {
                                data: null,
                                orderable: false,
                                searchable: false,
                                render: function(data) {
                                    return `<a href="${data.download_url}" class="btn btn-success">
                                                <i class="fa-solid fa-download"></i>
                                            </a>`;
                                }
                            }
                        ],
                        buttons: [

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
                        "<'row mb-2'<'col-md-6 d-flex align-items-center'B><'col-md-6'>>" +
                        "<'row'<'col-12'tr>>" +
                        "<'row mt-2'<'col-md-6'i><'col-md-6'p>>",
                    });
                },

                dateClick: function (info) {
                    $('#eventModal').modal('show');
                    $('#start').val(info.dateStr);
                }
            });

            calendar.render();

            $('#btnDeleteEvent').on('click', function() {
                const id = selectedEvent.id;

                $.ajax({
                    url: '/calendario/destroy/' + id,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        selectedEvent.remove();
                        $('#eventReadModal').modal('hide');
                        Swal.fire('Eliminado', 'Evento eliminado correctamente', 'success');
                    },
                    error: function() {
                        Swal.fire('Error', 'No se pudo eliminar el evento', 'error');
                    }
                });
            });

            $('#createFileEventForm').on('submit', function(e) {
                e.preventDefault();

                let formData = new FormData(this);
                formData.append('id_event', selectedEvent.id);

                for (let [key, value] of formData.entries()) {
                    console.log(key, value);
                    }

                $.ajax({
                    url: "{{ route('calendario.file.store') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        Swal.fire('Guardado', 'Archivo guardado correctamente', 'success');
                        $('#fileModal').modal('hide');
                        $('#createFileEventForm')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error al guardar el evento: ' + (xhr.responseJSON?.error || 'Error desconocido'));
                    }
                })
            })

            $('#createEventForm').on('submit', function(e) {
                e.preventDefault();
                const title = $('#title').val();
                const description = $('#description').val();
                const type = $('#type').val();
                const start = $('#start').val();
                const end = $('#end').val();

                $.ajax({
                    url: "{{ route('calendario.store') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        title: title,
                        description: description,
                        type: type,
                        start: start,
                        end: end
                    },
                    success: function(response) {
                        // Usar start/end devueltos por el servidor (end exclusivo ya ajustado)
                        calendar.addEvent({
                            id: response.event.id,
                            title: title,
                            description: description,
                            start: response.event.start,
                            end: response.event.end,
                            allDay: true,
                            extendedProps: {
                                type: type,
                                description: description
                            }
                        });

                        $('#eventModal').modal('hide');
                        $('#createEventForm')[0].reset();
                    },
                    error: function(xhr) {
                        alert('Error al guardar el evento: ' + (xhr.responseJSON?.message || 'Error desconocido'));
                    }
                });
            });

            $('#createAssistantEventForm').on('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(this);

                console.log('FormData contents:');
                for (let [key, value] of formData.entries()) {
                    console.log(key + ':', value);
                }

                $.ajax({
                    url: "{{ route('calendario.assistant.store') }}",
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        datatableGuard.ajax.reload();
                        $('#assistantModal').modal('hide');
                        $('#createAssistantEventForm')[0].reset();
                    },
                    error: function(xhr) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error.',
                            text: 'Error al guardar el guardia: ' + (xhr.responseJSON?.message || 'Error desconocido'),
                        });
                    }
                });
            });
        });

        function deleteGuard(id){
            console.log(id);
            $.ajax({
                url: '/calendario/assistant/destroy/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    datatableGuard.ajax.reload();
                },
                error: function(xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error.',
                        text: 'Error al guardar el guardia: ' + (xhr.responseJSON?.message || 'Error desconocido'),
                    });
                }
            })
        }
    </script>
@endpush
