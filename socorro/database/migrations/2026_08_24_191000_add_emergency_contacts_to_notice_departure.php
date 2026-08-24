<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('notice_departure', function (Blueprint $table) {
            if (!Schema::hasColumn('notice_departure', 'name_emergency_family')) {
                $table->string('name_emergency_family', 60)->nullable()->after('active');
                $table->string('parentesco_family_emergency', 30)->nullable()->after('name_emergency_family');
                $table->string('number_family_emergency', 12)->nullable()->after('parentesco_family_emergency');
                $table->string('name_emergency_family_2', 60)->nullable()->after('number_family_emergency');
                $table->string('parentesco_family_emergency_2', 30)->nullable()->after('name_emergency_family_2');
                $table->string('number_family_emergency_2', 12)->nullable()->after('parentesco_family_emergency_2');
            }
        });
    }

    public function down(): void
    {
        Schema::table('notice_departure', function (Blueprint $table) {
            $table->dropColumn([
                'name_emergency_family', 'parentesco_family_emergency', 'number_family_emergency',
                'name_emergency_family_2', 'parentesco_family_emergency_2', 'number_family_emergency_2',
            ]);
        });
    }
};
