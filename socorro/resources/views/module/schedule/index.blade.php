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

@push('styles')
<style>
.schedule-shell{padding:8px 0 24px}.schedule-hero{display:flex;align-items:center;justify-content:space-between;gap:20px;margin-bottom:18px;padding:23px 25px;border-radius:18px;background:linear-gradient(135deg,#082f40,#176985);box-shadow:0 14px 34px rgba(8,47,64,.18);color:#fff}.schedule-hero__copy{display:flex;align-items:center;gap:15px}.schedule-hero__icon{display:grid;flex:0 0 50px;height:50px;place-items:center;border-radius:14px;background:#ea4e1a;font-size:1.25rem}.schedule-hero small{color:#ffad90;font-size:.57rem;font-weight:900;letter-spacing:.12em}.schedule-hero h1{margin:2px 0;color:#fff;font-size:1.35rem}.schedule-hero p{margin:0;color:#c0d5dd;font-size:.7rem}.schedule-legend{display:flex;align-items:center;gap:8px;padding:9px 12px;border:1px solid rgba(255,255,255,.16);border-radius:10px;background:rgba(255,255,255,.08);font-size:.65rem;font-weight:700}.schedule-legend i{color:#60d394;font-size:.5rem}.schedule-calendar-card{padding:20px;border:1px solid #d9e5e9;border-radius:18px;background:#fff;box-shadow:0 8px 28px rgba(14,53,68,.07)}#calendar.calendar-responsive{height:auto;min-height:620px}.schedule-calendar-card .fc{color:#294a57}.schedule-calendar-card .fc-toolbar{gap:12px;margin-bottom:18px!important}.schedule-calendar-card .fc-toolbar-title{color:#153d4d;font-size:1.15rem;font-weight:850;text-transform:capitalize}.schedule-calendar-card .fc-button{border:0!important;border-radius:8px!important;background:#eaf2f5!important;color:#315360!important;font-size:.7rem!important;font-weight:800!important;box-shadow:none!important}.schedule-calendar-card .fc-button-primary:not(:disabled).fc-button-active,.schedule-calendar-card .fc-button:hover{background:#0d4d63!important;color:#fff!important}.schedule-calendar-card .fc-today-button{background:#ea4e1a!important;color:#fff!important}.schedule-calendar-card .fc-scrollgrid{overflow:hidden;border:1px solid #dae5e9!important;border-radius:13px}.schedule-calendar-card th{border-color:#dce6e9!important;background:#eff5f7}.schedule-calendar-card .fc-col-header-cell-cushion{padding:11px 6px;color:#31515e;font-size:.66rem;font-weight:850;text-transform:uppercase}.schedule-calendar-card td{border-color:#e2eaed!important}.schedule-calendar-card .fc-daygrid-day-number{padding:8px;color:#526d78;font-size:.7rem;font-weight:750}.schedule-calendar-card .fc-day-today{background:#eef8fb!important}.schedule-calendar-card .fc-event{margin:2px 4px;padding:4px 6px;border:0!important;border-radius:6px;box-shadow:0 2px 5px rgba(25,55,67,.12);cursor:pointer}.schedule-calendar-card .fc-list{overflow:hidden;border:1px solid #dae5e9!important;border-radius:12px}.schedule-calendar-card .fc-list-day-cushion{background:#eaf3f6!important}.schedule-calendar-card .fc-list-event:hover td{background:#f2f8fa!important}
@media(max-width:767.98px){.schedule-shell{padding-top:0}.schedule-hero{align-items:flex-start;flex-direction:column;padding:18px;border-radius:14px}.schedule-hero__icon{display:none}.schedule-hero h1{font-size:1.15rem}.schedule-legend{width:100%;justify-content:center}.schedule-calendar-card{padding:12px;border-radius:14px}#calendar.calendar-responsive{min-height:540px}.schedule-calendar-card .fc-header-toolbar{align-items:stretch!important;flex-direction:column!important}.schedule-calendar-card .fc-toolbar-chunk{display:flex!important;justify-content:center!important;width:100%}.schedule-calendar-card .fc-toolbar-chunk:nth-child(2){order:-1}.schedule-calendar-card .fc-toolbar-title{font-size:1.05rem}.schedule-calendar-card .fc-button{padding:.52rem .68rem!important}.schedule-calendar-card .fc-list-event td{padding:10px 7px}.schedule-calendar-card .fc-list-event-title a{white-space:normal;font-size:.72rem}.schedule-calendar-card .fc-list-event-time{font-size:.62rem}.schedule-calendar-card .fc-daygrid-day-frame{min-height:65px}.schedule-calendar-card .fc-event{margin:1px 2px;padding:3px}.schedule-calendar-card .fc-event-title{font-size:.58rem!important}}
@media(max-width:420px){.schedule-calendar-card{margin:0 -4px;padding:9px}.schedule-calendar-card .fc-button{font-size:.62rem!important;padding:.48rem .58rem!important}}
</style>
@endpush

@section('content')

    <div class="container-fluid schedule-shell">
        <header class="schedule-hero"><div class="schedule-hero__copy"><span class="schedule-hero__icon"><i class="fa-regular fa-calendar-check"></i></span><div><small>PLANIFICACIÓN OPERATIVA</small><h1>Calendario de guardias</h1><p>Selecciona una fecha para crear una guardia y administra su dotación.</p></div></div><span class="schedule-legend"><i class="fa-solid fa-circle"></i> Guardias programadas</span></header>
        <section class="schedule-calendar-card"><div id="calendar" class="calendar-responsive"></div></section>
    </div>

    @include('module.schedule.create')
    @include('module.schedule.read')
    @include('module.schedule.assistant')


@endsection

@push('script')
    <script>
        var datatableGuard;

        $(function() {
            var selectedEvent = null;
            var calendarEl = $('#calendar')[0];
            const isMobileCalendar = window.innerWidth < 768;
            var calendar = new FullCalendar.Calendar(calendarEl, {
                droppable: true,
                initialView: isMobileCalendar ? 'listMonth' : 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: isMobileCalendar ? 'listMonth,dayGridMonth' : 'dayGridMonth,dayGridWeek,dayGridDay,listWeek'
                },
                buttonText: {
                    today: 'Hoy',
                    month: 'Mes',
                    week: 'Semana',
                    day: 'Día',
                    list: 'Lista',
                    listMonth: 'Agenda'
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
                    $('#title_read_display').text(info.event.title);
                    $('#description_read').val(info.event.extendedProps.description);
                    $('#type_read').text(info.event.extendedProps.type == 'Guard' ? 'Guardia' : (info.event.extendedProps.type == 'Event' ? 'Evento' : 'Clase'));
                    const isGuard = info.event.extendedProps.type === 'Guard';
                    $('#guardConfigurationForm').toggleClass('d-none', !isGuard).data('event-id', info.event.id);
                    $('#guard_enabled_read').prop('checked', Boolean(info.event.extendedProps.guard_enabled));
                    $('#guard_capacity_read').val(info.event.extendedProps.guard_capacity || '');
                    $('#guard_leader_read').val(info.event.extendedProps.guard_leader_id || '');

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
                            dataSrc: function(data) {
                                $('#guardParticipantCount').text(data.length + (data.length === 1 ? ' participante' : ' participantes'));
                                return data;
                            },
                            error: function(xhr) {
                             console.error('Error cargando guards:', xhr.responseText || xhr.statusText);
                            }
                        },
                        columns: [
                            {
                                data: null,
                                render: function(data) {
                                    const initials = `${data.voluntaries.name?.charAt(0) || ''}${data.voluntaries.lastname?.charAt(0) || ''}`;
                                    return `<div class="d-flex align-items-center gap-2"><span class="rounded-circle d-grid place-items-center fw-bold" style="width:34px;height:34px;background:#e7f3f6;color:#176985">${initials}</span><div class="text-start"><strong class="d-block text-dark">${data.voluntaries.name} ${data.voluntaries.lastname}</strong><small class="text-muted">Voluntario CSA</small></div></div>`;
                                }
                            },
                            {
                                data: 'type',
                                render: function(type) {
                                    const roles = {leader:['Jefe de guardia','fa-star','bg-warning text-dark'],support:['Apoyo','fa-handshake-angle','bg-info text-dark'],speaker:['Presentador','fa-bullhorn','bg-secondary'],guest:['Invitado','fa-user-tag','bg-light text-dark'],assistant:['Guardia','fa-shield-halved','bg-success']};
                                    const role = roles[type] || ['Participante','fa-user','bg-secondary'];
                                    return `<span class="badge ${role[2]} px-3 py-2"><i class="fa-solid ${role[1]} me-1"></i>${role[0]}</span>`;
                                }
                            },
                            {
                                data: null,
                                orderable: false,
                                searchable: false,
                                render: function(data, type, row) {
                                    if (data.type === 'leader') return '<span class="text-muted small"><i class="fa-solid fa-lock me-1"></i>Protegido</span>';
                                    return `<button type="button" onclick="deleteGuard(${data.id})" class="btn btn-sm btn-outline-danger mb-0" title="Retirar participante"><i class="fa-regular fa-trash-can"></i></button>`;
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

                },

                dateClick: function (info) {
                    $('#eventModal').modal('show');
                    $('#start').val(info.dateStr);
                    $('#end').val(info.dateStr).attr('min', info.dateStr);
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

            $('#createEventForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const description = form.find('#description').val();

                $.ajax({
                    url: "{{ route('calendario.store') }}",
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        // Usar start/end devueltos por el servidor (end exclusivo ya ajustado)
                        calendar.addEvent({
                            id: response.event.id,
                            title: response.event.title,
                            description: description,
                            start: response.event.start,
                            end: response.event.end,
                            allDay: true,
                            extendedProps: {
                                ...response.event.extendedProps
                            }
                        });

                        $('#eventModal').modal('hide');
                        $('#createEventForm')[0].reset();
                    },
                    error: function(xhr) {
                        const firstError = Object.values(xhr.responseJSON?.errors || {})[0]?.[0];
                        Swal.fire('No fue posible guardar', firstError || xhr.responseJSON?.message || 'Revise los datos ingresados.', 'error');
                    }
                });
            });

            $('#guardConfigurationForm').on('submit', function(e) {
                e.preventDefault();
                const form = $(this);
                const eventId = form.data('event-id');
                $.ajax({
                    url: '/calendario/guard/' + eventId,
                    type: 'POST',
                    data: form.serialize(),
                    success: function(response) {
                        selectedEvent.setExtendedProp('guard_enabled', $('#guard_enabled_read').is(':checked'));
                        selectedEvent.setExtendedProp('guard_capacity', Number($('#guard_capacity_read').val()));
                        selectedEvent.setExtendedProp('guard_leader_id', Number($('#guard_leader_read').val()));
                        datatableGuard.ajax.reload();
                        Swal.fire('Actualizada', response.message, 'success');
                    },
                    error: function(xhr) {
                        const firstError = Object.values(xhr.responseJSON?.errors || {})[0]?.[0];
                        Swal.fire('No fue posible actualizar', firstError || xhr.responseJSON?.message || 'Revise los datos.', 'error');
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
