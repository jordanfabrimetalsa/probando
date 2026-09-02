@extends('layout.main')

@section('title', 'Finanzas')

@push('styles')
<style>
.finance-table-panel{overflow:hidden}.finance-table-wrap{padding:0;border:1px solid #e0e8eb;border-radius:.75rem;overflow:hidden}.finance-table{margin:0!important}.finance-table tbody tr{transition:background .15s}.finance-table tbody tr:hover{background:#f5f9fa}.finance-description{display:flex;align-items:center;gap:.65rem}.finance-description>span{display:grid;place-items:center;flex:0 0 34px;width:34px;height:34px;border-radius:.6rem}.finance-description>span.income{color:#176985;background:#e7f4f7}.finance-description>span.expense{color:#c84317;background:#fff0ea}.finance-description strong{display:block;color:#263f4a}.finance-kind{display:inline-flex;align-items:center;gap:.35rem;padding:.3rem .55rem;border-radius:999px;font-size:.68rem;font-weight:800}.finance-kind.income{color:#0f5132;background:#d1e7dd}.finance-kind.expense{color:#842029;background:#f8d7da}.finance-amount{font-size:.84rem;white-space:nowrap}.finance-table-panel .dataTables_wrapper>.row:first-child{align-items:center;margin-bottom:1rem}.finance-table-panel .dataTables_filter{display:flex;justify-content:flex-end}.finance-table-panel .dataTables_filter label{display:flex;align-items:center;gap:.5rem}.finance-table-panel .dataTables_filter input{min-width:220px;padding:.45rem .7rem}.finance-table-panel .dt-buttons{display:flex;flex-wrap:wrap;gap:.35rem}.finance-table-panel .dt-buttons .btn{margin:0!important}.finance-table-panel .dataTables_length label{display:flex;align-items:center;gap:.4rem}.finance-table-panel .dataTables_info{color:#78909c;font-size:.72rem}@media(max-width:767.98px){.finance-table-panel .dataTables_filter{justify-content:flex-start;margin-top:.75rem}.finance-table-panel .dataTables_filter input{min-width:150px}.finance-table-wrap{border:0}}
</style>
@endpush

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
        <div class="flux-panel finance-table-panel">
            <div class="d-flex justify-content-between align-items-center mb-3"><div><h2 class="flux-panel__title">Movimientos</h2><p class="flux-panel__copy mb-0">Últimos registros ordenados por fecha.</p></div></div>
            <div class="table-responsive finance-table-wrap">
                <table id="financeTransactionsTable" class="table align-middle finance-table" style="width:100%">
                    <thead><tr><th>Fecha</th><th>Descripción</th><th>Tipo</th><th>Categoría</th><th>Origen / destino</th><th>Voluntario</th><th class="text-end">Monto</th><th data-orderable="false"></th></tr></thead>
                    <tbody>
                        @foreach($transactions as $transaction)
                            <tr>
                                <td data-order="{{ $transaction->transaction_date->format('Y-m-d') }}">{{ $transaction->transaction_date->format('d/m/Y') }}</td>
                                <td><div class="finance-description"><span class="{{ $transaction->category->type }}"><i class="fa-solid {{ $transaction->category->type === 'income' ? 'fa-arrow-down':'fa-arrow-up' }}"></i></span><div><strong>{{ $transaction->description }}</strong><small class="text-muted">Registrado por {{ $transaction->user?->name ?? 'Sistema' }}</small></div></div></td>
                                <td><span class="finance-kind {{ $transaction->category->type }}">{{ $transaction->category->type === 'income' ? 'Ingreso':'Egreso' }}</span></td>
                                <td><span class="badge" style="background:{{ $transaction->category->color }}">{{ $transaction->category->name }}</span></td>
                                <td><strong>{{ $transaction->counterparty ?: '—' }}</strong>@if($transaction->reference)<div class="text-muted small">Ref. {{ $transaction->reference }}</div>@endif</td>
                                <td>{{ $transaction->voluntary ? $transaction->voluntary->name.' '.$transaction->voluntary->lastname : '—' }}</td>
                                <td data-order="{{ $transaction->category->type === 'income' ? $transaction->amount : -$transaction->amount }}" class="text-end fw-bold finance-amount {{ $transaction->category->type === 'income' ? 'text-success' : 'text-danger' }}">{{ $transaction->category->type === 'income' ? '+' : '−' }} $ {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                                <td class="text-end"><form method="POST" action="{{ route('finances.transactions.destroy', $transaction) }}" data-loading-title="Eliminando movimiento" onsubmit="return confirm('¿Eliminar este movimiento?')">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger" aria-label="Eliminar"><i class="fa-regular fa-trash-can"></i></button></form></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
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

$(document).ready(function () {
    $('#financeTransactionsTable').DataTable({
        pageLength: 15,
        lengthMenu: [[10, 15, 25, 50, -1], [10, 15, 25, 50, 'Todos']],
        order: [[0, 'desc']],
        columnDefs: [
            { targets: 7, orderable: false, searchable: false },
            { targets: 6, className: 'text-end' }
        ],
        buttons: [
            { extend: 'excelHtml5', text: '<i class="fa-solid fa-file-excel me-1"></i> Excel', className: 'btn btn-success' },
            { extend: 'csvHtml5', text: '<i class="fa-solid fa-file-csv me-1"></i> CSV', className: 'btn btn-outline-dark' },
            { extend: 'pdfHtml5', text: '<i class="fa-solid fa-file-pdf me-1"></i> PDF', className: 'btn btn-danger', orientation: 'landscape', pageSize: 'A4' },
            { extend: 'print', text: '<i class="fa-solid fa-print me-1"></i> Imprimir', className: 'btn btn-dark' }
        ],
        dom: "<'row'<'col-lg-8 d-flex flex-wrap align-items-center gap-2'Bl><'col-lg-4'f>><'row'<'col-12'tr>><'row mt-3 align-items-center'<'col-md-6'i><'col-md-6'p>>",
        responsive: true,
        language: {
            emptyTable: 'No hay movimientos financieros registrados',
            info: 'Mostrando _START_ a _END_ de _TOTAL_ movimientos',
            infoEmpty: 'Sin movimientos para mostrar',
            infoFiltered: '(filtrado de _MAX_ movimientos)',
            lengthMenu: 'Mostrar _MENU_',
            loadingRecords: 'Cargando...',
            processing: 'Procesando...',
            search: 'Buscar:',
            zeroRecords: 'No se encontraron movimientos',
            paginate: { first: 'Primero', last: 'Último', next: 'Siguiente', previous: 'Anterior' }
        }
    });
});
</script>
@endpush
