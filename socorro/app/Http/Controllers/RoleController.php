<?php

namespace App\Http\Controllers;

use App\Models\SystemPermission;
use App\Models\SystemRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class RoleController extends Controller
{
    public function index()
    {
        return view('module.roles.index', [
            'roles' => SystemRole::with('permissions')->withCount('users')->orderBy('name')->get(),
            'permissions' => SystemPermission::orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:system_roles,name'],
            'description' => ['nullable', 'string', 'max:255'],
            'permissions' => ['array'],
            'permissions.*' => ['integer', 'exists:system_permissions,id'],
        ]);

        DB::transaction(function () use ($data) {
            $base = Str::slug($data['name'], '_') ?: 'rol';
            $slug = $base;
            for ($i = 2; SystemRole::where('slug', $slug)->exists(); $i++) $slug = $base.'_'.$i;
            $role = SystemRole::create(['name' => $data['name'], 'slug' => $slug, 'description' => $data['description'] ?? null, 'active' => true]);
            $role->permissions()->sync($data['permissions'] ?? []);
        });

        return back()->with('success', 'Rol creado correctamente.');
    }

    public function update(Request $request, SystemRole $role)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100', Rule::unique('system_roles', 'name')->ignore($role)],
            'description' => ['nullable', 'string', 'max:255'],
            'active' => ['nullable', 'boolean'],
            'permissions' => ['array'],
            'permissions.*' => ['integer', 'exists:system_permissions,id'],
        ]);

        $role->update(['name' => $data['name'], 'description' => $data['description'] ?? null, 'active' => $role->slug === 'admin' ? true : $request->boolean('active')]);
        if ($role->slug !== 'admin') $role->permissions()->sync($data['permissions'] ?? []);

        return back()->with('success', 'Rol actualizado correctamente.');
    }

    public function destroy(SystemRole $role)
    {
        abort_if($role->is_system, 422, 'Los roles base del sistema no se pueden eliminar.');
        abort_if($role->users()->exists(), 422, 'No se puede eliminar un rol que tiene usuarios asociados.');
        $role->delete();

        return back()->with('success', 'Rol eliminado correctamente.');
    }
}
