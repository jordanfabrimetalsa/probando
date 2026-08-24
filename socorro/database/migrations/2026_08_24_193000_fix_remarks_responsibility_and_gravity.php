<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('remarks', 'responsable_id')) {
            Schema::table('remarks', fn (Blueprint $table) => $table->foreignId('responsable_id')->nullable()->after('voluntary_id')->constrained('users')->nullOnDelete());
        }
        if (DB::getDriverName() === 'mysql') {
            DB::statement("ALTER TABLE remarks MODIFY gravity ENUM('0','1','2','3','4','5') NOT NULL");
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('remarks', 'responsable_id')) Schema::table('remarks', fn (Blueprint $table) => $table->dropConstrainedForeignId('responsable_id'));
        if (DB::getDriverName() === 'mysql') DB::statement("ALTER TABLE remarks MODIFY gravity ENUM('1','2','3','4','5') NOT NULL");
    }
};
