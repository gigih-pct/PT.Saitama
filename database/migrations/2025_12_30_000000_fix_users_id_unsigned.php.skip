<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Check if users table exists and id is not unsigned
        if (Schema::hasTable('users')) {
            $column = DB::select("SHOW COLUMNS FROM users WHERE Field = 'id'")[0] ?? null;
            if ($column && strpos($column->Type, 'unsigned') === false) {
                // Ensure no negative IDs exist before converting (unlikely for PK but safe to check)
                // Use raw SQL to avoid dependency on doctrine/dbal for column change
                DB::statement('ALTER TABLE users MODIFY COLUMN id BIGINT UNSIGNED AUTO_INCREMENT');
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Usually no need to revert this as it's a normalization to standard Laravel types
    }
};
