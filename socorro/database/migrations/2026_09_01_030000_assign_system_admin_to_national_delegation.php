<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('delegations', 'is_national')) {
            return;
        }

        $nationalId = DB::table('delegations')->where('is_national', true)->value('id');
        if (!$nationalId) {
            return;
        }

        $adminVoluntaryIds = DB::table('users')
            ->where('role', 'admin')
            ->whereNotNull('voluntary_id')
            ->pluck('voluntary_id');

        DB::table('voluntaries')->whereIn('id', $adminVoluntaryIds)->update([
            'delegation_id' => $nationalId,
            'updated_at' => now(),
        ]);
    }

    public function down(): void
    {
        // La delegación anterior no puede inferirse de forma segura.
    }
};
