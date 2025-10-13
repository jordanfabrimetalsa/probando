<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('postulations_people', function (Blueprint $table) {
            $table->id();
            $table->text('name', 20);
            $table->text('last_name', 20);
            $table->integer('phone');
            $table->text('email');
            $table->longText('presentation');
            $table->foreignId('postulation_id')->constrained('postulations')->cascadeOnDelete();
            $table->timestamps();
        });
    }

 
    public function down(): void
    {
        Schema::dropIfExists('postulations_people');
    }
};
