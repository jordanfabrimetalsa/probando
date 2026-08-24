@extends('layout.main')

@section('title', 'Finanzas')

@section('content')
<div class="flux-toolbar">
    <div><h1 class="flux-page-title">Finanzas</h1><p class="flux-page-copy">Organiza ingresos y egresos por categoría y mantén una trazabilidad simple de los movimientos.</p></div>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#financeCategoryModal"><i class="fa-solid fa-tags me-2"></i>Nueva categoría</button>
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#financeTransactionModal" @disabled($categories->isEmpty())><i class="fa-solid fa-plus me-2"></i>Registrar movimiento</button>
    </div>
</div>

<div class="row g-3 mb-4">
    <div class="col-md-4"><div class="flux-stat"><div class="d-flex justify-content-between"><div><div class="flux-stat__label">Ingresos</div><div class="flux-stat__value text-success">$ {{ number_format($income, 0, ',', '.') }}</div><div class="flux-stat__meta">Total registrado</div></div><span class="flux-stat__icon"><i class="fa-solid fa-arrow-trend-up"></i></span></div></div></div>
    <div class="col-md-4"><div class="flux-stat flux-stat--orange"><div class="d-flex justify-content-between"><div><div class="flux-stat__label">Egresos</div><div class="flux-stat__value" style="color:#c84317">$ {{ number_format($expense, 0, ',', '.') }}</div><div class="flux-stat__meta">Total registrado</div></div><span class="flux-stat__icon"><i class="fa-solid fa-arrow-trend-down"></i></span></div></div></div>
    <div class="col-md-4"><div class="flux-stat"><div class="d-flex justify-content-between"><div><div class="flux-stat__label">Saldo</div><div class="flux-stat__value">$ {{ number_format($income - $expense, 0, ',', '.') }}</div><div class="flux-stat__meta">Ingresos menos egresos</div></div><span class="flux-stat__icon"><i class="fa-solid fa-scale-balanced"></i></span></div></div></div>
</div>

<div class="row g-3">
    <div class="col-xl-9">
        <div class="flux-panel">
            <div class="d-flex justify-content-between align-items-center mb-3"><div><h2 class="flux-panel__title">Movimientos</h2><p class="flux-panel__copy mb-0">Últimos registros ordenados por fecha.</p></div></div>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead><tr><th>Fecha</th><th>Descripción</th><th>Categoría</th><th>Origen / destino</th><th>Voluntario</th><th class="text-end">Monto</th><th></th></tr></thead>
                    <tbody>
                        @forelse($transactions as $transaction)
                            <tr>
                                <td>{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                                <td><strong>{{ $transaction->description }}</strong><div class="text-muted small">{{ $transaction->user?->name ?? 'Sistema' }}</div></td>
                                <td><span class="badge" style="background:{{ $transaction->category->color }}">{{ $transaction->category->name }}</span></td>
                                <td><strong>{{ $transaction->counterparty ?: '—' }}</strong>@if($transaction->reference)<div class="text-muted small">Ref. {{ $transaction->reference }}</div>@endif</td>
                                <td>{{ $transaction->voluntary ? $transaction->voluntary->name.' '.$transaction->voluntary->lastname : '—' }}</td>
                                <td class="text-end fw-bold {{ $transaction->category->type === 'income' ? 'text-success' : 'text-danger' }}">{{ $transaction->category->type === 'income' ? '+' : '-' }} $ {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                <td class="text-end"><form method="POST" action="{{ route('finances.transactions.destroy', $transaction) }}" data-loading-title="Eliminando movimiento" onsubmit="return confirm('¿Eliminar este movimiento?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" aria-label="Eliminar"><i class="fa-regular fa-trash-can"></i></button></form></td>
                            </tr>
                        @empty
                            <tr><td colspan="7" class="text-center py-5 text-muted">Aún no hay movimientos registrados.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">{{ $transactions->links() }}</div>
        </div>
    </div>
    <div class="col-xl-3"><div class="flux-panel"><h2 class="flux-panel__title">Categorías</h2><p class="flux-panel__copy">Separación contable disponible.</p>
        @forelse($categories as $category)<div class="d-flex align-items-center justify-content-between py-2 border-bottom"><span class="d-flex align-items-center gap-2"><i class="fa-solid fa-circle" style="font-size:.55rem;color:{{ $category->color }}"></i><span class="small fw-semibold">{{ $category->name }} @if($category->is_system)<i class="fa-solid fa-lock ms-1 text-muted" title="Categoría fija"></i>@endif</span></span><span class="badge {{ $category->type === 'income' ? 'bg-success' : 'bg-danger' }}">{{ $category->type === 'income' ? 'Ingreso' : 'Egreso' }}</span></div>@empty<p class="text-muted small">Crea una categoría para comenzar.</p>@endforelse
    </div></div>
</div>

<div class="modal fade" id="financeCategoryModal" tabindex="-1" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><form method="POST" action="{{ route('finances.categories.store') }}" data-loading-title="Creando categoría">@csrf
    <div class="modal-header"><h2 class="modal-title">Nueva categoría</h2><button class="btn-close" type="button" data-bs-dismiss="modal"></button></div>
    <div class="modal-body"><div class="mb-3"><label class="form-label">Nombre</label><input class="form-control" name="name" value="{{ old('name') }}" maxlength="80" required></div><div class="mb-3"><label class="form-label">Tipo</label><select class="form-select" name="type" required><option value="">Seleccione</option><option value="income">Ingreso</option><option value="expense">Egreso</option></select></div><div><label class="form-label">Color</label><input class="form-control form-control-color" type="color" name="color" value="#176985" required></div></div>
    <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button><button class="btn btn-dark">Guardar categoría</button></div>
</form></div></div></div>

<div class="modal fade" id="financeTransactionModal" tabindex="-1" aria-hidden="true"><div class="modal-dialog modal-lg"><div class="modal-content"><form method="POST" action="{{ route('finances.transactions.store') }}" data-loading-title="Registrando movimiento">@csrf
    <div class="modal-header"><h2 class="modal-title">Registrar movimiento</h2><button class="btn-close" type="button" data-bs-dismiss="modal"></button></div>
    <div class="modal-body"><div class="row g-3"><div class="col-md-6"><label class="form-label">Categoría</label><select class="form-select" name="finance_category_id" id="finance_category_id" required><option value="">Seleccione</option>@foreach($categories as $category)<option value="{{ $category->id }}" data-system-key="{{ $category->system_key }}" data-type="{{ $category->type }}">{{ $category->type === 'income' ? 'Ingreso' : 'Egreso' }} · {{ $category->name }}</option>@endforeach</select></div><div class="col-md-3"><label class="form-label">Fecha</label><input class="form-control" type="date" name="transaction_date" value="{{ old('transaction_date', now()->format('Y-m-d')) }}" required></div><div class="col-md-3"><label class="form-label">Monto</label><input class="form-control" type="number" name="amount" min="1" step="1" required></div><div class="col-md-6"><label class="form-label" id="counterparty_label">Origen o destinatario</label><input class="form-control" name="counterparty" id="counterparty" maxlength="150" placeholder="Ej.: Mercado Libre, donante o institución" required></div><div class="col-md-6 d-none" id="voluntary_field"><label class="form-label">Voluntario que paga la cuota</label><select class="form-select" name="voluntary_id" id="voluntary_id"><option value="">Seleccione</option>@foreach($voluntaries as $voluntary)<option value="{{ $voluntary->id }}">{{ $voluntary->name }} {{ $voluntary->lastname }} · {{ $voluntary->document }}</option>@endforeach</select></div><div class="col-md-8"><label class="form-label">Descripción</label><input class="form-control" name="description" maxlength="180" required></div><div class="col-md-4"><label class="form-label">Referencia</label><input class="form-control" name="reference" maxlength="80"></div><div class="col-12"><label class="form-label">Notas</label><textarea class="form-control" name="notes" maxlength="1000"></textarea></div></div></div>
    <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button><button class="btn btn-dark">Registrar movimiento</button></div>
</form></div></div></div>
@endsection

@push('script')
<script>
document.getElementById('finance_category_id')?.addEventListener('change', function () {
    const option = this.options[this.selectedIndex];
    const isDues = option?.dataset.systemKey === 'membership_dues';
    const isExpense = option?.dataset.type === 'expense';
    document.getElementById('voluntary_field').classList.toggle('d-none', !isDues);
    document.getElementById('voluntary_id').required = isDues;
    document.getElementById('counterparty_label').textContent = isDues ? 'Origen del pago' : (isExpense ? 'Pagado a / destinatario' : 'Origen del ingreso');
    if (isDues) document.getElementById('counterparty').value = 'Voluntario CSA';
});
</script>
@endpush
