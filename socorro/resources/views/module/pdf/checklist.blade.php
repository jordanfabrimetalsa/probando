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
        Informe del Rescate {{ $question->id }}
    </div>

    <div class="rescue-section">
        <h3>Datos generales del rescate</h3>
        <p><strong>Ruta:</strong> {{ ucwords($question) }}</p>
    </div>

    <div class="patient-section">
        <div class="patient-info">
            <h3>Observación</h3>
        </div>
    </div>

    <div class="footer">
        Generado el {{ now()->format('d/m/Y') }}
    </div>
</body>
</html>