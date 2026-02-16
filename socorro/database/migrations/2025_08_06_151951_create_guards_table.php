<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_event')->constrained('events');
            $table->foreignId('id_voluntary')->constrained('voluntaries');
            $table->enum('type', ['assistant','guest','support','leader','speaker'])->default('assistant');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guards');
    }
};
