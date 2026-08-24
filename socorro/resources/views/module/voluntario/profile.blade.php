@extends('layout.main')
@section('title', 'Mi perfil')

@php
    $fullName = trim($voluntary->name.' '.$voluntary->lastname);
    $initials = collect(explode(' ', $fullName))->filter()->take(2)->map(fn($part) => mb_strtoupper(mb_substr($part, 0, 1)))->join('');
    $types = ['V'=>'Voluntario','A'=>'Aspirante','C'=>'Cooperador','H'=>'Honorario'];
    $statuses = ['A'=>'Activo','I'=>'Inactivo','S'=>'Suspendido','R'=>'En receso'];
    $serviceStart = $voluntary->init_voluntary ? \Carbon\Carbon::parse($voluntary->init_voluntary) : null;
@endphp

@section('content')
<div class="profile-page">
  <section class="profile-hero">
    <div class="profile-hero__content">
      <div class="profile-avatar">{{ $initials ?: 'CSA' }}</div>
      <div class="profile-name">
        <span><i class="fa-solid fa-mountain-sun"></i> Cuerpo de Socorro Andino de Chile</span>
        <h1>{{ $fullName }}</h1>
        <p><i class="fa-solid fa-location-dot"></i> Delegación {{ $voluntary->delegation->name ?? 'Sin asignar' }} <b>·</b> <i class="fa-solid fa-medal"></i> {{ $voluntary->cargo->nombre ?? 'Sin cargo asignado' }}</p>
      </div>
      <div class="profile-brand"><img src="{{ asset('assets/img/logo-socorro.png') }}" alt="Socorro Andino"><div><span>{{ $types[$voluntary->type] ?? $voluntary->type }}</span><span class="status-{{ strtolower($voluntary->status) }}">● {{ $statuses[$voluntary->status] ?? $voluntary->status }}</span></div></div>
    </div>
  </section>

  <div class="profile-stats">
    <div><i class="fa-solid fa-shield-halved"></i><p>Participación operativa<strong>{{ $rescues->count() }} rescates</strong></p></div>
    <div><i class="fa-solid fa-person-hiking orange"></i><p>Tiempo de servicio<strong>{{ $serviceStart ? $serviceStart->diffForHumans(now(), true) : 'Sin registro' }}</strong></p></div>
    <div><i class="fa-solid fa-receipt"></i><p>Cuotas registradas<strong>{{ $dues->count() }} pagos</strong></p></div>
    <div><i class="fa-solid fa-sack-dollar orange"></i><p>Total aportado<strong>$ {{ number_format($dues->sum('amount'), 0, ',', '.') }}</strong></p></div>
  </div>

  <div class="row g-4 mt-0">
    <div class="col-xl-8"><section class="profile-card">
      <header><div><small>Ficha personal</small><h2>Información del voluntario</h2></div><i class="fa-regular fa-address-card"></i></header>
      <div class="profile-grid">
        @foreach([
          ['fa-regular fa-user','Nombre completo',$fullName],['fa-regular fa-id-card','Identificación',$voluntary->document],
          ['fa-solid fa-cake-candles','Nacimiento',\Carbon\Carbon::parse($voluntary->birthday)->format('d/m/Y').' · '.\Carbon\Carbon::parse($voluntary->birthday)->age.' años'],
          ['fa-solid fa-venus-mars','Género',$voluntary->gender === 'F' ? 'Femenino' : 'Masculino'],['fa-solid fa-briefcase','Profesión',$voluntary->profession ?: 'No informada'],
          ['fa-solid fa-phone','Teléfono',$voluntary->phone ?: 'No informado'],['fa-solid fa-house','Dirección',$voluntary->address ?: 'No informada'],['fa-solid fa-car-side','Licencia clase B',$voluntary->license ? 'Sí' : 'No']
        ] as [$icon,$label,$value])
          <div class="profile-field"><i class="{{ $icon }}"></i><p><small>{{ $label }}</small><strong>{{ $value }}</strong></p></div>
        @endforeach
      </div>
    </section></div>
    <div class="col-xl-4"><section class="profile-card h-100">
      <header><div><small>Seguridad</small><h2>Antecedentes médicos</h2></div><i class="fa-solid fa-heart-pulse orange"></i></header>
      <div class="blood"><span>Grupo sanguíneo</span><strong>{{ $voluntary->blood_type ?: 'N/I' }}</strong></div>
      <div class="medical"><p>Enfermedad declarada <b class="{{ $voluntary->disease ? 'yes' : '' }}">{{ $voluntary->disease ? 'Sí' : 'No' }}</b></p><p>Alergias declaradas <b class="{{ $voluntary->allergic ? 'yes' : '' }}">{{ $voluntary->allergic ? 'Sí' : 'No' }}</b></p><p>Uso de medicamentos <b class="{{ $voluntary->medicine ? 'yes' : '' }}">{{ $voluntary->medicine ? 'Sí' : 'No' }}</b></p></div>
      <button class="emergency-btn" data-bs-toggle="modal" data-bs-target="#emergencyModal"><i class="fa-solid fa-phone-volume"></i><span><small>Acceso rápido</small>Contactos de emergencia</span><i class="fa-solid fa-chevron-right ms-auto"></i></button>
    </section></div>
  </div>

  <div class="row g-4 mt-0">
    <div class="col-xl-7"><section class="profile-card h-100"><header><div><small>Historial operativo</small><h2>Rescates en los que participaste</h2></div><b class="count">{{ $rescues->count() }}</b></header><div class="timeline">
      @forelse($rescues as $rescue)<article><i class="fa-solid fa-mountain"></i><div><span>{{ $rescue->fecha_operativo ? \Carbon\Carbon::parse($rescue->fecha_operativo)->format('d M Y') : 'Fecha pendiente' }}</span><h3>{{ $rescue->tipo_emergencia ?: 'Operativo de rescate' }}</h3><p><i class="fa-solid fa-location-dot"></i> {{ $rescue->lugar ?: 'Lugar no informado' }}</p></div></article>@empty @include('module.voluntario.profile-empty',['icon'=>'fa-mountain-sun','title'=>'Sin rescates registrados','copy'=>'Tus futuras participaciones operativas aparecerán aquí.']) @endforelse
    </div></section></div>
    <div class="col-xl-5"><section class="profile-card h-100"><header><div><small>Trayectoria</small><h2>Anotaciones</h2></div><b class="count">{{ $remark->count() }}</b></header><div class="remarks">
      @forelse($remark as $item)<article><div><strong>{{ $item->user?->name ?? 'Responsable no asignado' }}</strong><b class="gravity-{{ $item->gravity }}">{{ ['Felicitación','Nula','Baja','Media','Alta','Extrema'][$item->gravity] ?? 'Anotación' }}</b></div><p>{{ $item->remark }}</p><time><i class="fa-regular fa-clock"></i> {{ $item->created_at->format('d M Y, H:i') }}</time></article>@empty @include('module.voluntario.profile-empty',['icon'=>'fa-message','title'=>'Sin anotaciones','copy'=>'No hay observaciones registradas en tu ficha.']) @endforelse
    </div></section></div>
  </div>

  <section class="profile-card mt-4"><header><div><small>Finanzas personales</small><h2>Historial de cuotas</h2></div><b class="count">{{ $dues->count() }}</b></header><div class="table-responsive"><table class="table align-middle mb-0"><thead><tr><th>Fecha</th><th>Descripción</th><th>Referencia</th><th class="text-end">Monto</th></tr></thead><tbody>
    @forelse($dues as $due)<tr><td>{{ $due->transaction_date->format('d/m/Y') }}</td><td><strong>{{ $due->description }}</strong></td><td>{{ $due->reference ?: 'Sin referencia' }}</td><td class="text-end amount">$ {{ number_format($due->amount,0,',','.') }}</td></tr>@empty<tr><td colspan="4">@include('module.voluntario.profile-empty',['icon'=>'fa-receipt','title'=>'Aún no hay pagos asociados','copy'=>'Las cuotas registradas en Finanzas aparecerán aquí.'])</td></tr>@endforelse
  </tbody></table></div></section>
</div>

<div class="modal fade" id="emergencyModal" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content"><div class="modal-header"><div><span class="section-label">Información crítica</span><h5 class="modal-title">Contactos de emergencia</h5></div><button class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body p-4">@forelse($emergency as $contact)<div class="contact"><i class="fa-solid fa-user"></i><p><strong>{{ $contact->emergency_name }}</strong><small>{{ $contact->relationship }} · {{ $contact->emergency_phone }}</small></p><a href="tel:{{ $contact->emergency_phone }}"><i class="fa-solid fa-phone"></i></a></div>@empty @include('module.voluntario.profile-empty',['icon'=>'fa-phone-slash','title'=>'Sin contactos registrados','copy'=>'Solicita al administrador actualizar tu ficha.']) @endforelse</div></div></div></div>
@endsection

@push('styles')
<link href="{{ asset('assets/css/profile-premium.css') }}" rel="stylesheet">
@endpush
