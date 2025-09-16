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
        Schema::create('notice_departure', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name')->nullable();
            $table->string('lastname')->nullable();
            $table->string('document_type')->nullable();
            $table->string('document_number')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->integer('region')->nullable();
            $table->string('destination')->nullable();
            $table->string('route')->nullable();
            $table->string('file_path');
            $table->integer('activity')->nullable();
            $table->integer('number_participants')->nullable();
            $table->dateTime('departure_date')->nullable();
            $table->dateTime('return_date')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notice_departure');
    }
};
