<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $roleId = DB::table('system_roles')->where('slug', 'comun')->value('id');
        $permissionIds = DB::table('system_permissions')->whereIn('key', ['departures.manage', 'rescues.manage'])->pluck('id');
        foreach ($permissionIds as $permissionId) {
            DB::table('system_permission_role')->insertOrIgnore([
                'system_role_id' => $roleId,
                'system_permission_id' => $permissionId,
            ]);
        }
    }

    public function down(): void
    {
        $roleId = DB::table('system_roles')->where('slug', 'comun')->value('id');
        $permissionIds = DB::table('system_permissions')->whereIn('key', ['departures.manage', 'rescues.manage'])->pluck('id');
        DB::table('system_permission_role')->where('system_role_id', $roleId)->whereIn('system_permission_id', $permissionIds)->delete();
    }
};
