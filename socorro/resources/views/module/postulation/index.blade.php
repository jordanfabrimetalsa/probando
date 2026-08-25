@extends('layout.main')

@section('title', 'Postulaciones')

@section('content')
<div class="container-fluid py-3 flux-page-shell">
    <div class="flux-toolbar">
        <div><h1 class="flux-page-title">Postulaciones</h1><p class="flux-page-copy">Convocatorias y postulantes asociados a cada delegación.</p></div>
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#postulationCreateModal" @disabled(!$hasAvailableDelegation) title="{{ $hasAvailableDelegation ? 'Crear convocatoria' : 'Todas las delegaciones ya tienen una postulación abierta' }}"><i class="fa-solid fa-plus me-2"></i>Nueva convocatoria</button>
    </div>
    <div class="row g-3 mb-4">
        <div class="col-md-4"><div class="flux-stat"><span class="flux-stat__label">Convocatorias</span><div class="d-flex justify-content-between"><strong class="flux-stat__value" id="postulationTotal">0</strong><span class="flux-stat__icon"><i class="fa-solid fa-file-signature"></i></span></div><span class="flux-stat__meta">Total registradas</span></div></div>
        <div class="col-md-4"><div class="flux-stat"><span class="flux-stat__label">Abiertas</span><div class="d-flex justify-content-between"><strong class="flux-stat__value" id="postulationOpen">0</strong><span class="flux-stat__icon"><i class="fa-solid fa-door-open"></i></span></div><span class="flux-stat__meta">Disponibles en el sitio público</span></div></div>
        <div class="col-md-4"><div class="flux-stat flux-stat--orange"><span class="flux-stat__label">Postulantes</span><div class="d-flex justify-content-between"><strong class="flux-stat__value" id="postulationPeople">0</strong><span class="flux-stat__icon"><i class="fa-solid fa-users"></i></span></div><span class="flux-stat__meta">Solicitudes recibidas</span></div></div>
    </div>
    <div class="card"><div class="card-header px-4 py-3"><h6 class="mb-1">Convocatorias por delegación</h6><p class="mb-0 text-muted text-xs">Administra vigencia, cupos y postulantes sin editar la delegación.</p></div><div class="card-body p-4"><table id="postulationsTable" class="table table-striped dt-responsive nowrap w-100"><thead><tr><th>Convocatoria</th><th>Delegación</th><th>Vigencia</th><th>Cupos</th><th>Postulantes</th><th>Estado</th><th>Acciones</th></tr></thead><tbody></tbody></table></div></div>
</div>

<div class="modal fade" id="postulationCreateModal" tabindex="-1" aria-hidden="true">
 <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable"><div class="modal-content">
  <div class="modal-header postulation-modal__header"><div><span>NUEVA CONVOCATORIA</span><h5 class="modal-title">Publicar proceso de postulación</h5><p>La convocatoria quedará vinculada a la delegación seleccionada.</p></div><button class="btn-close" data-bs-dismiss="modal"></button></div>
  <form id="postulationForm" novalidate>@csrf<div class="modal-body p-4">
   <div class="row g-3">
    <div class="col-md-7"><label class="form-label">Título <span class="text-danger">*</span></label><input class="form-control" name="title" required maxlength="180" placeholder="Ej: Proceso de incorporación 2026"><div class="invalid-feedback" data-error-for="title"></div></div>
    <div class="col-md-5"><label class="form-label">Delegación <span class="text-danger">*</span></label><select class="form-select" name="delegation_id" required><option value="">Seleccione delegación</option>@foreach($delegations as $delegation)<option value="{{ $delegation->id }}" @disabled($delegation->open_postulations_count > 0)>{{ $delegation->name }}{{ $delegation->open_postulations_count > 0 ? ' · ya tiene una abierta' : '' }}</option>@endforeach</select><div class="invalid-feedback" data-error-for="delegation_id"></div><small class="text-muted">Debes cerrar la convocatoria anterior para habilitar esta delegación.</small></div>
    <div class="col-12"><label class="form-label">Requisitos y descripción <span class="text-danger">*</span></label><textarea class="form-control" name="description" rows="5" required placeholder="Perfil buscado, requisitos, etapas y documentación necesaria"></textarea><div class="invalid-feedback" data-error-for="description"></div></div>
    <div class="col-md-4"><label class="form-label">Cantidad máxima <span class="text-danger">*</span></label><input class="form-control" type="number" name="cant_people_selected" min="1" max="1000" required placeholder="Ej: 20"><div class="invalid-feedback" data-error-for="cant_people_selected"></div></div>
    <div class="col-md-4"><label class="form-label">Fecha de inicio <span class="text-danger">*</span></label><input class="form-control" type="datetime-local" name="start_date" required><div class="invalid-feedback" data-error-for="start_date"></div></div>
    <div class="col-md-4"><label class="form-label">Fecha de cierre <span class="text-danger">*</span></label><input class="form-control" type="datetime-local" name="end_date" required><div class="invalid-feedback" data-error-for="end_date"></div></div>
   </div>
  </div><div class="modal-footer"><button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancelar</button><button type="submit" class="btn btn-dark" id="savePostulation"><i class="fa-solid fa-paper-plane me-2"></i>Publicar convocatoria</button></div></form>
 </div></div>
</div>

<div class="modal fade" id="postulationDetailModal" tabindex="-1" aria-hidden="true">
 <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable"><div class="modal-content">
  <div class="modal-header postulation-modal__header"><div><span id="detailDelegation">DELEGACIÓN</span><h5 class="modal-title" id="detailTitle">Detalle de convocatoria</h5><p id="detailDates"></p></div><button class="btn-close" data-bs-dismiss="modal"></button></div>
  <div class="modal-body p-4"><div class="postulation-description" id="detailDescription"></div><div class="d-flex align-items-center justify-content-between mt-4 mb-3"><h6 class="mb-0">Personas postulantes</h6><span class="badge bg-dark" id="detailCount">0 registros</span></div><div class="table-responsive"><table class="table table-striped"><thead><tr><th>Nombre</th><th>RUT</th><th>Teléfono</th><th>Correo</th><th>Presentación</th></tr></thead><tbody id="applicantsBody"></tbody></table></div></div>
 </div></div>
</div>
@endsection

@push('styles')
<style>
.postulation-modal__header{padding:20px 24px!important}.postulation-modal__header>div>span{color:#ea4e1a;font-size:.6rem;font-weight:800;letter-spacing:.12em}.postulation-modal__header h5{margin-top:3px}.postulation-modal__header p{margin:4px 0 0;color:#70858e;font-size:.7rem}.postulation-description{padding:18px;border-left:4px solid #ea4e1a;border-radius:8px;background:#f3f7f8;color:#38535f;white-space:pre-line}.postulation-title-cell strong{display:block;color:#193743;font-size:.78rem}.postulation-title-cell span{color:#7a8d95;font-size:.64rem}.postulation-actions{display:flex;justify-content:center;gap:5px}.postulation-actions .btn{margin:0!important}
</style>
@endpush

@push('script')
<script>
let postulationsTable;
$(function(){
 postulationsTable=$('#postulationsTable').DataTable({
  ajax:{url:'{{ route("postulations.admin.data") }}',dataSrc:function(rows){updatePostulationStats(rows);return rows;}},
  order:[[2,'desc']],responsive:true,
  columns:[
   {data:null,render:r=>'<div class="postulation-title-cell"><strong>'+escapePostulation(r.title)+'</strong><span>#'+r.id+'</span></div>'},
   {data:'delegation.name',defaultContent:'Sin delegación'},
   {data:null,render:r=>moment(r.start_date).format('DD/MM/YYYY')+'<br><small>hasta '+moment(r.end_date).format('DD/MM/YYYY')+'</small>'},
   {data:'cant_people_selected'},
   {data:'people_count',defaultContent:0},
   {data:null,render:r=>postulationIsOpen(r)?'<span class="badge bg-success">Abierta</span>':'<span class="badge bg-secondary">Cerrada</span>'},
   {data:null,orderable:false,searchable:false,render:r=>'<div class="postulation-actions"><button class="btn btn-info text-white" onclick="showPostulation('+r.id+')" title="Ver postulantes"><i class="fa-solid fa-users"></i></button><button class="btn btn-dark" onclick="togglePostulation('+r.id+',\''+(r.status==='A'?'C':'A')+'\')" title="'+(r.status==='A'?'Cerrar':'Abrir')+'"><i class="fa-solid '+(r.status==='A'?'fa-lock':'fa-lock-open')+'"></i></button><button class="btn btn-danger" onclick="deletePostulation('+r.id+')" title="Eliminar"><i class="fa-solid fa-trash"></i></button></div>'}
  ],
  language:{emptyTable:'No hay convocatorias',info:'Mostrando _START_ a _END_ de _TOTAL_',infoEmpty:'Sin registros',search:'Buscar:',zeroRecords:'No se encontraron resultados',paginate:{next:'Siguiente',previous:'Anterior'}}
 });
});
function postulationIsOpen(r){return r.status==='A'&&moment(r.end_date).isSameOrAfter(moment());}
function updatePostulationStats(rows){$('#postulationTotal').text(rows.length);$('#postulationOpen').text(rows.filter(postulationIsOpen).length);$('#postulationPeople').text(rows.reduce((n,r)=>n+Number(r.people_count||0),0));}
function escapePostulation(v){return $('<div>').text(v||'').html();}
$('#postulationForm').on('submit',function(e){e.preventDefault();const form=$(this),button=$('#savePostulation');form.find('.is-invalid').removeClass('is-invalid');form.find('.invalid-feedback').text('');button.prop('disabled',true).html('<span class="spinner-border spinner-border-sm me-2"></span>Publicando...');$.ajax({url:'{{ route("postulations.store") }}',type:'POST',data:form.serialize(),success:r=>{form[0].reset();bootstrap.Modal.getOrCreateInstance(document.getElementById('postulationCreateModal')).hide();postulationsTable.ajax.reload();Swal.fire({icon:'success',title:'Convocatoria publicada',text:r.message});},error:x=>{const errors=x.responseJSON?.errors||{};Object.keys(errors).forEach(k=>{form.find('[name="'+k+'"]').addClass('is-invalid');form.find('[data-error-for="'+k+'"]').text(errors[k][0]);});Swal.fire({icon:'error',title:'Revisa los datos',text:Object.values(errors)[0]?.[0]||x.responseJSON?.error||'No fue posible crear la convocatoria.'});},complete:()=>button.prop('disabled',false).html('<i class="fa-solid fa-paper-plane me-2"></i>Publicar convocatoria')});});
function showPostulation(id){$.get('{{ url("postulations/details") }}/'+id,r=>{$('#detailTitle').text(r.title);$('#detailDelegation').text(r.delegation?.name||'Delegación');$('#detailDates').text(moment(r.start_date).format('DD/MM/YYYY HH:mm')+' · '+moment(r.end_date).format('DD/MM/YYYY HH:mm'));$('#detailDescription').text(r.description);const people=r.people||[];$('#detailCount').text(people.length+' registros');$('#applicantsBody').html(people.length?people.map(p=>'<tr><td><strong>'+escapePostulation((p.name||'')+' '+(p.last_name||''))+'</strong></td><td>'+escapePostulation(p.rut||'—')+'</td><td>'+escapePostulation(p.phone||'—')+'</td><td>'+escapePostulation(p.email||'—')+'</td><td>'+escapePostulation(p.presentation||'—')+'</td></tr>').join(''):'<tr><td colspan="5" class="text-center text-muted py-4">Aún no hay postulantes.</td></tr>');bootstrap.Modal.getOrCreateInstance(document.getElementById('postulationDetailModal')).show();}).fail(()=>Swal.fire({icon:'error',title:'Error',text:'No fue posible cargar la convocatoria.'}));}
function togglePostulation(id,status){$.ajax({url:'{{ url("postulations") }}/'+id+'/status',type:'PATCH',data:{_token:'{{ csrf_token() }}',status},success:r=>{Swal.fire({icon:'success',title:'Estado actualizado',text:r.message}).then(()=>window.location.reload());},error:x=>Swal.fire({icon:'error',title:'No se pudo cambiar el estado',text:x.responseJSON?.errors?.status?.[0]||x.responseJSON?.message||'La delegación puede tener otra convocatoria abierta.'})});}
function deletePostulation(id){Swal.fire({icon:'warning',title:'¿Eliminar convocatoria?',text:'También se eliminarán sus postulantes asociados.',showCancelButton:true,confirmButtonText:'Eliminar',cancelButtonText:'Cancelar',confirmButtonColor:'#ea4e1a'}).then(r=>{if(!r.isConfirmed)return;$.ajax({url:'{{ url("postulations") }}/'+id,type:'DELETE',data:{_token:'{{ csrf_token() }}'},success:x=>{postulationsTable.ajax.reload();Swal.fire({icon:'success',title:'Eliminada',text:x.message});},error:x=>Swal.fire({icon:'error',title:'Error',text:x.responseJSON?.message||'No fue posible eliminarla.'})});});}
</script>
@endpush
