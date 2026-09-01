<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('voluntaries', function (Blueprint $table) {
            $table->enum('rope_technical_level', ['low', 'medium', 'high'])->nullable()->after('blood_type');
            $table->enum('health_level', ['low', 'medium', 'high'])->nullable()->after('rope_technical_level');
            $table->enum('stretcher_level', ['low', 'medium', 'high'])->nullable()->after('health_level');
            $table->enum('leadership_level', ['low', 'medium', 'high'])->nullable()->after('stretcher_level');
            $table->enum('physical_performance_level', ['low', 'medium', 'high'])->nullable()->after('leadership_level');
            $table->enum('snow_ice_level', ['low', 'medium', 'high'])->nullable()->after('physical_performance_level');
        });
    }

    public function down(): void
    {
        Schema::table('voluntaries', function (Blueprint $table) {
            $table->dropColumn([
                'rope_technical_level',
                'health_level',
                'stretcher_level',
                'leadership_level',
                'physical_performance_level',
                'snow_ice_level',
            ]);
        });
    }
};
