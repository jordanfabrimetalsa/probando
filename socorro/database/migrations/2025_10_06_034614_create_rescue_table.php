<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rescue', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['accident', 'search', 'passing'])->default('accident');
            $table->string('place')->nullable();
            $table->string('road')->nullable();
            $table->string('weather')->nullable();
            $table->integer('kilometer_total')->nullable();
            $table->integer('different_height')->nullable();
            $table->integer('quantity_people')->nullable();
            $table->integer('quantity_voluntaries')->nullable();
            $table->enum('helper_external', ['yes', 'no'])->default('no');
            $table->string('external_helper')->nullable();
            $table->string('name_accident')->nullable();
            $table->string('phone_accident')->nullable();
            $table->string('email_accident');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->enum('allergic', ['yes', 'no'])->default('no');
            $table->enum('disease', ['yes', 'no'])->default('no');

            $table->datetime('date_call')->nullable();
            $table->datetime('date_start_trek')->nullable();
            $table->datetime('date_middle_trek');
            $table->datetime('date_finish_rescue');

            $table->string('injury')->nullable();
            $table->enum('gravity', ['leve', 'medio', 'grave'])->default('leve');
            $table->enum('medical_assistance', ['yes', 'no'])->default('no');
            $table->enum('Stretcher', ['yes', 'no'])->default('no');
            $table->enum('type_transport', ['sked', 'kong'])->default('kong');
            $table->enum('helicopter', ['yes', 'no'])->default('no');

            $table->foreignId('voluntario_id')->nullable()->constrained('voluntaries');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->enum('situation', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->text('observations')->nullable();
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rescue');
    }
};
