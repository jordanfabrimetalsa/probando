<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->boolean('guard_enabled')->default(false)->after('type');
            $table->unsignedSmallInteger('guard_capacity')->nullable()->after('guard_enabled');
            $table->foreignId('guard_leader_id')->nullable()->after('guard_capacity')->constrained('voluntaries')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropConstrainedForeignId('guard_leader_id');
            $table->dropColumn(['guard_enabled', 'guard_capacity']);
        });
    }
};
