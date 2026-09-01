<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('equipment_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->foreignId('warehouse_id')->constrained('warehouses')->restrictOnDelete();
            $table->foreignId('delegation_id')->constrained('delegations')->restrictOnDelete();
            $table->string('purpose', 180);
            $table->date('needed_at');
            $table->date('expected_return_at')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected', 'partially_returned', 'returned'])->default('pending')->index();
            $table->foreignId('reviewed_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('reviewed_at')->nullable();
            $table->string('review_note', 500)->nullable();
            $table->timestamp('returned_at')->nullable();
            $table->timestamps();
        });

        Schema::create('equipment_request_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('equipment_request_id')->constrained('equipment_requests')->cascadeOnDelete();
            $table->foreignId('product_id')->constrained('products')->restrictOnDelete();
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('returned_quantity')->default(0);
            $table->timestamps();
            $table->unique(['equipment_request_id', 'product_id'], 'equipment_request_product_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('equipment_request_items');
        Schema::dropIfExists('equipment_requests');
    }
};
