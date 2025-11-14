<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('checklist', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('id_car')->constrained('cars')->cascadeOnDelete();
            $table->integer('kilometer');
            $table->integer('fuel');
            $table->integer('liquid_freeze');
            $table->integer('liquid_hydraulic');
            $table->integer('liquid_motor');
            $table->integer('liquid_brake');
            $table->text('observations')->nullable();
            $table->foreignId('id_voluntary')->constrained('voluntarys')->cascadeOnDelete();
            $table->string('email');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checklist');
    }
};
