<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informe del Rescate {{ $rescue->id }}</title>
    <style>
        @page {
            margin: 0.25in;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #fff;
        }

        .page-header {
            margin-top: 0;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            padding-bottom: 20px;
            border-bottom: 1px solid #ccc;
        }

        .rescue-section {
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .rescue-section h3 {
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .rescue-section p {
            margin-bottom: 5px;
            font-size: 14px;
        }

        .patient-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .patient-section .patient-info {
            width: 50%;
        }

        .patient-section .patient-info h3 {
            margin-bottom: 10px;
            font-size: 18px;
            font-weight: bold;
        }

        .patient-section .patient-info p {
            margin-bottom: 5px;
            font-size: 14px;
        }

        .patient-section .patient-info img {
            width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .footer {
            text-align: center;
            font-size: 12px;
            margin-top: 20px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="page-header">
        Informe del Rescate {{ $rescue->id }}
    </div>

    <div class="rescue-section">
        <h3>Datos generales del rescate</h3>
        <p><strong>Fecha:</strong> {{ date('d/m/Y H:i:s', strtotime($rescue->date_start_trek)) }}</p>
        <p><strong>Tipo de rescate:</strong> {{ $rescue->type == 'accident' ? 'Accidente' : ($rescue->type == 'search' ? 'Busqueda' : 'Recuperación') }}</p>
        <p><strong>Lugar:</strong> {{ ucwords($rescue->place) }}</p>
        <p><strong>Ruta:</strong> {{ ucwords($rescue->road) }}</p>
        <p><strong>Estado:</strong> {{ $rescue->situation == 'completed' ? 'Completado' : 'En proceso' }}</p>
        <p><strong>Ayuda Externa:</strong> {{ $rescue->helper_external == 'yes' ? 'Si' : 'No' }}</p>
        <p><strong>Entidad:</strong> {{ ucwords($rescue->external_helper) }}</p>
    </div>

    <div class="patient-section">
        <div class="patient-info">
            <h3>Datos del paciente</h3>
            <p><strong>Nombre:</strong> {{ ucwords($rescue->name_accident) }}</p>
            <p><strong>Telefono:</strong> {{ $rescue->phone_accident }}</p>
            <p><strong>Email:</strong> {{ $rescue->email_accident }}</p>
            <p><strong>Dirección:</strong> {{ ucwords($rescue->address) }}, {{ ucwords($rescue->city) }}</p>
            <p><strong>Enfermedad:</strong> {{ $rescue->disease == 'yes' ? 'Si' : 'No' }}</p>
            <p><strong>Alérgico:</strong> {{ $rescue->allergic == 'yes' ? 'Si' : 'No' }}</p>
        </div>
    </div>

    <div class="patient-section">
        <div class="patient-info">
            <h3>Datos respecto al rescate</h3>
            <p><strong>Fecha de llamada:</strong> {{ date('d/m/Y H:i:s', strtotime($rescue->date_call)) }}</p>
            <p><strong>Fecha de inicio del rescate:</strong> {{ date('d/m/Y H:i:s', strtotime($rescue->date_start_trek)) }}</p>
            <p><strong>Fecha de fin del rescate:</strong> {{ date('d/m/Y H:i:s', strtotime($rescue->date_finish_rescue)) }}</p>
            <p><strong>Kilometraje:</strong> {{ $rescue->kilometer_total }} KM</p>
            <p><strong>Desnivel:</strong> {{ number_format(intval($rescue->different_height), 0, '', '.') }} MSNM</p>
            <p><strong>Rescatados:</strong> {{ $rescue->quantity_people }} Cant.</p>
            <p><strong>Voluntarios:</strong> {{ $rescue->quantity_voluntaries }} Cant.</p>
        </div>
    </div>

    <div class="patient-section">
        <div class="patient-info">
            <h3>Observación</h3>
            <p>{{ $rescue->observations }}</p>
        </div>
    </div>

    <div class="footer">
        Generado el {{ now()->format('d/m/Y') }}
    </div>
</body>
</html>