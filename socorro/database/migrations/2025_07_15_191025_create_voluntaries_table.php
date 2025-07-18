<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('voluntaries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delegation_id')->constrained('delegations')->cascadeOnDelete();
            $table->string('document', 10);
            $table->string('name');
            $table->string('lastname');
            $table->string('email');
            $table->string('phone');
            $table->date('birthday');
            $table->string('address');
            $table->string('profession');
            $table->enum('gender', ['M', 'F'])->default('M');
            $table->boolean('allergic')->default(false);
            $table->boolean('disease')->default(false);
            $table->boolean('medicine')->default(false);
            $table->boolean('vehicle')->default(false);
            $table->boolean('license')->default(false);
            $table->boolean('payment')->default(false);
            $table->char('blood_type', 2)->default('N');
            $table->string('password', 255);
            $table->enum('type', ['V', 'A'])->default('A');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('voluntaries');
    }
};

