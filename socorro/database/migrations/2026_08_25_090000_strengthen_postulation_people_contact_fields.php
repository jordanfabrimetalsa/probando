<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('postulations_people', function (Blueprint $table) {
            if (!Schema::hasColumn('postulations_people', 'rut')) {
                $table->string('rut', 20)->nullable()->after('last_name');
            }
            $table->string('phone', 30)->change();
        });
    }

    public function down(): void
    {
        Schema::table('postulations_people', function (Blueprint $table) {
            if (Schema::hasColumn('postulations_people', 'rut')) {
                $table->dropColumn('rut');
            }
            $table->integer('phone')->change();
        });
    }
};
