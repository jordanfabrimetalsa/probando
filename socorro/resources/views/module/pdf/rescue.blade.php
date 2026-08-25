<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Informe SCI {{ $rescate->incident_code ?? $rescate->id }}</title>
    <style>
        @page{margin:108px 38px 58px}*{box-sizing:border-box}body{margin:0;color:#243b45;font-family:DejaVu Sans,Arial,sans-serif;font-size:9px;line-height:1.45}.watermark{position:fixed;z-index:-10;top:29%;left:24%;width:52%;opacity:.045}.header{position:fixed;top:-82px;right:0;left:0;height:68px;border-bottom:3px solid #ea4e1a}.header-logo{float:left;width:54px;height:54px;object-fit:contain}.header-copy{float:left;margin:7px 0 0 12px}.header-copy strong{display:block;color:#0b4257;font-size:13px}.header-copy span{color:#617984;font-size:7px;letter-spacing:1.2px}.header-code{float:right;margin-top:7px;padding:8px 11px;border:1px solid #ccdce2;border-radius:5px;text-align:right}.header-code b{display:block;color:#ea4e1a;font-size:10px}.header-code small{color:#71868e;font-size:7px}.footer{position:fixed;right:0;bottom:-38px;left:0;padding-top:8px;border-top:1px solid #d8e3e7;color:#72868e;font-size:7px}.footer-right{float:right}.title-band{margin-bottom:14px;padding:14px 16px;border-radius:7px;background:#0b4257;color:#fff}.title-band h1{margin:0 0 3px;font-size:18px}.title-band p{margin:0;color:#c8dce4;font-size:8px}.status{float:right;margin-top:-31px;padding:5px 8px;border-radius:4px;background:#ea4e1a;color:#fff;font-size:7px;font-weight:bold;text-transform:uppercase}.section{margin-bottom:12px;page-break-inside:avoid}.section-title{margin:0;padding:7px 9px;border-left:4px solid #ea4e1a;background:#eaf2f5;color:#123f50;font-size:10px;text-transform:uppercase;letter-spacing:.35px}.grid{width:100%;border-collapse:collapse}.grid td{width:50%;padding:7px 9px;border:1px solid #dce5e8;vertical-align:top}.grid td.full{width:100%}.label{display:block;margin-bottom:2px;color:#71858e;font-size:6.5px;font-weight:bold;text-transform:uppercase;letter-spacing:.35px}.value{color:#203d49;font-size:8.5px}.narrative{padding:9px;border:1px solid #dce5e8;white-space:pre-line}.clinical th,.clinical td,.timeline th,.timeline td{padding:6px 7px;border:1px solid #dce5e8;text-align:left;vertical-align:top}.clinical th,.timeline th{background:#f0f5f7;color:#315562;font-size:7px;text-transform:uppercase}.clinical td:first-child{width:21%;font-weight:bold;color:#0b4257}.timeline td:first-child{width:31%;font-weight:bold}.pill{display:inline-block;margin:2px 3px 2px 0;padding:4px 6px;border-radius:10px;background:#eaf2f5;color:#0b526a;font-size:7px}.signature{margin-top:25px}.signature td{width:50%;padding:25px 25px 0;text-align:center}.signature-line{padding-top:5px;border-top:1px solid #6b7d84}.page-break{page-break-before:always}.confidential{margin-bottom:10px;padding:6px 8px;border:1px solid #f0c8b9;background:#fff6f2;color:#a43c18;font-size:7px}
    </style>
</head>
<body>
    <img class="watermark" src="{{ public_path('assets/img/logo-socorro.png') }}" alt="">
    <div class="header">
        <img class="header-logo" src="{{ public_path('assets/img/logo-socorro.png') }}" alt="CSA Chile">
        <div class="header-copy"><strong>Cuerpo de Socorro Andino de Chile</strong><span>INFORME OPERACIONAL - SISTEMA DE COMANDO DE INCIDENTES</span></div>
        <div class="header-code"><b>{{ $rescate->incident_code ?? ('CSA-' . $rescate->id) }}</b><small>Registro interno #{{ $rescate->id }}</small></div>
    </div>
    <div class="footer"><span>Documento operacional de uso institucional · Generado {{ now()->format('d/m/Y H:i') }}</span><span class="footer-right">CSA Chile</span></div>

    <div class="title-band">
        <h1>Informe de incidente y rescate</h1>
        <p>Consolidado de mando, operación, atención y cierre del incidente</p>
        <span class="status">{{ $rescate->estado_cierre ?? 'Sin cierre' }}</span>
    </div>
    <div class="confidential"><strong>CONFIDENCIAL:</strong> Este documento contiene antecedentes personales y clínicos. Su tratamiento debe ajustarse a los protocolos institucionales vigentes.</div>

    <div class="section">
        <h2 class="section-title">1. Identificación y mando</h2>
        <table class="grid">
            <tr><td><span class="label">Fecha y hora de activación</span><span class="value">{{ $rescate->fecha_operativo ? date('d/m/Y', strtotime($rescate->fecha_operativo)) : 'No informado' }} · {{ $rescate->hora_llamado ?? 'No informado' }}</span></td><td><span class="label">Nivel de activación</span><span class="value">{{ $rescate->nivel_activacion ?? 'No informado' }}</span></td></tr>
            <tr><td><span class="label">Comandante del incidente</span><span class="value">{{ $rescate->commandante_incidente ?? 'No informado' }}</span></td><td><span class="label">Puesto de comando</span><span class="value">{{ $rescate->puesto_comando ?? 'No informado' }}</span></td></tr>
            <tr><td><span class="label">Tipo de emergencia</span><span class="value">{{ $rescate->tipo_emergencia ?? 'No informado' }}</span></td><td><span class="label">Lugar general</span><span class="value">{{ $rescate->lugar ?? 'No informado' }}</span></td></tr>
            <tr><td><span class="label">Persona que alerta</span><span class="value">{{ $rescate->nombre_llamado ?? 'No informado' }} · {{ $rescate->telefono ?? 'Sin teléfono' }}</span></td><td><span class="label">Hora de desmovilización</span><span class="value">{{ $rescate->hora_desmovilizacion ?? 'No informada' }}</span></td></tr>
        </table>
    </div>

    <div class="section">
        <h2 class="section-title">2. Plan de acción del incidente</h2>
        <table class="grid">
            <tr><td><span class="label">Objetivos operacionales</span><div class="value">{{ $rescate->objetivos_incidente ?? 'No informado' }}</div></td><td><span class="label">Riesgos y controles</span><div class="value">{{ $rescate->riesgos_operacionales ?? 'No informado' }}</div></td></tr>
            <tr><td><span class="label">Plan de comunicaciones</span><div class="value">{{ $rescate->plan_comunicaciones ?? 'No informado' }}</div></td><td><span class="label">Zonificación operacional</span><div class="value">{{ $rescate->zona_operaciones ?? 'No informada' }}</div></td></tr>
        </table>
    </div>

    <div class="section">
        <h2 class="section-title">3. Ubicación del incidente</h2>
        <table class="grid">
            <tr><td><span class="label">Lugar exacto</span><span class="value">{{ $rescate->lugar_exacto ?? 'No informado' }}</span></td><td><span class="label">Coordenadas</span><span class="value">{{ $rescate->latitud ?? 'S/I' }}, {{ $rescate->longitud ?? 'S/I' }} · {{ $rescate->altitud ?? 'S/I' }} msnm</span></td></tr>
            <tr><td colspan="2" class="full"><span class="label">Posición de vehículos y acceso</span><span class="value">{{ $rescate->ubicacion_vehiculo_rescate ?? 'No informado' }}</span></td></tr>
        </table>
    </div>

    <div class="page-break"></div>
    <div class="section">
        <h2 class="section-title">4. Persona afectada</h2>
        <table class="grid">
            <tr><td><span class="label">Nombre</span><span class="value">{{ $rescate->nombre_completo ?? 'No informado' }}</span></td><td><span class="label">Identificación</span><span class="value">{{ $rescate->rut_dni ?? 'No informada' }}</span></td></tr>
            <tr><td><span class="label">Edad / sexo</span><span class="value">{{ $rescate->edad ?? 'S/I' }} años · {{ ucfirst($rescate->sexo ?? 'Sin informar') }}</span></td><td><span class="label">Contacto</span><span class="value">{{ $rescate->telefono_afectado ?? 'No informado' }}</span></td></tr>
            <tr><td><span class="label">Condición aparente</span><span class="value">{{ $rescate->condicion_fisica ?? 'No informada' }}</span></td><td><span class="label">Referencia física</span><span class="value">{{ $rescate->estatura ?? 'S/I' }} cm · {{ $rescate->peso ?? 'S/I' }} kg</span></td></tr>
        </table>
    </div>

    <div class="section">
        <h2 class="section-title">5. Evaluación clínica primaria - XABCDE</h2>
        <table class="grid clinical">
            <tr><th>Parámetro</th><th>Hallazgos / acciones</th></tr>
            <tr><td>X - Hemorragias</td><td>{{ $xabcde->x_hemorragias ?? 'Sin registro' }}</td></tr>
            <tr><td>A - Vía aérea</td><td>{{ $xabcde->a_via_aerea ?? 'Sin registro' }}</td></tr>
            <tr><td>B - Respiración</td><td>{{ $xabcde->b_respiracion ?? 'Sin registro' }}</td></tr>
            <tr><td>C - Circulación</td><td>{{ $xabcde->c_circulacion ?? 'Sin registro' }}</td></tr>
            <tr><td>D - Neurológico</td><td>{{ $xabcde->d_estado_neurologico ?? 'Sin registro' }}</td></tr>
            <tr><td>E - Exposición</td><td>{{ $xabcde->e_exposicion ?? 'Sin registro' }}</td></tr>
        </table>
    </div>

    <div class="section">
        <h2 class="section-title">6. Evaluación secundaria - SAMPLE</h2>
        <table class="grid">
            <tr><td><span class="label">Signos y síntomas</span><span class="value">{{ $sample->signos_sintomas ?? 'Sin registro' }}</span></td><td><span class="label">Alergias</span><span class="value">{{ $sample->alergias ?? 'Sin registro' }}</span></td></tr>
            <tr><td><span class="label">Medicamentos habituales</span><span class="value">{{ $sample->medicamentos ?? 'Sin registro' }}</span></td><td><span class="label">Patologías previas</span><span class="value">{{ $sample->patologias_previas ?? 'Sin registro' }}</span></td></tr>
            <tr><td><span class="label">Última ingesta</span><span class="value">{{ $sample->ultima_ingesta ?? 'Sin registro' }}</span></td><td><span class="label">Eventos previos</span><span class="value">{{ $sample->eventos_previos ?? 'Sin registro' }}</span></td></tr>
        </table>
    </div>

    <div class="section">
        <h2 class="section-title">7. Atención, evacuación y destino</h2>
        <div class="narrative"><span class="label">Condición sanitaria inicial</span>{{ $rescate->condicion_sanitaria_inicial ?? 'Sin registro' }}</div>
        <table class="grid">
            <tr><td><span class="label">EVA / MSC</span><span class="value">{{ $rescate->eva_inicial ?? 'S/I' }} · {{ $rescate->msc_inicial ?? 'S/I' }}</span></td><td><span class="label">Estado emocional</span><span class="value">{{ $rescate->estado_emocional_psicologico ?? 'S/I' }}</span></td></tr>
            <tr><td><span class="label">Método de evacuación</span><span class="value">{{ $rescate->metodo_evacuacion ?? 'No informado' }}</span></td><td><span class="label">Destino final</span><span class="value">{{ $rescate->destino_final_paciente ?? 'No informado' }}</span></td></tr>
        </table>
    </div>

    <div class="page-break"></div>
    <div class="section">
        <h2 class="section-title">8. Bitácora operacional</h2>
        <table class="grid timeline">
            <tr><th>Hito</th><th>Hora / registro</th></tr>
            <tr><td>Activación presencial</td><td>{{ $bitacora->emergencia_presencial ?? 'Sin registro' }}</td></tr>
            <tr><td>Salida de cuartel/base</td><td>{{ $bitacora->salida_cuartel ?? 'Sin registro' }}</td></tr>
            <tr><td>Llegada al acceso</td><td>{{ $bitacora->llegada_acceso ?? 'Sin registro' }}</td></tr>
            <tr><td>Contacto con el grupo</td><td>{{ $bitacora->contacto_grupo ?? 'Sin registro' }}</td></tr>
            <tr><td>Evaluación inicial</td><td>{{ $bitacora->evaluacion_sanitaria_inicial ?? 'Sin registro' }}</td></tr>
            <tr><td>Inicio del descenso</td><td>{{ $bitacora->inicio_descenso ?? 'Sin registro' }}</td></tr>
            <tr><td>Llegada a extracción</td><td>{{ $bitacora->llegada_extraccion ?? 'Sin registro' }}</td></tr>
            <tr><td>Traslado a destino final</td><td>{{ $bitacora->traslado_destino_final ?? 'Sin registro' }}</td></tr>
            <tr><td>Regreso a base</td><td>{{ $bitacora->regreso_cuartel ?? 'Sin registro' }}</td></tr>
        </table>
    </div>

    <div class="section">
        <h2 class="section-title">9. Ejecución y recursos</h2>
        <div class="narrative"><span class="label">Resumen de acciones</span>{{ $rescate->resumen_acciones ?? 'Sin registro' }}</div>
        <table class="grid">
            <tr><td><span class="label">Material y equipo</span>@forelse($materiales as $item)<span class="pill">{{ $item->material }}</span>@empty<span class="value">Sin registro</span>@endforelse</td><td><span class="label">Medicamentos administrados</span><span class="value">{{ $rescate->medicamentos_administrados ?? 'Sin registro' }}</span></td></tr>
            <tr><td><span class="label">Equipo interviniente</span>@forelse($voluntarios as $voluntario)<span class="pill">{{ trim(($voluntario->name ?? '') . ' ' . ($voluntario->lastname ?? '')) }}</span>@empty<span class="value">Sin registro</span>@endforelse</td><td><span class="label">Instituciones participantes</span>@forelse($instituciones as $institucion)<span class="pill">{{ $institucion->institucion }}</span>@empty<span class="value">Sin registro</span>@endforelse</td></tr>
        </table>
    </div>

    <div class="section">
        <h2 class="section-title">10. Cierre y evaluación posterior</h2>
        <div class="narrative"><span class="label">Descripción consolidada de la emergencia</span>{{ $rescate->descripcion_emergencia ?? 'Sin registro' }}</div>
        <div class="narrative"><span class="label">Observaciones y recomendaciones</span>{{ $rescate->observaciones_generales ?? 'Sin registro' }}</div>
        <div class="narrative"><span class="label">Lecciones aprendidas / acciones de mejora</span>{{ $rescate->lecciones_aprendidas ?? 'Sin registro' }}</div>
    </div>

    <table class="grid signature">
        <tr><td><div class="signature-line">Comandante del incidente<br><strong>{{ $rescate->commandante_incidente ?? '' }}</strong></div></td><td><div class="signature-line">Responsable de revisión / Jefatura</div></td></tr>
    </table>
</body>
</html>
