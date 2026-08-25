<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        $delegationIds = DB::table('postulations')
            ->where('status', 'A')
            ->groupBy('delegation_id')
            ->havingRaw('COUNT(*) > 1')
            ->pluck('delegation_id');

        foreach ($delegationIds as $delegationId) {
            $keepId = DB::table('postulations')
                ->where('delegation_id', $delegationId)
                ->where('status', 'A')
                ->orderByDesc('start_date')
                ->orderByDesc('id')
                ->value('id');
            DB::table('postulations')
                ->where('delegation_id', $delegationId)
                ->where('status', 'A')
                ->where('id', '<>', $keepId)
                ->update(['status' => 'C', 'updated_at' => now()]);
        }
    }

    public function down(): void
    {
        // La normalización no se revierte para no reabrir convocatorias antiguas.
    }
};
