<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('finance_transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('finance_category_id')->constrained()->restrictOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->date('transaction_date');
            $table->decimal('amount', 14, 2);
            $table->string('description', 180);
            $table->string('reference', 80)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->index('transaction_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('finance_transactions');
    }
};
