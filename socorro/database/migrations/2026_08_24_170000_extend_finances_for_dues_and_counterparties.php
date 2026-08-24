<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        if (!Schema::hasColumn('finance_categories', 'system_key')) {
            Schema::table('finance_categories', function (Blueprint $table) {
                $table->string('system_key', 40)->nullable()->unique()->after('type');
                $table->boolean('is_system')->default(false)->after('system_key');
            });
        }

        DB::table('finance_categories')->updateOrInsert(
            ['name' => 'Cuotas', 'type' => 'income'],
            ['system_key' => 'membership_dues', 'is_system' => true, 'color' => '#176985', 'active' => true, 'updated_at' => now()]
        );

        if (!Schema::hasColumn('finance_transactions', 'voluntary_id')) {
            Schema::table('finance_transactions', function (Blueprint $table) {
                $table->foreignId('voluntary_id')->nullable()->after('user_id')->constrained('voluntaries')->nullOnDelete();
                $table->string('counterparty', 150)->nullable()->after('amount');
            });
        }
    }

    public function down(): void
    {
        Schema::table('finance_transactions', function (Blueprint $table) {
            $table->dropConstrainedForeignId('voluntary_id');
            $table->dropColumn('counterparty');
        });
        Schema::table('finance_categories', function (Blueprint $table) {
            $table->dropUnique(['system_key']);
            $table->dropColumn(['system_key', 'is_system']);
        });
    }
};
