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