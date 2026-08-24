@extends('layout.main')

@section('title', 'Panel general')

@section('content')
<div class="flux-toolbar">
    <div><h1 class="flux-page-title">Panel general</h1><p class="flux-page-copy">Resumen operativo del Cuerpo de Socorro Andino de Chile.</p></div>
    <span class="text-muted small"><i class="fa-regular fa-calendar me-2"></i>{{ now()->locale('es')->translatedFormat('d \d\e F, Y') }}</span>
</div>

<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3"><div class="flux-stat"><div class="d-flex justify-content-between"><div><div class="flux-stat__label">Voluntarios</div><div class="flux-stat__value">{{ $cant_voluntaries }}</div><div class="flux-stat__meta">Miembros registrados</div></div><span class="flux-stat__icon"><i class="fa-solid fa-people-group"></i></span></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="flux-stat flux-stat--orange"><div class="d-flex justify-content-between"><div><div class="flux-stat__label">Avisos activos</div><div class="flux-stat__value">{{ $activeDepartures }}</div><div class="flux-stat__meta">Salidas aún abiertas</div></div><span class="flux-stat__icon"><i class="fa-solid fa-person-hiking"></i></span></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="flux-stat"><div class="d-flex justify-content-between"><div><div class="flux-stat__label">Rescates {{ now()->year }}</div><div class="flux-stat__value">{{ $rescuesThisYear }}</div><div class="flux-stat__meta">Operaciones registradas</div></div><span class="flux-stat__icon"><i class="fa-solid fa-shield-heart"></i></span></div></div></div>
    <div class="col-sm-6 col-xl-3"><div class="flux-stat"><div class="d-flex justify-content-between"><div><div class="flux-stat__label">Saldo financiero</div><div class="flux-stat__value" style="font-size:1.35rem">$ {{ number_format($financeBalance, 0, ',', '.') }}</div><div class="flux-stat__meta">Balance acumulado</div></div><span class="flux-stat__icon"><i class="fa-solid fa-wallet"></i></span></div></div></div>
</div>

<div class="row g-3 mb-4">
    <div class="col-xl-4"><div class="flux-panel"><h2 class="flux-panel__title">Voluntarios por delegación</h2><p class="flux-panel__copy">Distribución actual de los equipos.</p><div class="flux-chart"><canvas id="volunteersChart"></canvas></div></div></div>
    <div class="col-xl-4"><div class="flux-panel"><h2 class="flux-panel__title">Avisos de salida</h2><p class="flux-panel__copy">Registros creados durante los últimos seis meses.</p><div class="flux-chart"><canvas id="departuresChart"></canvas></div></div></div>
    <div class="col-xl-4"><div class="flux-panel"><h2 class="flux-panel__title">Flujo financiero</h2><p class="flux-panel__copy">Comparación mensual de ingresos y egresos.</p><div class="flux-chart"><canvas id="financeChart"></canvas></div></div></div>
</div>

<div class="row g-3">
    <div class="col-lg-5"><div class="flux-panel"><div class="d-flex justify-content-between align-items-center"><div><h2 class="flux-panel__title">Cumpleaños de hoy</h2><p class="flux-panel__copy">Personas a quienes podemos saludar.</p></div><i class="fa-solid fa-cake-candles text-warning"></i></div>@forelse($birthdaysToday as $birthday)<div class="d-flex justify-content-between align-items-center py-2 border-bottom"><strong class="small">{{ $birthday->name }} {{ $birthday->lastname }}</strong><span class="badge bg-primary">{{ Carbon\Carbon::parse($birthday->birthday)->age }} años</span></div>@empty<p class="text-muted small mb-0">No hay cumpleaños hoy.</p>@endforelse</div></div>
    <div class="col-lg-7"><div class="flux-panel"><h2 class="flux-panel__title">Próximos cumpleaños</h2><p class="flux-panel__copy">Los siguientes cinco aniversarios del equipo.</p><div class="row g-2">@foreach($upcomingBirthdays as $birthday)<div class="col-md-6"><div class="d-flex align-items-center gap-3 p-2 rounded border"><span class="flux-stat__icon"><i class="fa-regular fa-calendar"></i></span><div><strong class="d-block small">{{ $birthday->name }} {{ $birthday->lastname }}</strong><span class="text-muted" style="font-size:.7rem">{{ Carbon\Carbon::parse($birthday->birthday)->locale('es')->translatedFormat('d \d\e F') }}</span></div></div></div>@endforeach</div></div></div>
</div>
@endsection

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    Chart.defaults.font.family = "'Segoe UI', sans-serif";
    Chart.defaults.color = '#667c86';
    const common = {responsive:true,maintainAspectRatio:false,plugins:{legend:{labels:{usePointStyle:true,boxWidth:8,padding:16}}},scales:{x:{grid:{display:false},ticks:{font:{size:10}}},y:{beginAtZero:true,grid:{color:'rgba(23,49,62,.07)'},ticks:{precision:0,font:{size:10}}}}};
    new Chart(document.getElementById('volunteersChart'), {type:'bar',data:{labels:@json($data->pluck('delegation_name')),datasets:[{label:'Voluntarios',data:@json($data->pluck('aggregate')),backgroundColor:'#176985',borderRadius:5}]},options:common});
    new Chart(document.getElementById('departuresChart'), {type:'line',data:{labels:@json($monthLabels),datasets:[{label:'Avisos',data:@json($departureSeries),borderColor:'#ea4e1a',backgroundColor:'rgba(234,78,26,.12)',fill:true,tension:.35,pointRadius:3}]},options:common});
    new Chart(document.getElementById('financeChart'), {type:'bar',data:{labels:@json($monthLabels),datasets:[{label:'Ingresos',data:@json($incomeSeries),backgroundColor:'#176985',borderRadius:4},{label:'Egresos',data:@json($expenseSeries),backgroundColor:'#ea4e1a',borderRadius:4}]},options:{...common,scales:{...common.scales,y:{...common.scales.y,ticks:{callback:value=>'$ '+new Intl.NumberFormat('es-CL').format(value),font:{size:10}}}}}});
});
</script>
@endpush
