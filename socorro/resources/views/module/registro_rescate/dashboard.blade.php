@extends('layout.main')

@section('title', 'Dashboard de rescates')

@push('styles')
<style>
    .rescue-dashboard { color: #263238; }
    .rescue-hero { background: linear-gradient(125deg, #212529, #37474f); border-radius: 1rem; padding: 1.4rem 1.5rem; color: #fff; box-shadow: 0 12px 30px rgba(16,24,32,.18); }
    .rescue-hero p { color: rgba(255,255,255,.7); }
    .rescue-filter, .rescue-card { background: #fff; border: 1px solid rgba(38,50,56,.08); border-radius: .9rem; box-shadow: 0 8px 24px rgba(16,24,32,.07); }
    .rescue-filter { padding: 1.1rem; }
    .rescue-filter label { color: #607d8b; font-size: .76rem; font-weight: 700; text-transform: uppercase; letter-spacing: .035em; }
    .rescue-filter .form-control, .rescue-filter .form-select { min-height: 2.65rem; border: 1px solid #dce3e7; border-radius: .6rem; }
    .rescue-kpi { position: relative; overflow: hidden; min-height: 138px; padding: 1.15rem; }
    .rescue-kpi:after { content: ''; position: absolute; width: 74px; height: 74px; right: -22px; bottom: -25px; background: rgba(234,78,26,.1); border-radius: 50%; }
    .rescue-kpi__icon { width: 2.45rem; height: 2.45rem; display: grid; place-items: center; color: #fff; background: #263238; border-radius: .7rem; }
    .rescue-kpi small { color: #78909c; font-weight: 600; }
    .rescue-kpi strong { display: block; margin-top: .5rem; font-size: 1.75rem; line-height: 1; color: #263238; }
    .rescue-kpi p { margin: .45rem 0 0; color: #90a4ae; font-size: .78rem; }
    .rescue-panel { padding: 1.2rem; height: 100%; }
    .rescue-panel h2 { margin: 0; color: #263238; font-size: 1rem; font-weight: 700; }
    .rescue-panel header p { margin: .2rem 0 0; color: #90a4ae; font-size: .78rem; }
    .rescue-chart { position: relative; height: 285px; margin-top: 1rem; }
    .rescue-table th { color: #78909c; font-size: .7rem; text-transform: uppercase; letter-spacing: .04em; border-top: 0; }
    .rescue-table td { color: #455a64; font-size: .82rem; vertical-align: middle; }
    .rescue-empty { height: 250px; display: grid; place-items: center; color: #90a4ae; text-align: center; }
    .rescue-status { display: inline-flex; padding: .3rem .55rem; border-radius: 999px; background: #edf3f5; color: #455a64; font-size: .72rem; font-weight: 700; }
    @media(max-width:767.98px){ .rescue-hero { padding: 1.1rem; } .rescue-chart { height: 235px; } }
</style>
@endpush

@section('content')
<div class="rescue-dashboard">
    <section class="rescue-hero d-flex flex-column flex-lg-row justify-content-between align-items-lg-center gap-3 mb-4">
        <div>
            <span class="badge bg-warning text-dark mb-2">Inteligencia operacional</span>
            <h1 class="h3 mb-1 text-white">Dashboard de rescates</h1>
            <p class="mb-0">Indicadores para evaluar demanda, respuesta, recursos y resultados de las operaciones.</p>
        </div>
        <div class="d-flex gap-2 flex-wrap">
            <a href="{{ route('registro-rescate') }}" class="btn btn-outline-light mb-0"><i class="fa-solid fa-list me-2"></i>Ver registros</a>
            <a href="{{ route('registro_rescate') }}" class="btn btn-warning mb-0"><i class="fa-solid fa-plus me-2"></i>Nuevo rescate</a>
        </div>
    </section>

    <form method="GET" class="rescue-filter mb-4">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div><strong><i class="fa-solid fa-filter me-2"></i>Filtros</strong><small class="d-block text-muted">Todos los indicadores se actualizan con la selección.</small></div>
            @if(request()->query())<a href="{{ route('registro-rescate.dashboard') }}" class="btn btn-sm btn-light mb-0">Limpiar</a>@endif
        </div>
        <div class="row g-3 align-items-end">
            <div class="col-6 col-lg-2"><label>Desde</label><input class="form-control" type="date" name="from" value="{{ $filters['from'] ?? '' }}"></div>
            <div class="col-6 col-lg-2"><label>Hasta</label><input class="form-control" type="date" name="to" value="{{ $filters['to'] ?? '' }}"></div>
            <div class="col-12 col-md-4 col-lg-3"><label>Tipo de emergencia</label><select class="form-select" name="type"><option value="">Todos</option>@foreach($filterTypes as $type)<option value="{{ $type }}" @selected(($filters['type'] ?? '') === $type)>{{ $type }}</option>@endforeach</select></div>
            <div class="col-12 col-md-4 col-lg-2"><label>Estado</label><select class="form-select" name="status"><option value="">Todos</option>@foreach(['Controlado','Cerrado','Derivado','Suspendido'] as $status)<option value="{{ $status }}" @selected(($filters['status'] ?? '') === $status)>{{ $status }}</option>@endforeach</select></div>
            @if($delegations->isNotEmpty())
                <div class="col-12 col-md-4 col-lg-2"><label>Delegación</label><select class="form-select" name="delegation"><option value="">Todas</option>@foreach($delegations as $delegation)<option value="{{ $delegation->id }}" @selected((string)($filters['delegation'] ?? '') === (string)$delegation->id)>{{ $delegation->name }}</option>@endforeach</select></div>
            @endif
            <div class="col-12 col-lg-1"><button class="btn btn-dark w-100 mb-0 px-2" title="Aplicar filtros"><i class="fa-solid fa-magnifying-glass"></i></button></div>
        </div>
    </form>

    <div class="row g-3 mb-4">
        @foreach([
            ['shield-heart','Rescates registrados',$metrics['total'],'Operaciones del período'],
            ['circle-check','Cierre operacional',$metrics['closure_rate'].'%',$metrics['closed'].' controlados o cerrados'],
            ['truck-medical','Movilización promedio',$metrics['avg_mobilization'] !== null ? $metrics['avg_mobilization'].' min' : 'S/I','Desde llamado a salida'],
            ['clock','Duración promedio',$metrics['avg_duration'] !== null ? $metrics['avg_duration'].' min' : 'S/I','Llamado a desmovilización'],
            ['people-group','Participaciones',$metrics['volunteers'],$metrics['avg_volunteers'].' voluntarios por rescate'],
            ['handshake','Instituciones',$metrics['institutions'],'Colaboradores distintos'],
        ] as [$icon,$label,$value,$copy])
            <div class="col-6 col-xl-2"><article class="rescue-card rescue-kpi h-100"><span class="rescue-kpi__icon"><i class="fa-solid fa-{{ $icon }}"></i></span><small>{{ $label }}</small><strong>{{ $value }}</strong><p>{{ $copy }}</p></article></div>
        @endforeach
    </div>

    <div class="row g-3 mb-4">
        <div class="col-xl-7"><section class="rescue-card rescue-panel"><header><h2>Evolución mensual</h2><p>Cantidad de operaciones registradas por mes.</p></header><div class="rescue-chart">@if($monthly->isEmpty())<div class="rescue-empty"><div><i class="fa-solid fa-chart-line fa-2x mb-2"></i><br>Sin datos para el período.</div></div>@else<canvas id="monthlyChart"></canvas>@endif</div></section></div>
        <div class="col-xl-5"><section class="rescue-card rescue-panel"><header><h2>Tipos de emergencia</h2><p>Principales causas de activación.</p></header><div class="rescue-chart">@if($types->isEmpty())<div class="rescue-empty">Sin datos para el período.</div>@else<canvas id="typeChart"></canvas>@endif</div></section></div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-lg-4"><section class="rescue-card rescue-panel"><header><h2>Estado de cierre</h2><p>Resultado administrativo de las operaciones.</p></header><div class="rescue-chart">@if($statuses->isEmpty())<div class="rescue-empty">Sin datos.</div>@else<canvas id="statusChart"></canvas>@endif</div></section></div>
        <div class="col-lg-4"><section class="rescue-card rescue-panel"><header><h2>Nivel de activación</h2><p>Magnitud de recursos movilizados.</p></header><div class="rescue-chart">@if($activations->isEmpty())<div class="rescue-empty">Sin datos.</div>@else<canvas id="activationChart"></canvas>@endif</div></section></div>
        <div class="col-lg-4"><section class="rescue-card rescue-panel"><header><h2>Perfil del operativo</h2><p>Contexto sanitario y geográfico.</p></header><div class="d-grid gap-3 mt-4"><div class="p-3 rounded bg-light"><small class="text-muted">Edad promedio de afectados</small><strong class="d-block fs-4">{{ $metrics['avg_age'] !== null ? $metrics['avg_age'].' años' : 'Sin información' }}</strong></div><div class="p-3 rounded bg-light"><small class="text-muted">Altitud promedio</small><strong class="d-block fs-4">{{ $metrics['avg_altitude'] !== null ? number_format($metrics['avg_altitude'],0,',','.').' msnm' : 'Sin información' }}</strong></div><div class="p-3 rounded bg-light"><small class="text-muted">Evacuación más utilizada</small><strong class="d-block fs-6">{{ $evacuations->keys()->first() ?? 'Sin información' }}</strong></div></div></section></div>
    </div>

    <section class="rescue-card rescue-panel">
        <header class="d-flex justify-content-between align-items-center"><div><h2>Operaciones recientes</h2><p>Últimos registros incluidos en los filtros.</p></div><a href="{{ route('registro-rescate') }}" class="btn btn-sm btn-outline-dark mb-0">Ver todos</a></header>
        <div class="table-responsive mt-3"><table class="table rescue-table mb-0"><thead><tr><th>Fecha</th><th>Incidente</th><th>Emergencia</th><th>Lugar</th><th>Delegación</th><th>Activación</th><th>Estado</th><th></th></tr></thead><tbody>
            @forelse($rescues as $rescue)<tr><td>{{ Carbon\Carbon::parse($rescue->fecha_operativo)->format('d/m/Y') }}</td><td><strong>{{ $rescue->incident_code }}</strong></td><td>{{ $rescue->tipo_emergencia }}</td><td>{{ $rescue->lugar }}</td><td>{{ $rescue->delegation_name }}</td><td>{{ $rescue->nivel_activacion }}</td><td><span class="rescue-status">{{ $rescue->estado_cierre }}</span></td><td><a href="{{ route('registro-rescate.pdf',$rescue->id) }}" target="_blank" class="btn btn-sm btn-light mb-0" title="Informe PDF"><i class="fa-solid fa-file-pdf"></i></a></td></tr>@empty<tr><td colspan="8" class="text-center py-5 text-muted">No hay rescates que coincidan con los filtros.</td></tr>@endforelse
        </tbody></table></div>
    </section>
</div>
@endsection

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const palette = ['#263238','#EA4E1A','#176985','#e0a800','#607d8b','#2e7d32','#8e44ad','#90a4ae'];
    const baseOptions = { responsive:true, maintainAspectRatio:false, plugins:{ legend:{ position:'bottom', labels:{ usePointStyle:true, boxWidth:8 } } } };
    const makeChart = (id, config) => { const element = document.getElementById(id); if (element) new Chart(element, config); };

    makeChart('monthlyChart', { type:'line', data:{ labels:@json($monthly->keys()), datasets:[{ label:'Rescates', data:@json($monthly->values()), borderColor:'#EA4E1A', backgroundColor:'rgba(234,78,26,.12)', fill:true, tension:.35, pointRadius:4 }] }, options:{ ...baseOptions, plugins:{ legend:{ display:false } }, scales:{ y:{ beginAtZero:true, ticks:{ precision:0 } }, x:{ grid:{ display:false } } } } });
    makeChart('typeChart', { type:'doughnut', data:{ labels:@json($types->keys()), datasets:[{ data:@json($types->values()), backgroundColor:palette, borderWidth:0 }] }, options:{ ...baseOptions, cutout:'63%' } });
    makeChart('statusChart', { type:'bar', data:{ labels:@json($statuses->keys()), datasets:[{ data:@json($statuses->values()), backgroundColor:palette, borderRadius:7 }] }, options:{ ...baseOptions, plugins:{ legend:{ display:false } }, scales:{ y:{ beginAtZero:true, ticks:{ precision:0 } }, x:{ grid:{ display:false } } } } });
    makeChart('activationChart', { type:'doughnut', data:{ labels:@json($activations->keys()), datasets:[{ data:@json($activations->values()), backgroundColor:['#176985','#e0a800','#EA4E1A'], borderWidth:0 }] }, options:{ ...baseOptions, cutout:'63%' } });
});
</script>
@endpush
