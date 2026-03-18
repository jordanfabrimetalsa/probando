<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>Informe del Rescate {{ $rescate->id }}</title>

    <style>
        @page {
            margin: 0.5cm;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            font-size: 12px;
            background-color: #ffffff;
        }

        .page-header {
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            padding-bottom: 10px;
            border-bottom: 1px solid #999;
            margin-bottom: 20px;
        }

        .section {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
        }

        .section h3 {
            margin: 0 0 10px 0;
            font-size: 16px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 4px;
        }

        .section p {
            margin: 3px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table th,
        table td {
            border: 1px solid #ccc;
            padding: 6px;
            font-size: 12px;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 10px;
            color: #555;
        }
    </style>

</head>

<body>

    <div class="page-header">
        Informe del Rescate {{ $rescate->id }}
    </div>

    <!-- DATOS GENERALES -->

    <div class="section">

        <h3>Datos generales del rescate</h3>
        <p><strong>Fecha:</strong>
            {{ $rescate->fecha_operativo ? date('d/m/Y', strtotime($rescate->fecha_operativo)) : '' }}</p>
        <p><strong>Hora llamado:</strong> {{ $rescate->hora_llamado ?? '' }}</p>
        <p><strong>Tipo de emergencia:</strong> {{ $rescate->tipo_emergencia ?? '' }}</p>
        <p><strong>Lugar de emergencia:</strong> {{ $rescate->lugar ?? '' }}</p>
        <p><strong>Nombre quien llama:</strong> {{ $rescate->nombre_llamado ?? '' }}</p>
        <p><strong>Teléfono:</strong> {{ $rescate->telefono ?? '' }}</p>

    </div>

    <!-- DATOS PACIENTE -->

    <div class="section">

        <h3>Datos del paciente</h3>
        <p><strong>Nombre:</strong> {{ $rescate->nombre_completo ?? '' }}</p>
        <p><strong>RUT/DNI:</strong> {{ $rescate->rut_dni ?? '' }}</p>
        <p><strong>Edad:</strong> {{ $rescate->edad ?? '' }}</p>
        <p><strong>Sexo:</strong> {{ $rescate->sexo ?? '' }}</p>
        <p><strong>Teléfono:</strong> {{ $rescate->telefono_afectado ?? '' }}</p>
        <p><strong>Condición física:</strong> {{ $rescate->condicion_fisica ?? '' }}</p>
        <p><strong>Estatura:</strong> {{ $rescate->estatura ?? '' }}</p>
        <p><strong>Peso:</strong> {{ $rescate->peso ?? '' }}</p>

    </div>

    <!-- UBICACION RESCATE -->

    <div class="section">

        <h3>Ubicación del rescate</h3>
        <p><strong>Lugar exacto:</strong> {{ $rescate->lugar_exacto ?? '' }}</p>
        <p><strong>Latitud:</strong> {{ $rescate->latitud ?? '' }}</p>
        <p><strong>Longitud:</strong> {{ $rescate->longitud ?? '' }}</p>
        <p><strong>Altitud:</strong> {{ $rescate->altitud ?? '' }}</p>
        <p><strong>Ubicación vehículo rescate:</strong> {{ $rescate->ubicacion_vehiculo_rescate ?? '' }}</p>

    </div>

    <!-- ESTADO SANITARIO -->

    <div class="section">

        <h3>Estado sanitario inicial</h3>
        <p><strong>Condición sanitaria inicial:</strong> {{ $rescate->condicion_sanitaria_inicial ?? '' }}</p>
        <p><strong>EVA inicial:</strong> {{ $rescate->eva_inicial ?? '' }}</p>
        <p><strong>MSC inicial:</strong> {{ $rescate->msc_inicial ?? '' }}</p>
        <p><strong>Estado emocional/psicológico:</strong> {{ $rescate->estado_emocional_psicologico ?? '' }}</p>

    </div>

    <!-- EVALUACION PRIMARIA (XABCDE) -->

    <div class="section">

        <h3>Evaluación primaria (XABCDE)</h3>
        <p><strong>X - Hemorragias externas:</strong> {{ $xabcde->x_hemorragias ?? '' }}</p>
        <p><strong>A - Vía aérea:</strong> {{ $xabcde->a_via_aerea ?? '' }}</p>
        <p><strong>B - Respiración:</strong> {{ $xabcde->b_respiracion ?? '' }}</p>
        <p><strong>C - Circulación:</strong> {{ $xabcde->c_circulacion ?? '' }}</p>
        <p><strong>D - Estado neurológico:</strong> {{ $xabcde->d_estado_neurologico ?? '' }}</p>
        <p><strong>E - Exposición:</strong> {{ $xabcde->e_exposicion ?? '' }}</p>

    </div>

    <!-- EVALUACION SECUNDARIA (SAMPLE) -->

    <div class="section">

        <h3>Evaluación secundaria (SAMPLE)</h3>
        <p><strong>Signos y síntomas:</strong> {{ $sample->signos_sintomas ?? '' }}</p>
        <p><strong>Alergias:</strong> {{ $sample->alergias ?? '' }}</p>
        <p><strong>Medicamentos:</strong> {{ $sample->medicamentos ?? '' }}</p>
        <p><strong>Patologías previas:</strong> {{ $sample->patologias_previas ?? '' }}</p>
        <p><strong>Última ingesta:</strong> {{ $sample->ultima_ingesta ?? '' }}</p>
        <p><strong>Eventos previos:</strong> {{ $sample->eventos_previos ?? '' }}</p>

    </div>

    <!-- ACCIONES -->

    <div class="section">

        <h3>Acciones realizadas</h3>
        <p><strong>Resumen de acciones:</strong> {{ $rescate->resumen_acciones ?? '' }}</p>
        <p><strong>Medicamentos administrados:</strong> {{ $rescate->medicamentos_administrados ?? '' }}</p>

    </div>

    <!-- EVACUACION -->

    <div class="section">

        <h3>Evacuación</h3>
        <p><strong>Método de evacuación:</strong> {{ $rescate->metodo_evacuacion ?? '' }}</p>
        <p><strong>Destino final del paciente:</strong> {{ $rescate->destino_final_paciente ?? '' }}</p>

    </div>

    <!-- BITACORA -->

    <div class="section">

        <h3>Bitácora</h3>
        <p><strong>Emergencia presencial:</strong> {{ $bitacora->emergencia_presencial ?? '' }}</p>
        <p><strong>Salida cuartel/base:</strong> {{ $bitacora->salida_cuartel ?? '' }}</p>
        <p><strong>Llegada punto acceso:</strong> {{ $bitacora->llegada_acceso ?? '' }}</p>
        <p><strong>Contacto con el grupo:</strong> {{ $bitacora->contacto_grupo ?? '' }}</p>
        <p><strong>Evaluación sanitaria inicial:</strong> {{ $bitacora->evaluacion_sanitaria_inicial ?? '' }}</p>
        <p><strong>Inicio descenso:</strong> {{ $bitacora->inicio_descenso ?? '' }}</p>
        <p><strong>Llegada extracción:</strong> {{ $bitacora->llegada_extraccion ?? '' }}</p>
        <p><strong>Traslado destino final:</strong> {{ $bitacora->traslado_destino_final ?? '' }}</p>
        <p><strong>Regreso cuartel/base:</strong> {{ $bitacora->regreso_cuartel ?? '' }}</p>

    </div>

    <!-- MATERIALES -->

    <div class="section">

        <h3>Materiales/equipo</h3>
        <p>
            @if (isset($materiales) && count($materiales))
                {{ $materiales->pluck('material')->implode(', ') }}
            @endif
        </p>

    </div>

    <!-- VOLUNTARIOS -->

    <div class="section">

        <h3>Voluntarios</h3>
        <p>
            @if (isset($voluntarios) && count($voluntarios))
                {{ $voluntarios->pluck('voluntario_id')->implode(', ') }}
            @endif
        </p>

    </div>

    <!-- INSTITUCIONES -->

    <div class="section">

        <h3>Instituciones</h3>
        <p>
            @if (isset($instituciones) && count($instituciones))
                {{ $instituciones->pluck('institucion')->implode(', ') }}
            @endif
        </p>

    </div>

    <!-- DESCRIPCION EMERGENCIA -->

    <div class="section">

        <h3>Descripción de la emergencia</h3>
        <p>{{ $rescate->descripcion_emergencia ?? '' }}</p>

    </div>

    <!-- OBSERVACIONES -->

    <div class="section">

        <h3>Observaciones generales</h3>
        <p>{{ $rescate->observaciones_generales ?? '' }}</p>

    </div>

    <div class="footer">

        Informe generado el {{ now()->format('d/m/Y H:i') }}

    </div>

</body>

</html>
