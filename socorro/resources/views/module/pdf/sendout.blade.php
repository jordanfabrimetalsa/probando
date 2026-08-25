<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Aviso de salida N.º {{ $sendout->id }}</title>
    <style>
        @page { margin: 28px 34px 32px; }
        * { box-sizing: border-box; }
        body { margin: 0; color: #233f4b; font-family: DejaVu Sans, sans-serif; font-size: 10px; line-height: 1.45; }
        .header { padding: 20px 22px; border-radius: 8px; background: #08384a; color: #fff; }
        .header-table, .meta-table, .grid, .contacts, .footer-table { width: 100%; border-collapse: collapse; }
        .logo-cell { width: 70px; vertical-align: middle; }
        .logo { width: 52px; height: 52px; object-fit: contain; }
        .kicker { color: #f28a55; font-size: 8px; font-weight: bold; letter-spacing: 1.3px; text-transform: uppercase; }
        h1 { margin: 4px 0 2px; color: #fff; font-size: 21px; }
        .header-copy { color: #c5d8df; font-size: 9px; }
        .status-cell { width: 115px; text-align: right; vertical-align: middle; }
        .status { display: inline-block; padding: 6px 10px; border-radius: 12px; background: {{ $sendout->active ? '#18885b' : '#b5422d' }}; color: #fff; font-size: 8px; font-weight: bold; text-transform: uppercase; }
        .meta { margin: 13px 0 15px; padding: 10px 13px; border: 1px solid #dbe6e9; border-radius: 6px; background: #f5f8f9; }
        .meta-table td { width: 33.33%; color: #6d838c; font-size: 8px; }
        .meta-table strong { display: block; margin-top: 2px; color: #294753; font-size: 10px; }
        .section { margin-bottom: 13px; border: 1px solid #dce6e9; border-radius: 7px; page-break-inside: avoid; }
        .section-title { padding: 10px 13px; border-bottom: 1px solid #dce6e9; background: #f7fafb; color: #123f51; font-size: 11px; font-weight: bold; }
        .section-title span { margin-right: 6px; color: #e95420; font-size: 8px; letter-spacing: .8px; }
        .section-body { padding: 10px 12px; }
        .grid td { width: 50%; padding: 7px 8px; vertical-align: top; }
        .field { padding: 8px 9px; border-radius: 5px; background: #f5f8f9; }
        .label { display: block; margin-bottom: 3px; color: #7b9098; font-size: 7px; font-weight: bold; letter-spacing: .4px; text-transform: uppercase; }
        .value { color: #294753; font-size: 10px; font-weight: bold; word-wrap: break-word; }
        .route { margin-bottom: 8px; padding: 12px 13px; border-radius: 6px; background: #0d526a; color: #fff; }
        .route small { display: block; color: #a9ccd7; font-size: 7px; text-transform: uppercase; }
        .route strong { display: block; margin-top: 3px; font-size: 12px; }
        .contact { width: 50%; padding: 7px; vertical-align: top; }
        .contact-box { min-height: 68px; padding: 10px; border: 1px solid #e1e9ec; border-left: 4px solid #e95420; border-radius: 5px; }
        .contact-box strong { display: block; margin-bottom: 4px; color: #294753; font-size: 10px; }
        .contact-box p { margin: 2px 0; color: #667e88; }
        .notice { margin-top: 13px; padding: 9px 11px; border-left: 3px solid #e95420; background: #fff4ef; color: #66534b; font-size: 8px; }
        .footer { position: fixed; right: 0; bottom: -18px; left: 0; color: #83959c; font-size: 7px; }
        .footer-table td:last-child { text-align: right; }
    </style>
</head>
<body>
    <header class="header">
        <table class="header-table"><tr>
            <td class="logo-cell">@if($logo)<img class="logo" src="{{ $logo }}" alt="CSA Chile">@endif</td>
            <td><div class="kicker">Cuerpo de Socorro Andino de Chile</div><h1>Aviso de salida N.º {{ $sendout->id }}</h1><div class="header-copy">Ficha operativa para coordinación y respuesta ante emergencias</div></td>
            <td class="status-cell"><span class="status">{{ $sendout->active ? 'Aviso activo' : 'Aviso cerrado' }}</span></td>
        </tr></table>
    </header>

    <div class="meta"><table class="meta-table"><tr>
        <td>Generado el<strong>{{ now()->format('d/m/Y H:i') }}</strong></td>
        <td>Salida programada<strong>{{ optional($sendout->departure_date ? \Carbon\Carbon::parse($sendout->departure_date) : null)->format('d/m/Y H:i') ?: 'No informada' }}</strong></td>
        <td>Regreso estimado<strong>{{ optional($sendout->return_date ? \Carbon\Carbon::parse($sendout->return_date) : null)->format('d/m/Y H:i') ?: 'No informado' }}</strong></td>
    </tr></table></div>

    <section class="section"><div class="section-title"><span>01</span> Identificación y contacto</div><div class="section-body">
        <table class="grid">
            <tr><td><div class="field"><span class="label">Nombre completo</span><span class="value">{{ $sendout->name }} {{ $sendout->lastname }}</span></div></td><td><div class="field"><span class="label">Documento</span><span class="value">{{ $documentType }} · {{ $sendout->document_number }}</span></div></td></tr>
            <tr><td><div class="field"><span class="label">Correo electrónico</span><span class="value">{{ $sendout->email ?: 'No informado' }}</span></div></td><td><div class="field"><span class="label">Teléfono</span><span class="value">{{ $sendout->phone ?: 'No informado' }}</span></div></td></tr>
        </table>
    </div></section>

    <section class="section"><div class="section-title"><span>02</span> Plan de ruta</div><div class="section-body">
        <div class="route"><small>Destino declarado</small><strong>{{ $sendout->destination ?: 'No informado' }}</strong><small style="margin-top:7px">Ruta o itinerario</small><strong>{{ $sendout->route ?: 'No informado' }}</strong></div>
        <table class="grid"><tr>
            <td><div class="field"><span class="label">Región</span><span class="value">{{ $region }}</span></div></td>
            <td><div class="field"><span class="label">Actividad</span><span class="value">{{ $activity }}</span></div></td>
        </tr><tr>
            <td><div class="field"><span class="label">Participantes</span><span class="value">{{ $sendout->number_participants }} persona(s)</span></div></td>
            <td><div class="field"><span class="label">Archivo de ruta</span><span class="value">{{ $sendout->file_path ? strtoupper(pathinfo($sendout->file_path, PATHINFO_EXTENSION)).' adjunto al aviso' : 'Sin archivo adjunto' }}</span></div></td>
        </tr></table>
    </div></section>

    <section class="section"><div class="section-title"><span>03</span> Contactos de emergencia</div><div class="section-body">
        <table class="contacts"><tr>
            <td class="contact"><div class="contact-box"><span class="label">Contacto principal</span><strong>{{ $sendout->name_emergency_family ?: 'No informado' }}</strong><p>{{ $sendout->parentesco_family_emergency ?: 'Parentesco no informado' }}</p><p>Tel. {{ $sendout->number_family_emergency ?: 'No informado' }}</p></div></td>
            <td class="contact"><div class="contact-box"><span class="label">Contacto alternativo</span><strong>{{ $sendout->name_emergency_family_2 ?: 'No informado' }}</strong><p>{{ $sendout->parentesco_family_emergency_2 ?: 'Parentesco no informado' }}</p><p>Tel. {{ $sendout->number_family_emergency_2 ?: 'No informado' }}</p></div></td>
        </tr></table>
    </div></section>

    <div class="notice"><strong>Importante:</strong> este documento reproduce la información declarada en el aviso de salida. Su generación no modifica el registro ni almacena una copia del PDF en el sistema.</div>
    <footer class="footer"><table class="footer-table"><tr><td>CSA Chile · Documento generado bajo demanda</td><td>Aviso N.º {{ $sendout->id }}</td></tr></table></footer>
</body>
</html>
