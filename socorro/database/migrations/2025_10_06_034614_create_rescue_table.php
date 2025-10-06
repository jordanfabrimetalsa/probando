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
            $table->number('kilometer_total')->nullable();
            $table->enum('situation', ['pending', 'in_progress', 'completed'])->default('pending');
            $table->number('different_height')->nullable();
            $table->number('quantity_people')->nullable();
            $table->number('quantity_voluntaries')->nullable();
            $table->enum('helper_external', ['yes', 'no'])->default('no');
            $table->string('external_helper')->nullable();

            $table->string('name_accident')->nullable();
            $table->string('phone_accident')->nullable();
            $table->string('email_accident')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->enum('allergic', ['yes', 'no'])->default('no');
            $table->enum('disease', ['yes', 'no'])->default('no');

            $table->datetime('date_call')->nullable();
            $table->datetime('date_start_trek')->nullable();
            $table->datetime('date_middle_trek')->nullable();
            $table->datetime('date_finish_rescue')->nullable();

            $table->string('injury')->nullable();
            $table->enum('gravity', ['leve', 'medio', 'grave'])->default('leve');
            $table->enum('medical_assistance', ['yes', 'no'])->default('no');
            $table->enum('Stretcher', ['yes', 'no'])->default('no');
            $table->enum('type_transport', ['sked', 'kong'])->default('no');
            $table->enum('helicopter', ['yes', 'no'])->default('no');

            $table->foreignId('voluntario_id')->nullable()->constrained('voluntaries');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rescue');
    }
};
