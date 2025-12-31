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
        if (Schema::hasColumn('users', 'status')) {
            // Use raw SQL to modify column type to string
            DB::statement("ALTER TABLE users MODIFY COLUMN status VARCHAR(255) DEFAULT 'pending'");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverting to enum might be destructive if new data exists, so keeping it as string is safer
    }
};
