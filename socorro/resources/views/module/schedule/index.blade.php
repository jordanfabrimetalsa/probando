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
                        <div class="btn-group text-center" role="group" aria-label="Basic mixed styles example">
                            <button type="button" class="btn" style="background: #4f646b; color: white;">Clases</button>
                            <button type="button" class="btn" style="background: #D8433C; color: white;">Guardias</button>
                            <button type="button" class="btn" style="background: #CFA5B4; color: white;">Eventos</button>
                        </div>
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
                    <div>
                        <label>Inicio:</label>
                        <input type="text" class="form-control" id="start_read" name="start_read" disabled>
                    </div>
                    <div>
                        <label>Termino:</label>
                        <input type="text" class="form-control" id="end_read" name="end_read" disabled>
                    </div>

                    <hr>
                    <div class="btn-group text-center" role="group" aria-label="Basic mixed styles example">
                        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#assistantModal">Agregar</button>
                        <button type="button" id="btnDeleteEvent" class="btn btn-danger">Eliminar</button>
                    </div>

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
                                        <option value="{{ $voluntary->id }}">{{ $voluntary->name }}</option>
                                    @endforeach
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
    
    // Calendario ------------------------------------------------------------------------------>

    $(function() {
        var selectedEvent = null;
        var datatableGuard;
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
            eventRender: function(info) {
                var event = info.event;
                var type = event.extendedProps.type || 'default';
                
                switch(type) {
                    case 'Class':
                        info.backgroundColor = '#4f646b';
                        info.borderColor = '#4f646b';
                        break;
                    case 'Guard':
                        info.backgroundColor = '#D8433C';
                        info.borderColor = '#D8433C';
                        break;
                    default:
                        info.backgroundColor = '#CFA5B4';
                        info.borderColor = '#CFA5B4';
                }
                
                if (event.title) {
                    info.el.querySelector('.fc-event-title').textContent = event.title;
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
                        { data: null,
                          orderable: false,
                          searchable: false,
                          render: function(data,type,row){
                            return `${data.voluntaries.name} ${data.voluntaries.lastname}`
                          }
                         },
                        {
                            data: null,
                            orderable: false,
                            searchable: false,
                            render: function(data, type, row) {
                                return `
                                    <a href="javascript:;" class="btn btn-dark text-white" onclick="editVoluntary(${data.id})" data-bs-toggle="modal" data-bs-target="#EditModal">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a onclick="deleteVoluntary(${data.id})" class="btn btn-danger text-white">
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
                        selectedEvent.remove(); // Remueve de FullCalendar
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
            
            $.ajax({
                url: "{{ route('calendario.assistant.store') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id_event: id_event,
                    id_user: id_user
                },
                success: function(response) {
                    datatableGuard.ajax.reload();
                    $('#assistantModal').modal('hide');
                    $('#createAssistantEventForm')[0].reset();
                },
                error: function(xhr) {
                    alert('Error al guardar el evento: ' + (xhr.responseJSON?.message || 'Error desconocido'));
                }
            });
        });
    });
      // Calendario ------------------------------------------------------------------------------>

    </script>
@endpush