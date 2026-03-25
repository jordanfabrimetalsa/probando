@extends('layout.main')

@section('title', 'Voluntario')

@section('content')

    <div class="container-fluid py-2">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-xl-4 mb-xl-0 mb-4">
                        <div class="card bg-transparent shadow-xl">
                            <div class="overflow-hidden position-relative border-radius-xl">
                                <img src="../assets/img/illustrations/pattern-tree.svg"
                                    class="position-absolute opacity-2 start-0 top-0 w-100 z-index-1 h-100"
                                    alt="pattern-tree">
                                <span class="mask bg-gradient-dark opacity-10"></span>
                                <div class="card-body position-relative z-index-1 p-3">
                                    <i class="material-symbols-rounded text-white p-2">wifi</i>
                                    <p>Cargo: {{ $voluntary->cargo->nombre }}</p>
                                    <h5 class="text-white mt-4 mb-5 pb-2">Cuerpo de Socorro Andino <span
                                            style="color:blanchedalmond">Delegación
                                            {{ $voluntary->delegation->name }}</span></h5>

                                    <div class="d-flex">
                                        <div class="d-flex">
                                            <div class="me-4">
                                                <p class="text-white text-sm opacity-8 mb-0">Tipo</p>
                                                <h6 class="text-white mb-0">
                                                    {{ $voluntary->type == 'V' ? 'Voluntario' : ($voluntary->type == 'A' ? 'Aspirante' : ($voluntary->type == 'C' ? 'Cooperador' : ($voluntary->type == 'H' ? 'Honorario' : 'Cooperador'))) }}
                                                </h6>
                                            </div>
                                            <div>
                                                <p class="text-white text-sm opacity-8 mb-0">Estado</p>
                                                <h6 class="text-white mb-0">
                                                    @switch($voluntary->status)
                                                        @case('A')
                                                            <span class="badge bg-success">Activo</span>
                                                        @break

                                                        @case('I')
                                                            <span class="badge bg-danger">Inactivo</span>
                                                        @break

                                                        @case('S')
                                                            <span class="badge bg-warning">Suspendido</span>
                                                        @break

                                                        @case('R')
                                                            <span class="badge bg-secondary">Receso</span>
                                                        @break

                                                        @default
                                                            <span>{{ $voluntary->status }}</span>
                                                    @endswitch
                                                </h6>
                                            </div>
                                        </div>
                                        <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                            <img class="w-60 mt-2" src="../assets/img/logo-socorro.png"" alt="logo">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="card h-100">
                                    <div class="card-header pb-0 p-3">
                                        <div class="row">
                                            <div class="col-6 d-flex align-items-center">
                                                <h6 class="mb-0">Información Personal</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Nombre
                                                    Completo:</strong> &nbsp; <span class="p-2 bg-gray-100"
                                                    id="fullname_show">{{ $voluntary->name . ' ' . $voluntary->lastname }}</span>
                                            </li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Número de
                                                    Identificación:</strong> &nbsp; <span class="p-2 bg-gray-100"
                                                    id="document_show">{{ $voluntary->document }}</span>
                                            </li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Genero:</strong> &nbsp; <span class="p-2 bg-gray-100"
                                                    id="gender_show">{{ $voluntary->gender }}</span>
                                            </li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Fecha de
                                                    Nacimiento:</strong> &nbsp; <span class="p-2 bg-gray-100"
                                                    id="birthday_show">{{ \Carbon\Carbon::parse($voluntary->birthday)->format('d/m/Y') }}</span></li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Edad</strong> &nbsp; <span class="p-2 bg-gray-100"
                                                    id="age_show">{{ \Carbon\Carbon::parse($voluntary->birthday)->age }}</span>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="card h-100">
                                    <div class="card-header pb-0 p-3">
                                        <div class="row">
                                            <div class="col-6 d-flex align-items-center">
                                                <h6 class="mb-0">Información adicional</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Profesión:</strong> &nbsp; <span
                                                    class="p-2 bg-gray-100"
                                                    id="profession_show">{{ $voluntary->profession }}</span></li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Dirección:</strong> &nbsp; <span
                                                    class="p-2 bg-gray-100"
                                                    id="address_show">{{ $voluntary->address }}</span></li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Teléfono:</strong> &nbsp; <span
                                                    class="p-2 bg-gray-100" id="phone_show">{{ $voluntary->phone }}</span>
                                            </li>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong
                                                    class="text-dark">Licencia Clase B:</strong> &nbsp; <span
                                                    class="p-2 bg-gray-100" id="phone_show">{{ $voluntary->license = 0 ? 'No' : 'Sí' }}</span>
                                            </li>
                                            <li class="mt-2">
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop">
                                                    <i class="material-symbols-rounded opacity-5">phone</i> N° Emergencias
                                                </button>
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop">
                                                    <i class="material-symbols-rounded opacity-5">send</i> Solicitud Receso
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mb-lg-0 mb-4">
                <div class="card mt-4">
                    <div class="card-header pb-0 p-3">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <h6 class="mb-0">Antecedentes Medicos</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-3 mb-md-0 mb-4">
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <h6 class="mb-0">
                                        Tipo
                                        Sangre:</strong> &nbsp; <span id="status_show" class="p-2 bg-gray-100">
                                            {{ $voluntary->blood_type }}
                                        </span>
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-3 mb-md-0 mb-4">
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <h6 class="mb-0">
                                        Enfermedad:</strong> &nbsp; <span id="status_show" class="p-2 bg-gray-100">
                                            {{ $voluntary->disease  = 0 ? 'No' : 'Sí' }}
                                        </span>
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-3 mb-md-0 mb-4">
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <h6 class="mb-0">
                                        Alergia:</strong> &nbsp; <span id="status_show" class="p-2 bg-gray-100">
                                            {{ $voluntary->allergic = 0 ? 'No' : 'Sí' }}
                                        </span>
                                    </h6>
                                </div>
                            </div>
                            <div class="col-md-3 mb-md-0 mb-4">
                                <div
                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                    <h6 class="mb-0">
                                        Medicamentos
                                        :</strong> &nbsp; <span id="status_show" class="p-2 bg-gray-100">
                                            {{ $voluntary->medicine = 0 ? 'No' : 'Sí' }}
                                        </span>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-7 mt-4">
                <div class="card">
                    <div class="card-header pb-0 px-3">
                        <h6 class="mb-0">Rescates Involucrados</h6>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <p class="text-body text-xs mb-3">Aquí se visualizan todos los rescates en las cuales se ha registrado tu participación.</p>
                        <ul class="list-group">
                            <li class="list-group-item border-0 ps-0 text-sm">
                                <strong class="text-dark">Inicio de Servicio:</strong>

                                @php
                                    $fecha = \Carbon\Carbon::parse($voluntary->init_voluntary);
                                    $diff = $fecha->diff(\Carbon\Carbon::now());
                                @endphp

                                <span class="p-2 bg-gray-100">
                                    {{ $fecha->format('d/m/Y') }}
                                </span>

                                <strong class="text-dark"> Tiempo Servicio:</strong>

                                <span class="p-2 bg-gray-100">
                                    {{ $diff->y }} años y {{ $diff->m }} meses
                                </span>

                                <strong class="text-dark"> Cantidad:</strong>

                                <span class="p-2 bg-gray-100">
                                    {{ count($rescues) }}
                                </span>
                            </li>
                        </ul>
                        @foreach($rescues as $filas)
                        <ul class="list-group">
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                <div class="d-flex flex-column">
                                    <h6 class="mb-3 text-sm">{{ $filas->tipo_emergencia }}</h6>
                                    <span class="mb-2 text-xs">Fecha: <span
                                            class="text-dark font-weight-bold ms-sm-2">{{ $filas->fecha_operativo }}</span></span>
                                    <span class="mb-2 text-xs">Lugar: <span
                                            class="text-dark ms-sm-2 font-weight-bold">{{ $filas->lugar }}</span></span>
                                    <span class="text-xs">Sexo: <span
                                            class="text-dark ms-sm-2 font-weight-bold">{{ $filas->sexo }}</span></span>
                                </div>
                                <!--<div class="ms-auto text-end">
                                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"><i
                                            class="material-symbols-rounded text-sm me-2">delete</i>Delete</a>
                                </div>-->
                            </li>
                        </ul>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-5 mt-4">
                <div class="card h-100 mb-4">
                    <div class="card-header pb-0 px-3">
                        <div class="row">
                            <div class="col-md-6">
                                <h6 class="mb-0">Anotaciones</h6>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pt-4 p-3">
                        <p class="text-body text-xs mb-3">Aquí se muestra las anotaciones positivas como negativas en base
                            al comportamiento del voluntario/aspirante.</p>
                        <ul class="list-group">
                            @foreach ($remark as $element)
                                @if (count($remark) > 0)
                                    <li
                                        class="list-group-item border-0 d-flex justify-content-between  mb-2 border-radius-lg p-2 bg-gray-100">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex flex-column">
                                                <h6 class="mb-1 text-dark text-sm"><strong>Responsable:
                                                    </strong>{{ $element->user ? $element->user->name . ' ' . $element->user->lastname : 'Sin usuario asignado' }}
                                                </h6>
                                                <p class="text-body text-xs mb-3"">{{ $element->remark }}</p>
                                                <span
                                                    class="text-xs">{{ $element->created_at->format('d M Y, H:i') }}</span>
                                            </div>
                                        </div>
                                        <div
                                            class="d-flex align-items-center text-{{ $element->gravity != '0' ? 'danger' : 'success' }} text-gradient text-sm font-weight-bold">
                                            @switch($element->gravity)
                                                @case('0')
                                                    Felicitaciones
                                                @break

                                                @case('1')
                                                    Nula
                                                @break

                                                @case('2')
                                                    Baja
                                                @break

                                                @case('3')
                                                    Media
                                                @break

                                                @case('4')
                                                    Alta
                                                @break

                                                @case('5')
                                                    Extrema
                                                @break

                                                @default
                                            @endswitch
                                        </div>
                                    </li>
                                @else
                                    <li
                                        class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                        <div class="d-flex align-items-center">
                                            No existe registro de anotaciones
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Contactos de emergencias</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <ul class="list-group">
                        @if (count($emergency) > 0)
                            @foreach ($emergency as $list)
                                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                    <div class="d-flex flex-column">
                                        <h6 class="mb-3 text-sm">Nombre: {{ $list->emergency_name }}</h6>
                                        <span class="mb-2 text-xs">Relación: <span
                                                class="text-dark font-weight-bold ms-sm-2">{{ $list->relationship }}</span></span>
                                        <span class="text-xs">Numero: <span
                                                class="text-dark ms-sm-2 font-weight-bold">{{ $list->emergency_phone }}</span></span>
                                    </div>
                                    <div class="ms-auto text-end">
                                        <a class="btn btn-danger text-white px-3 mb-0"
                                            href="tel:{{ $list->emergency_phone }}">
                                            <i class="material-symbols-rounded opacity-5 text-white"
                                                style="color: white;">phone</i>
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        @else
                            <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                                Sin números de emergencia registrado
                            </li>
                        @endif
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

@push('script')
    <script></script>
@endpush
