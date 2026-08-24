<label class="form-label fw-bold">Permisos por módulo</label>
<div class="row g-2">
    @foreach($permissions as $permission)
        <div class="col-md-6">
            <label class="d-flex align-items-start gap-3 border rounded-3 p-3 h-100" for="{{ $prefix }}Permission{{ $permission->id }}" style="cursor:pointer">
                <input class="form-check-input mt-1" type="checkbox" name="permissions[]" value="{{ $permission->id }}" id="{{ $prefix }}Permission{{ $permission->id }}" @checked(in_array($permission->id, $selected))>
                <span><strong class="d-block text-dark">{{ $permission->name }}</strong><small class="text-muted">{{ $permission->description ?: 'Permite consultar y administrar este módulo.' }}</small></span>
            </label>
        </div>
    @endforeach
</div>
