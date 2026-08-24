<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('voluntaries', 'init_voluntary')) {
            Schema::table('voluntaries', fn (Blueprint $table) => $table->date('init_voluntary')->nullable()->after('birthday'));
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('voluntaries', 'init_voluntary')) {
            Schema::table('voluntaries', fn (Blueprint $table) => $table->dropColumn('init_voluntary'));
        }
    }
};
