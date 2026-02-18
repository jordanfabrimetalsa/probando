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
            <img src="{{ asset('assets/img/logo-socorro.png') }}" alt="Logo Socorro Andino" style="display: block; max-width: 100px; height: auto;">
            <span>Delegación Nacional de CSA</span>
        </div>

        <h2>Hemos recibido tu mensaje de contacto, con la siguiente información:</h2>
        <p><strong>Nombre:</strong> {{ $contact['name'] }}</p>
        <p><strong>Email:</strong> {{ $contact['email'] }}</p>
        <p><strong>Tipo de consulta:</strong> {{ $contact['type'] }}</p>
        <p><strong>Mensaje:</strong></p>
        <p>{{ $contact['message'] }}</p>
        <br>
        <hr>
        <p>Te responderemos lo antes posible.</p>
    </div>
</body>
</html>
