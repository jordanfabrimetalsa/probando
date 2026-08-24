<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('cargos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100)->unique();
            $table->timestamps();
        });

        DB::table('cargos')->insert([
            ['nombre' => 'Voluntario', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Jefe de delegación', 'created_at' => now(), 'updated_at' => now()],
            ['nombre' => 'Jefe de operaciones', 'created_at' => now(), 'updated_at' => now()],
        ]);

        Schema::table('voluntaries', function (Blueprint $table) {
            $table->foreignId('cargo_id')->nullable()->after('delegation_id')->constrained('cargos')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('voluntaries', function (Blueprint $table) {
            $table->dropConstrainedForeignId('cargo_id');
        });
        Schema::dropIfExists('cargos');
    }
};
