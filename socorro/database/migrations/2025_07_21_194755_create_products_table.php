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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('barcode')->unique()->nullable();
            $table->string('name')->unique()->nullable();
            $table->string('description')->nullable();
            $table->string('colour');
            $table->string('size');
            $table->string('brand')->nullable();
            $table->integer('stock')->default(0);
            $table->boolean('status')->default(false);
            $table->text('image');
            $table->foreignId('id_category')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('id_warehouse')->constrained('warehouses')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
