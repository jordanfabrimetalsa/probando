@extends('layout.main')

@section('title', 'Horarios')

@section('content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-user-gear"></i>Calendario CSA</h6>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="w-100 p-2 mb-4">
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
                        <label for="title" class="form-label">Título</label>
                        <textarea class="form-control" id="description" name="description" required>
                        </textarea>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('script')
    <script>
      $(function() {
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
                console.log(info);
                $('#eventReadModal').modal('show');
                $('#title_read').val(info.event.title);
                $('#description_read').val(info.event.extendedProps.description);
                $('#type_read').text(info.event.extendedProps.type == 'Guard' ? 'Guardia' : 'Clase');
                
                const startDate = moment(info.event.start);
                $('#start_read').val(startDate.isValid() ? startDate.format('DD-MM-YYYY') : 'N/A');
                
                if (info.event.end) {
                    const endDate = moment(info.event.end);
                    const displayEndDate = info.event.allDay ? endDate.subtract(1, 'day') : endDate;
                    $('#end_read').val(displayEndDate.isValid() ? displayEndDate.format('DD-MM-YYYY') : 'N/A');
                } else {
                    $('#end_read').val(startDate.isValid() ? startDate.format('DD-MM-YYYY') : 'N/A');
                }
            },
            dateClick: function (info) {
                $('#eventModal').modal('show');
                $('#start').val(info.dateStr);
            }
        });
        calendar.render();

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
      });
    </script>
@endpush