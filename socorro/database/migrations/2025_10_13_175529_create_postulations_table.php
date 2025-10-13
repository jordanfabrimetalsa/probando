<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('postulations', function (Blueprint $table) {
            $table->id();
            $table->text('title');
            $table->text('description');
            $table->integer('cant_people_selected');
            $table->enum('status', ['A', 'C'])->default('A');
            $table->datetime('start_date')->default(now());
            $table->datetime('end_date')->default(now()->addMonths(1));
            $table->foreignId('delegation_id')->constrained('delegations')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('postulations');
    }
};
