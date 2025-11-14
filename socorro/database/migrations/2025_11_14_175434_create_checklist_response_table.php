<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('checklist_response', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_checklist')->constrained('checklist')->cascadeOnDelete();
            $table->foreignId('id_answer')->constrained('categories_check')->cascadeOnDelete();
            $table->string('response', 8);
            $table->text('observations');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checklist_response');
    }
};
