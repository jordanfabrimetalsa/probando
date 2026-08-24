<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('products', fn (Blueprint $table) => $table->softDeletes());
        Schema::table('warehouses', fn (Blueprint $table) => $table->softDeletes());

        Schema::table('stock_movement', function (Blueprint $table) {
            $table->foreignId('warehouse_id')->nullable()->after('product_id')->constrained('warehouses')->restrictOnDelete();
            $table->integer('balance_before')->nullable()->after('quantity');
            $table->integer('balance_after')->nullable()->after('balance_before');
            $table->string('reason', 180)->nullable()->after('unit_cost');
            $table->string('reference', 100)->nullable()->after('reason');
            $table->timestamp('occurred_at')->nullable()->after('reference');
        });

        DB::statement('UPDATE stock_movement sm JOIN products p ON p.id = sm.product_id SET sm.warehouse_id = p.id_warehouse, sm.occurred_at = sm.created_at WHERE sm.warehouse_id IS NULL');

        Schema::table('stock_movement', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['user_id']);
            $table->foreign('product_id')->references('id')->on('products')->restrictOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->restrictOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('stock_movement', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
            $table->dropForeign(['user_id']);
            $table->dropConstrainedForeignId('warehouse_id');
            $table->dropColumn(['balance_before', 'balance_after', 'reason', 'reference', 'occurred_at']);
            $table->foreign('product_id')->references('id')->on('products')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
        });
        Schema::table('products', fn (Blueprint $table) => $table->dropSoftDeletes());
        Schema::table('warehouses', fn (Blueprint $table) => $table->dropSoftDeletes());
    }
};
