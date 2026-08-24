@extends('layout.main')

@section('title', 'Roles y permisos')

@section('content')
<div class="container-fluid py-3">
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 mb-4">
        <div>
            <span class="badge bg-warning text-dark mb-2">Seguridad</span>
            <h3 class="mb-1">Roles y permisos</h3>
            <p class="text-muted mb-0">Define qué módulos puede utilizar cada tipo de usuario.</p>
        </div>
        <button class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#createRoleModal">
            <i class="fa-solid fa-shield-halved me-2"></i>Nuevo rol
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success text-white">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger text-white"><strong>No fue posible guardar:</strong> {{ $errors->first() }}</div>
    @endif

    <div class="row g-4">
        @foreach($roles as $role)
            <div class="col-12 col-xl-6">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex justify-content-between gap-3 mb-3">
                            <div>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="rounded-3 bg-dark text-white p-2"><i class="fa-solid fa-user-shield"></i></span>
                                    <h5 class="mb-0">{{ $role->name }}</h5>
                                    @if($role->is_system)<span class="badge bg-light text-dark">Base</span>@endif
                                    @unless($role->active)<span class="badge bg-secondary">Inactivo</span>@endunless
                                </div>
                                <p class="text-muted small mt-2 mb-0">{{ $role->description ?: 'Sin descripción.' }}</p>
                            </div>
                            <span class="badge bg-warning text-dark align-self-start">{{ $role->users_count }} usuarios</span>
                        </div>

                        <div class="d-flex flex-wrap gap-2 mb-4">
                            @if($role->slug === 'admin')
                                <span class="badge bg-success">Acceso completo</span>
                            @else
                                @forelse($role->permissions as $permission)
                                    <span class="badge bg-light text-dark border">{{ $permission->name }}</span>
                                @empty
                                    <span class="text-muted small">Sin permisos de módulos.</span>
                                @endforelse
                            @endif
                        </div>

                        <div class="d-flex gap-2">
                            <button class="btn btn-outline-dark btn-sm" data-bs-toggle="modal" data-bs-target="#editRole{{ $role->id }}">
                                <i class="fa-solid fa-pen me-1"></i>Editar permisos
                            </button>
                            @unless($role->is_system)
                                <form method="POST" action="{{ route('roles.destroy', $role) }}" onsubmit="return confirm('¿Eliminar este rol?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-outline-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
                                </form>
                            @endunless
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editRole{{ $role->id }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-scrollable"><div class="modal-content">
                    <form method="POST" action="{{ route('roles.update', $role) }}">@csrf @method('PUT')
                        <div class="modal-header"><h5 class="modal-title">Editar {{ $role->name }}</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
                        <div class="modal-body">
                            <div class="row g-3 mb-4">
                                <div class="col-md-5"><label class="form-label">Nombre</label><input class="form-control border p-2" name="name" value="{{ $role->name }}" required></div>
                                <div class="col-md-7"><label class="form-label">Descripción</label><input class="form-control border p-2" name="description" value="{{ $role->description }}"></div>
                            </div>
                            @if($role->slug === 'admin')
                                <div class="alert alert-info text-white">El administrador siempre tiene acceso completo.</div>
                            @else
                                <input type="hidden" name="active" value="0">
                                <div class="form-check form-switch mb-4"><input class="form-check-input" type="checkbox" name="active" value="1" id="active{{ $role->id }}" @checked($role->active)><label class="form-check-label" for="active{{ $role->id }}">Rol disponible para asignar</label></div>
                                @include('module.roles.permissions', ['selected' => $role->permissions->pluck('id')->all(), 'prefix' => 'edit'.$role->id])
                            @endif
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button><button class="btn btn-dark">Guardar cambios</button></div>
                    </form>
                </div></div>
            </div>
        @endforeach
    </div>
</div>

<div class="modal fade" id="createRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable"><div class="modal-content">
        <form method="POST" action="{{ route('roles.store') }}">@csrf
            <div class="modal-header"><h5 class="modal-title">Crear nuevo rol</h5><button class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <div class="row g-3 mb-4">
                    <div class="col-md-5"><label class="form-label">Nombre del rol</label><input class="form-control border p-2" name="name" value="{{ old('name') }}" required placeholder="Ej: Encargado de bodega"></div>
                    <div class="col-md-7"><label class="form-label">Descripción</label><input class="form-control border p-2" name="description" value="{{ old('description') }}" placeholder="Responsabilidad principal"></div>
                </div>
                @include('module.roles.permissions', ['selected' => old('permissions', []), 'prefix' => 'create'])
            </div>
            <div class="modal-footer"><button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancelar</button><button class="btn btn-dark">Crear rol</button></div>
        </form>
    </div></div>
</div>
@endsection
