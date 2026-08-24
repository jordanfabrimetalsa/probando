<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('delegations', 'is_national')) Schema::table('delegations', fn (Blueprint $table) => $table->boolean('is_national')->default(false)->after('postulation_status')->index());
        $regionId = DB::table('regions')->value('id');
        if (!$regionId) $regionId = DB::table('regions')->insertGetId(['name'=>'Nacional','active'=>true,'created_at'=>now(),'updated_at'=>now()]);
        DB::table('delegations')->updateOrInsert(['name'=>'Nacional'], ['region_id'=>$regionId,'image'=>null,'postulation_status'=>'C','is_national'=>true,'updated_at'=>now(),'created_at'=>now()]);
        $nationalId = DB::table('delegations')->where('is_national', true)->value('id');
        $adminVoluntaries = DB::table('users')->where('role', 'admin')->whereNotNull('voluntary_id')->pluck('voluntary_id');
        DB::table('voluntaries')->whereIn('id', $adminVoluntaries)->update(['delegation_id'=>$nationalId]);

        if (!Schema::hasColumn('finance_transactions', 'delegation_id')) Schema::table('finance_transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('delegation_id')->nullable()->after('voluntary_id')->index();
            $table->foreign('delegation_id', 'finance_transactions_delegation_fk')->references('id')->on('delegations')->restrictOnDelete();
        });
        DB::statement('UPDATE finance_transactions ft LEFT JOIN voluntaries v ON v.id = ft.voluntary_id LEFT JOIN users u ON u.id = ft.user_id LEFT JOIN voluntaries uv ON uv.id = u.voluntary_id SET ft.delegation_id = COALESCE(v.delegation_id, uv.delegation_id, ?)', [$nationalId]);
        Schema::table('finance_transactions', fn (Blueprint $table) => $table->unsignedBigInteger('delegation_id')->nullable(false)->change());

        if (!Schema::hasColumn('stock_movement', 'delegation_id')) Schema::table('stock_movement', function (Blueprint $table) {
            $table->unsignedBigInteger('delegation_id')->nullable()->after('warehouse_id')->index();
        });
        $stockFk = DB::table('information_schema.KEY_COLUMN_USAGE')->where('TABLE_SCHEMA', DB::getDatabaseName())->where('TABLE_NAME', 'stock_movement')->where('COLUMN_NAME', 'delegation_id')->whereNotNull('REFERENCED_TABLE_NAME')->exists();
        if (!$stockFk) DB::statement('ALTER TABLE stock_movement ADD CONSTRAINT stock_movement_delegation_fk FOREIGN KEY (delegation_id) REFERENCES delegations(id) ON DELETE RESTRICT');
        DB::statement('UPDATE stock_movement sm JOIN warehouses w ON w.id = sm.warehouse_id SET sm.delegation_id = w.delegation_id');

        if (!Schema::hasColumn('rescue', 'id_delegation')) {
            Schema::table('rescue', function (Blueprint $table) {
                $table->unsignedBigInteger('id_delegation')->nullable()->after('user_id')->index();
                $table->foreign('id_delegation', 'rescue_delegation_fk')->references('id')->on('delegations')->restrictOnDelete();
            });
        }
        DB::statement('UPDATE rescue r LEFT JOIN voluntaries v ON v.id = r.voluntario_id LEFT JOIN users u ON u.id = r.user_id LEFT JOIN voluntaries uv ON uv.id = u.voluntary_id SET r.id_delegation = COALESCE(r.id_delegation, v.delegation_id, uv.delegation_id, ?)', [$nationalId]);
    }

    public function down(): void
    {
        if (Schema::hasColumn('rescue', 'id_delegation')) Schema::table('rescue', fn (Blueprint $table) => $table->dropConstrainedForeignId('id_delegation'));
        Schema::table('stock_movement', fn (Blueprint $table) => $table->dropConstrainedForeignId('delegation_id'));
        Schema::table('finance_transactions', fn (Blueprint $table) => $table->dropConstrainedForeignId('delegation_id'));
        Schema::table('delegations', fn (Blueprint $table) => $table->dropColumn('is_national'));
    }
};
