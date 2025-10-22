<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('document_car', function (Blueprint $table) {
            $table->id();
            $table->enum('circulation_permit', ['Vigente', 'Vencido'])->default('Vigente');
            $table->enum('gases', ['Vigente', 'Vencido'])->default('Vigente');
            $table->enum('technical_inspection', ['Vigente', 'Vencido'])->default('Vigente');
            $table->enum('insurance', ['Vigente', 'Vencido'])->default('Vigente');
            $table->foreignId('car_id')->constrained('cars')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('document_car');
    }
};
