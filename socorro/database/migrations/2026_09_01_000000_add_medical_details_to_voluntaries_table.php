<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('voluntaries', function (Blueprint $table) {
            $table->text('allergy_details')->nullable()->after('allergic');
            $table->text('disease_details')->nullable()->after('disease');
        });
    }

    public function down(): void
    {
        Schema::table('voluntaries', function (Blueprint $table) {
            $table->dropColumn(['allergy_details', 'disease_details']);
        });
    }
};
