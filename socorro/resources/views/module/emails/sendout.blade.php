<!DOCTYPE html>
<html>
<head>
    <title>Nuevo mensaje de contacto</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-top: 0;
            color: #333;
        }

        p {
            margin: 10px 0;
            line-height: 1.5;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px;
            height: auto;
        }

        .logo span {
            display: block;
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="../../../../public/assets/img/logo-socorro.png" alt="Logo Socorro Andino" style="display: block; max-width: 100px; height: auto;">
            <span>Cuerpo de Socorro Andino de Chile</span>
        </div>

        <h2>Hemos recibido tu aviso de salida, con la siguiente información:</h2>
        <p><strong>Nombre:</strong> {{ $sendout['name'] }} {{ $sendout['lastname'] }}</p>
        <p><strong>{{ $sendout['document_type'] == '0' ? 'Pasaporte' : 'RUT' }}:</strong> - {{ $sendout['document_number'] }}</p>
        <p><strong>Email:</strong> {{ $sendout['email'] }}</p>
        <p><strong>Teléfono:</strong> {{ $sendout['phone'] }}</p>
        @switch($sendout['region'])
            @case(0)
                <p><strong>Región:</strong> Región Arica y Parinacota</p>
                @break
            @case(1)
                <p><strong>Región:</strong> Región Tarapaca</p>
                @break
            @case(3)
                <p><strong>Región:</strong> Región Antofagasta</p>
                @break
            @case(4)
                <p><strong>Región:</strong> Región Atacama</p>
                @break
            @case(5)
                <p><strong>Región:</strong> Región Coquimbo</p>
                @break
            @case(6)
                <p><strong>Región:</strong> Región Metropolitana</p>
                @break
            @case(7)
                <p><strong>Región:</strong> Región Valparaíso</p>
                @break
            @case(8)
                <p><strong>Región:</strong> Región O’Higgins</p>
                @break
            @case(9)
                <p><strong>Región:</strong> Región Maule</p>
                @break
            @case(10)
                <p><strong>Región:</strong> Región Bio Bío</p>
                @break
            @case(11)
                <p><strong>Región:</strong> Región Araucania</p>
                @break
            @case(12)
                <p><strong>Región:</strong> Región Los Ríos</p>
                @break
            @case(13)
                <p><strong>Región:</strong> Región Los Lagos</p>
                @break
            @case(14)
                <p><strong>Región:</strong> Región Aysén</p>
                @break
            @case(15)
                <p><strong>Región:</strong> Región Magallanes</p>
                @break
        @endswitch
        <p><strong>Destino:</strong> {{ $sendout['destination'] }}</p>
        <p><strong>Ruta:</strong> {{ $sendout['route'] }}</p>
        @switch($sendout['activity'])
            @case(0)
                <p><strong>Actividad:</strong> Trekking</p>
                @break
            @case(1)
                <p><strong>Actividad:</strong> Hikking</p>
                @break
            @case(3)
                <p><strong>Actividad:</strong> Mountain Bike</p>
                @break
            @case(4)
                <p><strong>Actividad:</strong> Escalada</p>
                @break
            @case(5)
                <p><strong>Actividad:</strong> Escalada en Hielo</p>
                @break
            @case(6)
                <p><strong>Actividad:</strong> Randonee</p>
                @break
            @case(7)
                <p><strong>Actividad:</strong> Trail Running</p>
                @break
        @endswitch
        <p><strong>Número de participantes:</strong> {{ $sendout['number_participants'] }}</p>
        <p><strong>Fecha de salida:</strong> {{ date('d/m/Y H:i:s', strtotime($sendout['departure_date'])) }}</p>
        <p><strong>Fecha de retorno:</strong> {{ date('d/m/Y H:i:s', strtotime($sendout['return_date'])) }}</p>
        <br>
        <hr>
        <p>Favor de hacer el registro de finalización de salida con su RUT.</p>
    </div>
</body>
</html>
