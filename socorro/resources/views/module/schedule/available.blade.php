@extends('layout.main')

@section('title', 'Guardias disponibles')

@push('styles')
<style>
.guards-hero{padding:28px;border-radius:18px;background:linear-gradient(135deg,#092f40,#176985);color:#fff}.guards-hero h1{color:#fff}.guards-hero p{max-width:680px;color:#c6dce4}.guard-card{height:100%;overflow:hidden;border:1px solid #dae5e9;border-radius:16px;background:#fff;box-shadow:0 8px 25px rgba(15,55,70,.07)}.guard-card__top{padding:20px 22px;border-bottom:1px solid #e6edef}.guard-date{display:inline-flex;align-items:center;gap:7px;color:#176985;font-size:.72rem;font-weight:800}.guard-card h2{margin:9px 0 6px;color:#173744;font-size:1.15rem}.guard-card p{color:#6c818a;font-size:.76rem}.guard-leader{display:flex;align-items:center;gap:12px;margin:16px 0;padding:13px;border:1px solid #f1c5b6;border-radius:12px;background:linear-gradient(135deg,#fff2ed,#fff)}.guard-leader__icon{display:grid;width:42px;height:42px;place-items:center;border-radius:12px;background:#ea4e1a;color:#fff;font-size:1.1rem}.guard-leader small{display:block;color:#b54a26;font-size:.58rem;font-weight:900;letter-spacing:.09em}.guard-leader strong{color:#593025}.guard-capacity{padding:0 22px 20px}.guard-capacity__labels{display:flex;justify-content:space-between;margin-bottom:7px;color:#59717b;font-size:.68rem;font-weight:700}.guard-progress{height:7px;overflow:hidden;border-radius:20px;background:#e5edef}.guard-progress span{display:block;height:100%;border-radius:20px;background:linear-gradient(90deg,#176985,#63b7cf)}.guard-card__footer{display:flex;align-items:center;justify-content:space-between;gap:10px;padding:15px 22px;background:#f7fafb}.guard-full{color:#c84317;font-size:.7rem;font-weight:800}.guard-joined{color:#16824a;font-size:.7rem;font-weight:800}.guards-empty{padding:55px 20px;border:1px dashed #cbdde3;border-radius:16px;text-align:center;background:#f8fbfc;color:#718790}
</style>
@endpush

@section('content')
<section class="guards-hero mb-4">
    <span class="badge bg-warning text-dark mb-2">Disponibilidad operativa</span>
    <h1 class="h3 mb-2">Inscripción a guardias</h1>
    <p class="mb-0">Revisa las guardias habilitadas, su jefe responsable y los cupos disponibles antes de confirmar tu participación.</p>
</section>

@if(session('success'))<div class="alert alert-success"><i class="fa-solid fa-circle-check me-2"></i>{{ session('success') }}</div>@endif
@if($errors->any())<div class="alert alert-danger"><i class="fa-solid fa-circle-exclamation me-2"></i>{{ $errors->first() }}</div>@endif

<div class="row g-4">
    @forelse($guards as $guard)
        @php
            $capacity = max(1, (int) $guard->guard_capacity);
            $occupied = (int) $guard->guards_count;
            $remaining = max(0, $capacity - $occupied);
            $registrationId = $registrations->get($guard->id);
        @endphp
        <div class="col-xl-4 col-md-6">
            <article class="guard-card">
                <div class="guard-card__top">
                    <span class="guard-date"><i class="fa-regular fa-calendar-check"></i>{{ \Carbon\Carbon::parse($guard->start)->format('d/m/Y') }} al {{ \Carbon\Carbon::parse($guard->end)->subDay()->format('d/m/Y') }}</span>
                    <h2>{{ $guard->title }}</h2>
                    <p class="mb-0">{{ $guard->description }}</p>
                    <div class="guard-leader">
                        <span class="guard-leader__icon"><i class="fa-solid fa-star"></i></span>
                        <div><small>JEFE DE GUARDIA</small><strong>{{ $guard->guardLeader ? $guard->guardLeader->name.' '.$guard->guardLeader->lastname : 'Pendiente de asignación' }}</strong></div>
                    </div>
                </div>
                <div class="guard-capacity">
                    <div class="guard-capacity__labels"><span>{{ $occupied }} de {{ $capacity }} inscritos</span><span>{{ $remaining }} cupos disponibles</span></div>
                    <div class="guard-progress"><span style="width:{{ min(100, round($occupied * 100 / $capacity)) }}%"></span></div>
                </div>
                <footer class="guard-card__footer">
                    @if($registrationId)
                        <span class="guard-joined"><i class="fa-solid fa-circle-check me-1"></i>Ya estás inscrito</span>
                        @if((int)$guard->guard_leader_id !== (int)auth()->user()->voluntary_id)
                            <form method="POST" action="{{ route('guardias.leave', $guard) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger mb-0" onclick="return confirm('¿Retirar tu inscripción?')">Retirarme</button></form>
                        @else
                            <span class="badge bg-warning text-dark">Jefe asignado</span>
                        @endif
                    @elseif($remaining === 0)
                        <span class="guard-full"><i class="fa-solid fa-users-slash me-1"></i>Guardia completa</span><button class="btn btn-sm btn-light mb-0" disabled>Sin cupos</button>
                    @else
                        <span class="text-muted small">Confirma tu disponibilidad</span>
                        <form method="POST" action="{{ route('guardias.join', $guard) }}">@csrf<button class="btn btn-sm btn-dark mb-0"><i class="fa-solid fa-user-plus me-1"></i>Inscribirme</button></form>
                    @endif
                </footer>
            </article>
        </div>
    @empty
        <div class="col-12"><div class="guards-empty"><i class="fa-regular fa-calendar-xmark fa-2x mb-3"></i><h2 class="h5">No hay guardias habilitadas</h2><p class="mb-0">Las próximas guardias aparecerán aquí cuando el organizador abra sus inscripciones.</p></div></div>
    @endforelse
</div>
@endsection
