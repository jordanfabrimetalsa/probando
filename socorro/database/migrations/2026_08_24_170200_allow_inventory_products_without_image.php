<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        DB::statement('ALTER TABLE products MODIFY image TEXT NULL');
    }

    public function down(): void
    {
        DB::statement("UPDATE products SET image = '' WHERE image IS NULL");
        DB::statement('ALTER TABLE products MODIFY image TEXT NOT NULL');
    }
};
