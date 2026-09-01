@extends('layout.main')

@section('title', 'Solicitar equipo')

@push('styles')
<style>
    .equipment-page { color:#263238; }
    .equipment-hero { background:linear-gradient(125deg,#212529,#455a64); color:#fff; border-radius:1rem; padding:1.4rem 1.5rem; box-shadow:0 12px 30px rgba(20,30,40,.18); }
    .equipment-hero p { color:rgba(255,255,255,.7); }
    .equipment-panel { background:#fff; border:1px solid rgba(38,50,56,.08); border-radius:.9rem; box-shadow:0 8px 24px rgba(20,30,40,.07); padding:1.25rem; }
    .equipment-tabs { border:0; gap:.5rem; }
    .equipment-tabs .nav-link { border:0; border-radius:.65rem; color:#607d8b; font-weight:700; }
    .equipment-tabs .nav-link.active { color:#fff; background:#263238; }
    .equipment-title { font-size:1rem; font-weight:700; color:#263238; }
    .equipment-copy { color:#78909c; font-size:.82rem; }
    .equipment-form label { color:#607d8b; font-size:.78rem; font-weight:700; }
    .equipment-form .form-control,.equipment-form .form-select { min-height:2.7rem; border:1px solid #dce3e7; border-radius:.6rem; }
    .equipment-item { padding:1rem; border:1px solid #e5eaed; border-radius:.75rem; background:#f8fafb; }
    .request-card { border:1px solid #e4e9ec; border-radius:.8rem; padding:1rem; }
    .request-card + .request-card { margin-top:.8rem; }
    .request-meta { color:#78909c; font-size:.78rem; }
    .request-items { margin:.8rem 0 0; padding:0; list-style:none; }
    .request-items li { display:flex; justify-content:space-between; gap:1rem; padding:.45rem 0; border-bottom:1px dashed #e1e6e9; font-size:.82rem; }
    .status-pill { display:inline-flex; padding:.3rem .55rem; border-radius:999px; font-size:.7rem; font-weight:800; }
    .status-pending { background:#fff3cd; color:#856404; }.status-approved { background:#d1ecf1;color:#0c5460;}.status-rejected {background:#f8d7da;color:#842029;}.status-partially_returned {background:#e2e3f3;color:#41448a;}.status-returned {background:#d1e7dd;color:#0f5132;}
    .stock-hint { color:#78909c; font-size:.74rem; }
    @media(max-width:767.98px){.equipment-hero{padding:1.1rem}.equipment-panel{padding:1rem}.request-items li{flex-direction:column;gap:.2rem}}
</style>
@endpush

@section('content')
@php
    $statusLabels = ['pending'=>'Pendiente','approved'=>'Entregada','rejected'=>'Rechazada','partially_returned'=>'Devolución parcial','returned'=>'Devuelta'];
    $productsForJs = $products->map(function ($product) {
        return [
            'id' => $product->id,
            'warehouse_id' => $product->id_warehouse,
            'name' => $product->name,
            'stock' => $product->stock,
            'brand' => $product->brand,
        ];
    })->values();
@endphp
<div class="equipment-page">
    <section class="equipment-hero d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3 mb-4">
        <div><span class="badge bg-warning text-dark mb-2">Logística operacional</span><h1 class="h3 text-white mb-1">Solicitud de equipo</h1><p class="mb-0">Reserva, entrega y devolución de material con stock actualizado automáticamente.</p></div>
        <div class="text-lg-end"><small class="d-block text-white-50">Tu delegación</small><strong>{{ auth()->user()->voluntary?->delegation?->name ?? 'Sin delegación' }}</strong></div>
    </section>

    @if($errors->any())<div class="alert alert-danger text-white"><strong>No fue posible completar la operación:</strong> {{ $errors->first() }}</div>@endif
    @if(session('success'))<div class="alert alert-success text-white">{{ session('success') }}</div>@endif

    <div class="equipment-panel">
        <ul class="nav nav-tabs equipment-tabs mb-4" role="tablist">
            <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#newRequest"><i class="fa-solid fa-box-open me-2"></i>Nueva solicitud</button></li>
            <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#myHistory"><i class="fa-solid fa-clock-rotate-left me-2"></i>Mi historial <span class="badge bg-secondary ms-1">{{ $personal->count() }}</span></button></li>
            @if(auth()->user()->hasPermission('inventory.manage'))
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#reviewRequests"><i class="fa-solid fa-clipboard-check me-2"></i>Revisar <span class="badge bg-warning text-dark ms-1">{{ $pending->count() }}</span></button></li>
                <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#returns"><i class="fa-solid fa-arrow-rotate-left me-2"></i>Devoluciones <span class="badge bg-info text-dark ms-1">{{ $toReturn->count() }}</span></button></li>
            @endif
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="newRequest">
                <div class="mb-4"><h2 class="equipment-title mb-1">Pedir material de bodega</h2><p class="equipment-copy mb-0">El stock se descontará únicamente cuando la solicitud sea aprobada.</p></div>
                @if($warehouses->isEmpty())
                    <div class="alert alert-warning">Tu delegación no tiene bodegas activas disponibles.</div>
                @else
                <form method="POST" action="{{ route('equipment-requests.store') }}" class="equipment-form">@csrf
                    <div class="row g-3 mb-4">
                        <div class="col-md-4"><label>Bodega *</label><select class="form-select" name="warehouse_id" id="requestWarehouse" required><option value="">Seleccione</option>@foreach($warehouses as $warehouse)<option value="{{ $warehouse->id }}" @selected(old('warehouse_id')==$warehouse->id)>{{ $warehouse->name }} · {{ $warehouse->path }}</option>@endforeach</select></div>
                        <div class="col-md-4"><label>Fecha de retiro *</label><input class="form-control" type="date" name="needed_at" min="{{ now()->format('Y-m-d') }}" value="{{ old('needed_at',now()->format('Y-m-d')) }}" required></div>
                        <div class="col-md-4"><label>Devolución estimada *</label><input class="form-control" type="date" name="expected_return_at" min="{{ now()->format('Y-m-d') }}" value="{{ old('expected_return_at',now()->addDay()->format('Y-m-d')) }}" required></div>
                        <div class="col-12"><label>Motivo o actividad *</label><input class="form-control" name="purpose" maxlength="180" value="{{ old('purpose') }}" placeholder="Ej.: operativo de rescate, práctica técnica o guardia" required></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3"><div><h3 class="equipment-title mb-0">Equipos solicitados</h3><span class="equipment-copy">Solo se muestran productos con stock disponible.</span></div><button class="btn btn-sm btn-outline-dark mb-0" type="button" id="addEquipmentItem"><i class="fa-solid fa-plus me-1"></i>Agregar equipo</button></div>
                    <div id="equipmentItems" class="d-grid gap-2"></div>
                    <div class="d-flex justify-content-end mt-4"><button class="btn btn-dark px-4 mb-0" @disabled($products->isEmpty())><i class="fa-solid fa-paper-plane me-2"></i>Enviar solicitud</button></div>
                </form>
                @endif
            </div>

            <div class="tab-pane fade" id="myHistory">
                <div class="mb-4"><h2 class="equipment-title mb-1">Historial personal</h2><p class="equipment-copy mb-0">Seguimiento de todas tus solicitudes, entregas y devoluciones.</p></div>
                @forelse($personal as $equipmentRequest)
                    <article class="request-card"><div class="d-flex flex-wrap justify-content-between gap-2"><div><strong>SOL-{{ $equipmentRequest->id }} · {{ $equipmentRequest->purpose }}</strong><div class="request-meta">{{ $equipmentRequest->warehouse->name }} · solicitada {{ $equipmentRequest->created_at->format('d/m/Y H:i') }} · devolución {{ $equipmentRequest->expected_return_at?->format('d/m/Y') }}</div></div><span class="status-pill status-{{ $equipmentRequest->status }}">{{ $statusLabels[$equipmentRequest->status] }}</span></div><ul class="request-items">@foreach($equipmentRequest->items as $item)<li><span>{{ $item->product->name }}</span><strong>{{ $item->returned_quantity }}/{{ $item->quantity }} devueltos</strong></li>@endforeach</ul>@if($equipmentRequest->review_note)<div class="small text-muted mt-2"><i class="fa-regular fa-comment me-1"></i>{{ $equipmentRequest->review_note }}</div>@endif</article>
                @empty<div class="text-center py-5 text-muted"><i class="fa-solid fa-box-open fa-2x mb-3"></i><p>Aún no has solicitado equipos.</p></div>@endforelse
            </div>

            @if(auth()->user()->hasPermission('inventory.manage'))
            <div class="tab-pane fade" id="reviewRequests">
                <div class="mb-4"><h2 class="equipment-title mb-1">Solicitudes pendientes</h2><p class="equipment-copy mb-0">Al aprobar se verificará y descontará el stock de forma inmediata.</p></div>
                @forelse($pending as $equipmentRequest)
                    <article class="request-card"><div class="d-flex flex-wrap justify-content-between gap-2"><div><strong>SOL-{{ $equipmentRequest->id }} · {{ $equipmentRequest->purpose }}</strong><div class="request-meta">{{ $equipmentRequest->user->name }} · {{ $equipmentRequest->warehouse->name }} · retiro {{ $equipmentRequest->needed_at->format('d/m/Y') }}</div></div><span class="status-pill status-pending">Pendiente</span></div><ul class="request-items">@foreach($equipmentRequest->items as $item)<li><span>{{ $item->product->name }}</span><strong>{{ $item->quantity }} solicitados · {{ $item->product->stock }} disponibles</strong></li>@endforeach</ul><form method="POST" action="{{ route('equipment-requests.review',$equipmentRequest) }}" class="mt-3">@csrf<div class="row g-2"><div class="col-md"><input class="form-control" name="review_note" maxlength="500" placeholder="Observación de revisión (opcional)"></div><div class="col-md-auto d-flex gap-2"><button class="btn btn-success mb-0" name="decision" value="approve"><i class="fa-solid fa-check me-1"></i>Aprobar</button><button class="btn btn-outline-danger mb-0" name="decision" value="reject"><i class="fa-solid fa-xmark me-1"></i>Rechazar</button></div></div></form></article>
                @empty<div class="text-center py-5 text-muted">No hay solicitudes pendientes.</div>@endforelse
            </div>

            <div class="tab-pane fade" id="returns">
                <div class="mb-4"><h2 class="equipment-title mb-1">Equipos por devolver</h2><p class="equipment-copy mb-0">Registra devoluciones completas o parciales; cada unidad vuelve al stock.</p></div>
                @forelse($toReturn as $equipmentRequest)
                    <article class="request-card"><div class="d-flex flex-wrap justify-content-between gap-2"><div><strong>SOL-{{ $equipmentRequest->id }} · {{ $equipmentRequest->purpose }}</strong><div class="request-meta">{{ $equipmentRequest->user->name }} · {{ $equipmentRequest->warehouse->name }} · prevista {{ $equipmentRequest->expected_return_at?->format('d/m/Y') }}</div></div><span class="status-pill status-{{ $equipmentRequest->status }}">{{ $statusLabels[$equipmentRequest->status] }}</span></div><form method="POST" action="{{ route('equipment-requests.return',$equipmentRequest) }}">@csrf<ul class="request-items">@foreach($equipmentRequest->items as $item)@php($remaining=$item->quantity-$item->returned_quantity)<li class="align-items-center"><span>{{ $item->product->name }} <small class="text-muted">({{ $remaining }} pendientes)</small></span><input class="form-control" style="max-width:130px" type="number" name="returns[{{ $item->id }}]" min="0" max="{{ $remaining }}" value="0" @disabled($remaining===0)></li>@endforeach</ul><div class="text-end mt-3"><button class="btn btn-dark mb-0"><i class="fa-solid fa-arrow-rotate-left me-2"></i>Registrar devolución</button></div></form></article>
                @empty<div class="text-center py-5 text-muted">No hay entregas pendientes de devolución.</div>@endforelse
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const products = {{ Illuminate\Support\Js::from($productsForJs) }};
    const container = document.getElementById('equipmentItems');
    const warehouse = document.getElementById('requestWarehouse');
    let itemIndex = 0;

    function addItem() {
        if (!container) return;
        const available = products.filter(product => String(product.warehouse_id) === String(warehouse?.value));
        const row = document.createElement('div'); row.className = 'equipment-item';
        row.innerHTML = `<div class="row g-2 align-items-end"><div class="col-md-8"><label>Producto *</label><select class="form-select product-select" name="items[${itemIndex}][product_id]" required><option value="">Seleccione equipo</option>${available.map(p=>`<option value="${p.id}" data-stock="${p.stock}">${p.name} · ${p.brand || 'Sin marca'} (${p.stock} disponibles)</option>`).join('')}</select><span class="stock-hint"></span></div><div class="col-8 col-md-3"><label>Cantidad *</label><input class="form-control quantity-input" type="number" name="items[${itemIndex}][quantity]" min="1" required></div><div class="col-4 col-md-1"><button class="btn btn-outline-danger w-100 mb-0 remove-item" type="button"><i class="fa-solid fa-trash"></i></button></div></div>`;
        container.appendChild(row); itemIndex++;
        row.querySelector('.remove-item').addEventListener('click',()=>{ if(container.children.length>1) row.remove(); });
        row.querySelector('.product-select').addEventListener('change',function(){ const stock=this.options[this.selectedIndex]?.dataset.stock; row.querySelector('.quantity-input').max=stock||''; row.querySelector('.stock-hint').textContent=stock ? `Máximo disponible: ${stock}` : ''; });
    }
    document.getElementById('addEquipmentItem')?.addEventListener('click', addItem);
    warehouse?.addEventListener('change',()=>{ container.innerHTML=''; itemIndex=0; addItem(); });
    if (warehouse?.value) addItem();
});
</script>
@endpush
