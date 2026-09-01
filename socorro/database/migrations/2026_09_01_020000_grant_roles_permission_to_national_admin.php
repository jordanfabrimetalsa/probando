<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('system_roles') || !Schema::hasTable('system_permissions')) {
            return;
        }

        $roleId = DB::table('system_roles')->where('slug', 'administrador_nacional')->value('id');
        $permissionId = DB::table('system_permissions')->where('key', 'roles.manage')->value('id');

        if ($roleId && $permissionId) {
            DB::table('system_permission_role')->updateOrInsert([
                'system_role_id' => $roleId,
                'system_permission_id' => $permissionId,
            ]);
        }
    }

    public function down(): void
    {
        $roleId = DB::table('system_roles')->where('slug', 'administrador_nacional')->value('id');
        $permissionId = DB::table('system_permissions')->where('key', 'roles.manage')->value('id');

        if ($roleId && $permissionId) {
            DB::table('system_permission_role')
                ->where('system_role_id', $roleId)
                ->where('system_permission_id', $permissionId)
                ->delete();
        }
    }
};
