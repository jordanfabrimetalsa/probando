@extends('layout.main')

@section('title', 'Horarios')

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
                            <div id="calendar" style="height: 600px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="eventModal" tabindex="-1" aria-labelledby="eventModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="createEventForm" method="POST">
                @csrf
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="eventModalLabel">Crear evento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>
                    <div class="mb-3">
                        <label for="title" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Tipo Evento</label>
                        <select class="form-selected form-control" id="type" name="type">
                            <option disabled selected>Seleccionar</option>
                            <option value="Guard">Guardia</option>
                            <option value="Class">Clase</option>
                            <option value="Event">Evento</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Inicio</label>
                        <input type="date" class="form-control" id="start" name="start" readonly required>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Termino</label>
                        <input type="date" class="form-control" id="end" name="end" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Guardar</button>
                </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="eventReadModal" tabindex="-1" aria-labelledby="eventReadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="eventReadModalLabel">Tipo de Evento es <span class="badge bg-danger" id="type_read"></span></h6>
                </div>
                <div class="modal-body">
                    <p class="text-dark">Información detallada.</p>
                    <div>
                        <label>Titulo:</label>
                        <input type="text" class="form-control" id="title_read" name="title_read" disabled>
                    </div>
                    <div>
                        <label>Descripcion:</label>
                        <textarea id="description_read" name="description_read" class="form-control" disabled></textarea>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label>Inicio:</label>
                            <input type="text" class="form-control" id="start_read" name="start_read" disabled>
                        </div>
                        <div class="col-6">
                            <label>Termino:</label>
                            <input type="text" class="form-control" id="end_read" name="end_read" disabled>
                        </div>
                    </div>

                    <br>

                    <div class="btn-group text-center" role="group" aria-label="Basic mixed styles example">
                        <button type="button" id="btnDeleteEvent" class="btn btn-danger"><i class="fa-solid fa-calendar-xmark"></i> Eliminar Evento</button>
                    </div>

                    <div class="border border-radius-sm p-2">
                        <table id="datatableGuards" class="table table-striped dt-responsive nowrap" style="width: 100%;">
                            <thead class="bg-gradient-dark text-center">
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Nombre</th>
                                    <th class="text-uppercase text-secondary text-xxs text-white font-weight-bolder text-center">Asignación</th>
                                </tr>
                            </thead>
                            <tbody class="text-center">
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="assistantModal" tabindex="-1" aria-labelledby="assistantModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-body">
                <form id="createAssistantEventForm" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="eventModalLabel">Ingresar Participante</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <input type="hidden" id="id_event" name="id_event">
                                <label for="date" class="form-label">Tipo Evento</label>
                                <select class="form-selected form-control" id="id_user" name="id_user">
                                    <option disabled selected>Seleccionar</option>
                                    @foreach($voluntaries as $voluntary)
                                        <option value="{{ $voluntary->id }}">{{ $voluntary->name }} {{ $voluntary->lastname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Tipo Asignación</label>
                                <select class="form-selected form-control" id="assign" name="assign">
                                    <option selected disabled>Seleccionar Opción</option>
                                    <option value="assitant">Asistente/Guardia</option>
                                    <option value="support">Apoyo</option>
                                    <option value="leader">Lider</option>
                                    <option value="speaker">Presentador</option>
                                    <option value="guest">Invitado</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success">Ingresar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
        var datatableGuard;

        $(function() {
            var selectedEvent = null;
            var calendarEl = $('#calendar')[0];
            var calendar = new FullCalendar.Calendar(calendarEl, {
                droppable: true,
                headerToolbar: {
                    left: 'prevYear,prev,next,nextYear today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek,dayGridDay',                    
                },
                buttonText: {
                    today: 'Hoy',
                    dayGridMonth: 'Mensual',
                    dayGridWeek: 'Semanal',
                    dayGridDay: 'Diario',
                    listMonth: 'Listado'
                },
                navLinks: true,
                editable: true,
                displayEventTime: false,
                selectable: true,
                locale: 'es',
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
                        const endDate = moment(info.event.end);
                        const displayEndDate = info.event.allDay ? endDate.subtract(1, 'day') : endDate;
                        $('#end_read').val(displayEndDate.isValid() ? displayEndDate.format('DD-MM-YYYY') : 'N/A');
                    } else {
                        $('#end_read').val(startDate.isValid() ? startDate.format('DD-MM-YYYY') : 'N/A');
                    }

                    if(datatableGuard){
                        datatableGuard.destroy();
                    }

                    datatableGuard = $('#datatableGuards').DataTable({
                        ajax: {
                            url: '/calendario/dataGuard/' + info.event.id,
                            dataSrc: ''
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
                                text: '<i class="fa-solid fa-user-plus"></i>',
                                className: 'btn btn-dark me-2',
                                action: () => $("#assistantModal").modal('show')
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
                    })
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
                        calendar.addEvent({
                            title: title,
                            description: description,
                            start: start,
                            end: end,
                            allDay: true,
                            extendedProps: {
                                type: type
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
                const id_event = $('#id_event').val();
                const id_user = $('#id_user').val();
                const assign = $('#assign').val();
                
                $.ajax({
                    url: "{{ route('calendario.assistant.store') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id_event: id_event,
                        id_user: id_user,
                        assign: assign
                    },
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