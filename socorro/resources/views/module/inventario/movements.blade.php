@extends('layout.main')
@section('title', 'Movimientos de stock')
@push('styles')
<style>
.movement-hero{display:flex;align-items:center;justify-content:space-between;gap:1rem;padding:1.4rem 1.5rem;border-radius:1rem;color:#fff;background:linear-gradient(125deg,#212529,#455a64);box-shadow:0 12px 30px rgba(20,30,40,.18)}.movement-hero h1{margin:0;color:#fff;font-size:1.7rem}.movement-hero p{margin:.25rem 0 0;color:rgba(255,255,255,.68)}.movement-panel{margin-top:1.25rem;padding:1.25rem;background:#fff;border-radius:.95rem;box-shadow:0 8px 24px rgba(20,30,40,.07);color:#263238}.movement-panel header h2{margin:0;font-size:1.05rem;font-weight:800}.movement-panel header p{margin:.2rem 0 0;color:#78909c;font-size:.78rem}.movement-table thead{background:#263238}.movement-table th{color:#fff!important;font-size:.68rem!important}.movement-table td{vertical-align:middle;font-size:.8rem}.movement-badge{display:inline-flex;align-items:center;gap:.35rem;padding:.35rem .55rem;border-radius:999px;font-size:.72rem;font-weight:800}.movement-badge.add{color:#0f5132;background:#d1e7dd}.movement-badge.reduce{color:#842029;background:#f8d7da}.movement-panel .dataTables_filter input{border:1px solid #dce3e7;border-radius:.6rem;padding:.45rem .7rem}.movement-panel .dt-buttons .btn{border-radius:.55rem}@media(max-width:767.98px){.movement-hero{align-items:flex-start;flex-direction:column;padding:1.1rem}.movement-panel{padding:1rem}}
</style>
@endpush
@section('content')
<div class="movement-hero"><div><span class="badge bg-warning text-dark mb-2">Auditoría de inventario</span><h1>Movimientos de stock</h1><p>Revisa entradas, salidas, saldos, costos y responsables de cada operación.</p></div><a href="{{ route('inventario') }}" class="btn btn-warning mb-0"><i class="fa-solid fa-arrow-left me-2"></i>Volver al inventario</a></div>
<section class="movement-panel"><header class="mb-4"><h2>Historial completo</h2><p>Utiliza el buscador o exporta los resultados para análisis y respaldo.</p></header><div class="table-responsive"><table id="datatableStockMovements" class="table table-hover movement-table nowrap" style="width:100%"><thead><tr><th>Movimiento</th><th>Producto</th><th>Bodega</th><th>Cantidad</th><th>Saldo</th><th>Costo unitario</th><th>Costo total</th><th>Motivo / referencia</th><th>Responsable</th><th>Fecha</th></tr></thead><tbody></tbody></table></div></section>
@endsection
@push('script')
<script>
$(document).ready(function(){
$('#datatableStockMovements').DataTable({ajax:{url:'{{ route('inventario.stock_movements') }}',dataSrc:''},columns:[
{data:'type',render:d=>`<span class="movement-badge ${d}"><i class="fa-solid ${d==='add'?'fa-arrow-up':'fa-arrow-down'}"></i>${d==='add'?'Entrada':'Salida'}</span>`},
{data:'product_name',defaultContent:'—',render:d=>`<strong>${d||'—'}</strong>`},
{data:'warehouse_name',defaultContent:'—'},
{data:'quantity',render:(d,t,r)=>`<strong class="${r.type==='add'?'text-success':'text-danger'}">${r.type==='add'?'+':'−'}${d}</strong>`},
{data:'balance_after',defaultContent:null,render:(d,t,r)=>d===null?'Histórico':`${r.balance_before} → <strong>${d}</strong>`},
{data:'unit_cost',render:d=>'$ '+Intl.NumberFormat('es-CL').format(d||0)},
{data:null,render:d=>'$ '+Intl.NumberFormat('es-CL').format((d.unit_cost||0)*(d.quantity||0))},
{data:'reason',defaultContent:'—',render:(d,t,r)=>`${d||'—'}${r.reference?`<div class="text-muted small">Ref. ${r.reference}</div>`:''}`},
{data:'user_name',defaultContent:'—'},
{data:'occurred_at',render:d=>moment(d).format('DD/MM/YYYY HH:mm')}
],buttons:[{extend:'excelHtml5',text:'<i class="fa-solid fa-file-excel me-1"></i>Excel',className:'btn btn-success me-2'},{extend:'csvHtml5',text:'<i class="fa-solid fa-file-csv me-1"></i>CSV',className:'btn btn-outline-dark me-2'},{extend:'print',text:'<i class="fa-solid fa-print me-1"></i>Imprimir',className:'btn btn-dark me-2'}],order:[[9,'desc']],language:{emptyTable:'No hay movimientos registrados',info:'Mostrando _START_ a _END_ de _TOTAL_ movimientos',infoEmpty:'Sin movimientos',infoFiltered:'(filtrado de _MAX_)',lengthMenu:'Mostrar _MENU_',loadingRecords:'Cargando...',processing:'Procesando...',search:'Buscar:',zeroRecords:'No se encontraron movimientos',paginate:{next:'Siguiente',previous:'Anterior'}},dom:"<'row mb-3'<'col-md-7 d-flex flex-wrap gap-2'Bl><'col-md-5'f>><'row'<'col-12'tr>><'row mt-3'<'col-md-6'i><'col-md-6'p>>",responsive:true});
});
</script>
@endpush
