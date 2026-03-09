@extends('layout.main')

@section('title', 'Registro de Rescate')

@section('content')
    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2">
                        <div class="bg-gradient-dark border-radius-lg pt-4 pb-3">
                            <h6 class="text-white text-capitalize ps-3"><i class="fa-solid fa-map-location-dot"></i> Registro
                                de Rescate</h6>
                        </div>
                    </div>
                    <div class="card-body p-4">
                        <div class="w-100 p-2 mb-4">
                            <form id="formRescue" class="form" method="POST">
                                @csrf
                                <div class="border mb-4">
                                    <div class="row p-2">
                                        <h5 class="modal-title mb-2">1.- Datos generales del operativo</h5>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Fecha del Operativo</label>
                                            <input type="date" name="fecha_operativo" id="fecha_operativo" {{ old('fecha_operativo') }} class="form-control" placeholder="Fecha del Operativo">
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Hora del llamado de emergencia</label>
                                            <input type="time" name="hora_llamado" id="hora_llamado" {{ old('hora_llamado') }} class="form-control" placeholder="Hora del llamado de emergencia">
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                                            <label for="type" class="form-label">Tipo de Emergencia</label>
                                            <select class="form-select border border-gray p-2"
                                                aria-label="Default select example" value="{{ old('type') }}"
                                                name="type">
                                                <option selected>Seleccione el Tipo</option>
                                                <option value="rescate_en_altura">Rescate en Altura</option>
                                                <option value="persona_lesionada">Persona Lesionada</option>
                                                <option value="persona_extraviada">Persona Extraviada</option>
                                                <option value="varada">Varada (sin ver ruta de regreso)</option>
                                                <option value="recuperacion">Recuperación</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                                            <label>Nombre de quien realiza el llamado</label>
                                            <input type="text" name="nombre_llamado" id="nombre_llamado" {{ old('nombre_llamado') }} class="form-control" placeholder="Nombre de quien realiza el llamado">
                                        </div>
                                        <div class="mb-3 col-lg-4 col-md-6 col-sm-12">
                                            <label>Telefono</label>
                                            <input type="text" name="telefono" id="telefono" {{ old('telefono') }} class="form-control" value="+569">
                                        </div>
                                    </div>

                                    <div class="row p-2">
                                        <h5 class="modal-title mb-2">2.- Información de la persona lesionada/afectada</h5>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Nombre Completo</label>
                                            <input type="text" name="nombre_completo" id="nombre_completo" {{ old('nombre_completo') }} class="form-control" placeholder="Nombre Completo">
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>RUT/DNI</label>
                                            <input type="text" name="rut_dni" id="rut_dni" {{ old('rut_dni') }} class="form-control" placeholder="Rut/DNI">
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Edad</label>
                                            <input type="number" name="edad" id="edad" {{ old('edad') }} class="form-control" placeholder="Edad">
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Sexo</label>
                                            <select class="form-select border border-gray p-2" aria-label="Default select example" value="{{ old('sexo') }}" name="sexo">
                                                <option selected>Seleccione el Sexo</option>
                                                <option value="masculino">Masculino</option>
                                                <option value="femenino">Femenino</option>
                                                <option value="otro">Otro</option>
                                            </select>
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Estatura aproximada (cm)</label>
                                            <input type="number" name="estatura" id="estatura" {{ old('estatura') }} class="form-control" placeholder="Estatura">
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Peso aproximado (kg)</label>
                                            <input type="number" name="peso" id="peso" {{ old('peso') }} class="form-control" placeholder="Peso">
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Telefono</label>
                                            <input type="text" name="telefono_afectado" id="telefono_afectado" {{ old('telefono_afectado') }} class="form-control" value="+569">
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Condición física aparente al momento del encuentro</label>
                                            <select class="form-select border border-gray p-2" aria-label="Default select example" value="{{ old('condicion_fisica') }}" name="condicion_fisica">
                                                <option selected>Seleccione la Condición Física</option>
                                                <option value="Consciente">Consciente</option>
                                                <option value="Inconsciente">Inconsciente</option>
                                                <option value="Fellecido">Fellecido</option>
                                                <option value="Dolor visible">Dolor visible</option>
                                                <option value="Lesión expuesta">Lesión expuesta</option>
                                                <option value="Buen estado de salud">Buen estado de salud</option>
                                                <option value="Nevios@">Nevios@</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row p-2">
                                        <h5 class="modal-title mb-2">3.- Ubicación</h5>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Lugar exacto del incidente</label>
                                            <input type="text" name="lugar_exacto" id="lugar_exacto" {{ old('lugar_exacto') }} class="form-control" placeholder="Lugar exacto">
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Latitud</label>
                                            <input type="text" name="latitud" id="latitud" {{ old('latitud') }} class="form-control" placeholder="Latitud">
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Longitud</label>
                                            <input type="text" name="longitud" id="longitud" {{ old('longitud') }} class="form-control" placeholder="Longitud">
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Altitud(MSNM)</label>
                                            <input type="text" name="altitud" id="altitud" {{ old('altitud') }} class="form-control" placeholder="Altitud">
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Ubicación de vehículo/s de rescate</label>
                                            <input type="text" name="ubicacion_vehiculo_rescate" id="ubicacion_vehiculo_rescate" {{ old('ubicacion_vehiculo_rescate') }} class="form-control" placeholder="Ubicación de vehículo/s de rescate">
                                        </div>
                                    </div>



                                    <div class="row p-2">
                                        <h5 class="modal-title mb-2">4.- Situación inicial</h5>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Lugar exacto del incidente</label>
                                            <input type="text" name="lugar_exacto" id="lugar_exacto" {{ old('lugar_exacto') }} class="form-control" placeholder="Lugar exacto">
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Latitud</label>
                                            <input type="text" name="latitud" id="latitud" {{ old('latitud') }} class="form-control" placeholder="Latitud">
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Longitud</label>
                                            <input type="text" name="longitud" id="longitud" {{ old('longitud') }} class="form-control" placeholder="Longitud">
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Altitud(MSNM)</label>
                                            <input type="text" name="altitud" id="altitud" {{ old('altitud') }} class="form-control" placeholder="Altitud">
                                        </div>
                                        <div class="mb-3 col-lg-6 col-md-6 col-sm-12">
                                            <label>Ubicación de vehículo/s de rescate</label>
                                            <input type="text" name="ubicacion_vehiculo_rescate" id="ubicacion_vehiculo_rescate" {{ old('ubicacion_vehiculo_rescate') }} class="form-control" placeholder="Ubicación de vehículo/s de rescate">
                                        </div>
                                    </div>
                                </div>








                                <div class="border mb-4">
                                    <div class="row p-2">
                                        <h5 class="modal-title mb-2 text-center">Estado Actual</h5>
                                        <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                                            <label for="name_accident" class="form-label">Jefe de Operaciones</label>
                                            <select class="form-select border border-gray p-2"
                                                aria-label="Default select example" name="voluntary_id"
                                                value="{{ old('voluntary_id') }}">
                                                <option selected>Seleccione</option>
                                                @foreach ($voluntaries as $voluntary)
                                                    <option value="{{ $voluntary->id }}">{{ $voluntary->name }}
                                                        {{ $voluntary->lastname }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="mb-2 col-lg-6 col-md-6 col-sm-12">
                                            <label for="transport" class="form-label">Estado de Emergencia</label>
                                            <select class="form-select border border-gray p-2"
                                                aria-label="Default select example" name="situation"
                                                value="{{ old('situation') }}">
                                                <option selected>Seleccione</option>
                                                <option value="pending">Pendiente</option>
                                                <option value="in_progress">En Proceso</option>
                                                <option value="completed">Completado</option>
                                            </select>
                                        </div>
                                        <div class="mb-2 col-lg-12 col-md-12 col-sm-12">
                                            <label for="observations" class="form-label">Observación</label>
                                            <textarea class="form-control border border-gray p-2" id="observations" value="{{ old('observations') }}"
                                                name="observations" aria-describedby="emailHelp"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i>
                                    Agregar Rescate</button>
                            </form>
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
        var datatableRescue;

        $(document).ready(function() {
            datatableRescue = $('#datatableRescue').DataTable({
                ajax: {
                    url: '{{ route('registro-rescate.data') }}',
                    dataSrc: ''
                },
                columns: [{
                        data: 'name_accident',
                        render: function(data) {
                            return data = '<p class="text-xs text-secondary mb-0">' + data + '</p>'
                        }
                    },
                    {
                        data: 'type',
                        render: function(data) {
                            return data == 'accident' ?
                                '<span class="badge bg-info">Accidente</span>' :
                                data == 'search' ?
                                '<span class="badge bg-info">Busqueda</span>' :
                                '<span class="badge bg-info">Recuperación</span>';
                        }
                    },
                    {
                        data: 'place',
                        render: function(data) {
                            return data = '<p class="text-xs text-secondary mb-0">' + data + '</p>'
                        }
                    },
                    {
                        data: 'date_start_trek',
                        render: function(data) {
                            return data = '<p class="text-xs text-secondary mb-0">' + moment(data)
                                .format('DD/MM/YYYY HH:mm:ss') + '</p>'
                        }
                    },
                    {
                        data: 'situation',
                        render: function(data) {
                            return data == 'pending' ?
                                '<span class="badge bg-success">Pendiente</span>' :
                                data == 'in_progress' ?
                                '<span class="badge bg-warning">En Proceso</span>' :
                                '<span class="badge bg-danger">Completado</span>';
                        }
                    },
                    {
                        data: null,
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row) {
                            return `
                      <a href="javascript:;" class="btn btn-info text-white" onclick="showRescue(${data.id})" data-bs-toggle="modal" data-bs-target="#ShowModal">
                        <i class="fa-solid fa-map-location-dot"></i>
                      </a>
                      <a href="/registro-rescate/pdf/${data.id}" target="_blank" class="btn btn-dark text-white">
                        <i class="fa-solid fa-file-pdf"></i>
                      </a>
                      <a onclick="deleteRescue(${data.id})" class="btn btn-danger text-white">
                        <i class="fa-solid fa-trash"></i>
                      </a>
                      `;
                        }
                    }
                ],
                buttons: [{
                        text: '<i class="fa-solid fa-circle-plus"></i>',
                        className: 'btn btn-dark me-2',
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
                order: [
                    [3, 'asc']
                ],
            });

        });

        $('#formRescue').submit(function(e) {
            e.preventDefault();
            let formData = $(this).serialize();

            $.ajax({
                url: '{{ route('registro-rescate.store') }}',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Mostrar mensaje desde el backend
                    Swal.fire({
                        icon: response.status === 'success' ? 'success' : 'warning',
                        title: response.status === 'success' ? 'Éxito' : 'Aviso',
                        text: response.message,
                    });

                    if (response.status === 'success') {
                        $('#formRescue')[0].reset();
                        datatableRescue.ajax.reload();
                        $('#CreateModal').modal('hide');
                    }
                },
                error: function(xhr) {
                    let msg = 'Error al registrar rescate';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        msg += ': ' + xhr.responseJSON.message;
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: msg,
                    });
                    $('#CreateModal').modal('hide');
                }
            });
        });

        $('#formRescueUpdate').submit(function(e) {
            e.preventDefault();

            // Copiar valores actuales de selects deshabilitados a inputs hidden antes de serializar
            $('#type_show_hidden').val($('#type_show').val());
            $('#weather_show_hidden').val($('#weather_show').val());
            $('#helper_external_show_hidden').val($('#helper_external_show').val());
            $('#external_helper_show_hidden').val($('#external_helper_show').val());
            $('#Stretcher_show_hidden').val($('#Stretcher_show').val());
            $('#type_transport_show_hidden').val($('#type_transport_show').val());
            $('#helicopter_show_hidden').val($('#helicopter_show').val());
            $('#voluntary_id_show_hidden').val($('#voluntary_id_show').val());

            let formData = $(this).serialize();
            let id = $('#id_show').val();

            $.ajax({
                url: '{{ url('registro-rescate/update') }}/' + id,
                type: 'POST',
                data: formData,
                success: function(response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Éxito.',
                        text: response.message,
                    });
                    $('#ShowModal').modal('hide');
                    $('#formRescueUpdate')[0].reset();
                    datatableRescue.ajax.reload();
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error.',
                        text: 'Error al editar rescate',
                    });
                    $('#ShowModal').modal('hide');
                }
            });
        });

        function showRescue(id) {
            $.ajax({
                url: 'registro-rescate/show/' + id,
                type: 'GET',
                success: function(response) {
                    console.log(response.data.voluntary_name, response.data.voluntary_lastname);
                    console.log(response.data);
                    $('#type_show').val(response.data.type);

                    $('#place_show').val(response.data.place);
                    $('#road_show').val(response.data.road);
                    $('#weather_show').val(response.data.weather);

                    $('#Stretcher_show').val(response.data.Stretcher);
                    $('#address_show').val(response.data.address);
                    $('#city_show').val(response.data.city);

                    // Formatear a datetime-local (YYYY-MM-DDTHH:mm)
                    const toLocalDT = v => v ? v.replace(' ', 'T').slice(0, 16) : '';
                    $('#created_at_show').val(response.data.created_at);
                    $('#date_call_show').val(toLocalDT(response.data.date_call));
                    $('#date_finish_rescue_show').val(toLocalDT(response.data.date_finish_rescue));
                    $('#date_middle_trek_show').val(toLocalDT(response.data.date_middle_trek));
                    $('#date_start_trek_show').val(toLocalDT(response.data.date_start_trek));

                    $('#kilometer_total_show').val(response.data.kilometer_total);
                    $('#different_height_show').val(response.data.different_height);
                    $('#quantity_people_show').val(response.data.quantity_people);
                    $('#quantity_voluntaries_show').val(response.data.quantity_voluntaries);
                    $('#helper_external_show').val(response.data.helper_external);
                    $('#external_helper_show').val(response.data.external_helper);
                    $('#allergic_show').val(response.data.allergic);
                    $('#disease_show').val(response.data.disease);
                    $('#gravity_show').val(response.data.gravity);
                    $('#helicopter_show').val(response.data.helicopter);
                    $('#medical_assistance_show').val(response.data.medical_assistance);
                    $('#injury_show').val(response.data.injury);
                    $('#observations_show').val(response.data.observations);
                    $('#phone_accident_show').val(response.data.phone_accident);
                    $('#email_accident_show').val(response.data.email_accident);
                    $('#name_accident_show').val(response.data.name_accident);
                    $('#user_id_show').val(response.data.user_id);
                    $('#type_transport_show').val(response.data.type_transport);
                    $('#situation_show').val(response.data.situation);
                    $('#state_show').val(response.data.state);
                    $('#id_show').val(response.data.id);

                    $('#type_show_hidden').val(response.data.type);
                    $('#weather_show_hidden').val(response.data.weather);
                    $('#helper_external_show_hidden').val(response.data.helper_external);
                    $('#external_helper_show_hidden').val(response.data.external_helper);

                    $('#Stretcher_show_hidden').val(response.data.Stretcher);
                    $('#medical_assistance_show_hidden').val(response.data.medical_assistance);
                    $('#type_transport_show_hidden').val(response.data.type_transport);
                    $('#helicopter_show_hidden').val(response.data.helicopter);

                    const id = response.data.voluntario_id;
                    const name = (response.data.voluntary_name || '').trim();
                    const lastname = (response.data.voluntary_lastname || '').trim();
                    const label = `${name} ${lastname}`.trim();
                    const $sel = $('#voluntary_id_show');

                    // si existe la opción, actualiza su texto y selección
                    const $opt = $sel.find(`option[value='${id}']`);
                    if ($opt.length) {
                        $opt.text(label);
                        $sel.val(id);
                    } else {
                        // si no existe, agrégala y selecciónala sin tocar el resto del foreach
                        $sel.append(new Option(label, id, true, true));
                    }

                    $('#voluntary_id_show_hidden').val(response.data.voluntario_id);

                    if (response.data.situation == 'completed') {
                        $('#button-update-rescue').prop('disabled', true);

                        $('#kilometer_total_show').prop('disabled', true);
                        $('#different_height_show').prop('disabled', true);
                        $('#quantity_people_show').prop('disabled', true);

                        $('#phone_accident_show').prop('disabled', true);
                        $('#email_accident_show').prop('disabled', true);
                        $('#address_show').prop('disabled', true);

                        $('#city_show').prop('disabled', true);
                        $('#state_show').prop('disabled', true);

                        $('#allergic_show').prop('disabled', true);
                        $('#disease_show').prop('disabled', true);

                        $('#gravity_show').prop('disabled', true);
                        $('#injury_show').prop('disabled', true);
                        $('#observations_show').prop('disabled', true);

                        $('#user_id_show').prop('disabled', true);
                        $('#situation_show').prop('disabled', true);

                        $('#voluntary_id_show').prop('disabled', true);
                    } else {
                        $('#button-update-rescue').prop('disabled', false);

                        $('#kilometer_total_show').prop('disabled', false);
                        $('#different_height_show').prop('disabled', false);
                        $('#quantity_people_show').prop('disabled', false);

                        $('#phone_accident_show').prop('disabled', false);
                        $('#email_accident_show').prop('disabled', false);
                        $('#address_show').prop('disabled', false);

                        $('#city_show').prop('disabled', false);
                        $('#state_show').prop('disabled', false);

                        $('#allergic_show').prop('disabled', false);
                        $('#disease_show').prop('disabled', false);

                        $('#gravity_show').prop('disabled', false);
                        $('#injury_show').prop('disabled', false);
                        $('#observations_show').prop('disabled', false);

                        $('#user_id_show').prop('disabled', false);
                        $('#situation_show').prop('disabled', false);

                        $('#voluntary_id_show').prop('disabled', false);
                    }
                },
                error: function(error) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error al mostrar rescate: ' + JSON.stringify(error),
                    });
                }
            });
        }

        function deleteRescue(id) {
            swal.fire({
                title: '¿Estas seguro de eliminar este rescate?',
                text: "No podrás revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, eliminarlo'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: 'registro-rescate/destroy/' + id,
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(response) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Éxito.',
                                text: response.message,
                            });
                            datatableRescue.ajax.reload();
                        },
                        error: function(error) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Error.',
                                text: 'Error al eliminar rescate: ' + JSON.stringify(error),
                            });
                        }
                    });
                }
            });
        }
    </script>
@endpush
