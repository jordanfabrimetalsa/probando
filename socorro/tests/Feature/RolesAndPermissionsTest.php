<?php

namespace Tests\Feature;

use App\Models\SystemPermission;
use App\Models\SystemRole;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RolesAndPermissionsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_create_a_role_with_module_permissions(): void
    {
        $admin = User::where('role', 'admin')->firstOrFail();
        $permission = SystemPermission::where('key', 'inventory.manage')->firstOrFail();

        $this->actingAs($admin)->post(route('roles.store'), [
            'name' => 'Encargado de bodega',
            'description' => 'Control de existencias',
            'permissions' => [$permission->id],
        ])->assertRedirect();

        $role = SystemRole::where('slug', 'encargado_de_bodega')->firstOrFail();
        $this->assertTrue($role->permissions()->where('key', 'inventory.manage')->exists());
    }

    public function test_custom_role_can_access_only_an_authorized_module(): void
    {
        $role = SystemRole::create(['name' => 'Bodega', 'slug' => 'bodega', 'active' => true]);
        $role->permissions()->attach(SystemPermission::where('key', 'inventory.manage')->firstOrFail());
        $user = User::where('role', 'admin')->firstOrFail();
        $user->update(['role' => 'bodega', 'status' => 'A']);

        $this->actingAs($user)->get(route('inventario'))->assertOk();
        $this->actingAs($user)->get(route('usuarios'))->assertForbidden();
    }

    public function test_user_role_must_exist_in_role_catalog(): void
    {
        $admin = User::where('role', 'admin')->firstOrFail();

        $this->actingAs($admin)->post(route('usuarios.store'), [
            'name' => 'Usuario prueba', 'email' => 'role-test@example.com',
            'password' => 'password123', 'password_confirmation' => 'password123',
            'role' => 'rol_inexistente', 'status' => 'A',
        ])->assertSessionHasErrors('role');
    }
}
