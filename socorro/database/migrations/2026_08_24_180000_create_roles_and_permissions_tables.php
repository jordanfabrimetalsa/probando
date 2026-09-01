<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE users MODIFY role VARCHAR(100) NOT NULL DEFAULT 'comun'");
        }

        Schema::create('system_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug', 100)->unique();
            $table->string('description')->nullable();
            $table->boolean('is_system')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });

        Schema::create('system_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('key', 100)->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('system_permission_role', function (Blueprint $table) {
            $table->foreignId('system_role_id')->constrained('system_roles')->cascadeOnDelete();
            $table->foreignId('system_permission_id')->constrained('system_permissions')->cascadeOnDelete();
            $table->primary(['system_role_id', 'system_permission_id'], 'permission_role_primary');
        });

        $now = now();
        $permissions = [
            ['name' => 'Panel principal', 'key' => 'dashboard.view'],
            ['name' => 'Usuarios', 'key' => 'users.manage'],
            ['name' => 'Roles y permisos', 'key' => 'roles.manage'],
            ['name' => 'Voluntarios', 'key' => 'volunteers.manage'],
            ['name' => 'Delegaciones', 'key' => 'delegations.manage'],
            ['name' => 'Inventario y bodega', 'key' => 'inventory.manage'],
            ['name' => 'Finanzas', 'key' => 'finances.manage'],
            ['name' => 'Vehículos', 'key' => 'vehicles.manage'],
            ['name' => 'Noticias', 'key' => 'news.manage'],
            ['name' => 'Contactos', 'key' => 'contacts.manage'],
            ['name' => 'Calendario y guardias', 'key' => 'calendar.manage'],
            ['name' => 'Avisos de salida', 'key' => 'departures.manage'],
            ['name' => 'Registros de rescate', 'key' => 'rescues.manage'],
        ];
        DB::table('system_permissions')->insert(array_map(fn ($p) => $p + ['created_at' => $now, 'updated_at' => $now], $permissions));

        $roles = [
            ['name' => 'Administrador', 'slug' => 'admin', 'description' => 'Acceso completo al sistema.', 'is_system' => true],
            ['name' => 'Administrador nacional', 'slug' => 'administrador_nacional', 'description' => 'Administración institucional.', 'is_system' => true],
            ['name' => 'Jefe de operaciones', 'slug' => 'jefe_operaciones', 'description' => 'Operaciones, salidas y rescates.', 'is_system' => true],
            ['name' => 'Organizador de guardia', 'slug' => 'organizador_guardia', 'description' => 'Calendario y guardias.', 'is_system' => true],
            ['name' => 'Comunicaciones', 'slug' => 'comunicaciones', 'description' => 'Gestión de noticias.', 'is_system' => true],
            ['name' => 'Cuartelero', 'slug' => 'cuartelero', 'description' => 'Inventario y vehículos.', 'is_system' => true],
            ['name' => 'Común', 'slug' => 'comun', 'description' => 'Acceso básico.', 'is_system' => true],
            ['name' => 'Líder', 'slug' => 'leader', 'description' => 'Acceso operativo.', 'is_system' => true],
        ];
        DB::table('system_roles')->insert(array_map(fn ($r) => $r + ['active' => true, 'created_at' => $now, 'updated_at' => $now], $roles));

        $grants = [
            'administrador_nacional' => ['dashboard.view','users.manage','roles.manage','volunteers.manage','delegations.manage','inventory.manage','finances.manage','vehicles.manage','news.manage','contacts.manage','calendar.manage','departures.manage','rescues.manage'],
            'jefe_operaciones' => ['dashboard.view','volunteers.manage','inventory.manage','vehicles.manage','calendar.manage','departures.manage','rescues.manage'],
            'organizador_guardia' => ['dashboard.view','calendar.manage','departures.manage'],
            'comunicaciones' => ['dashboard.view','news.manage','contacts.manage'],
            'cuartelero' => ['dashboard.view','inventory.manage','vehicles.manage'],
            'leader' => ['dashboard.view','calendar.manage','departures.manage','rescues.manage'],
            'comun' => ['dashboard.view','departures.manage','rescues.manage'],
        ];
        $permissionIds = DB::table('system_permissions')->pluck('id', 'key');
        $roleIds = DB::table('system_roles')->pluck('id', 'slug');
        foreach ($permissionIds as $permissionId) {
            DB::table('system_permission_role')->insert(['system_role_id' => $roleIds['admin'], 'system_permission_id' => $permissionId]);
        }
        foreach ($grants as $role => $keys) {
            foreach ($keys as $key) {
                DB::table('system_permission_role')->insert(['system_role_id' => $roleIds[$role], 'system_permission_id' => $permissionIds[$key]]);
            }
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('system_permission_role');
        Schema::dropIfExists('system_permissions');
        Schema::dropIfExists('system_roles');
    }
};
