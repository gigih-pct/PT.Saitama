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
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'role_id')) {
            $driver = DB::getDriverName();

            if ($driver === 'mysql') {
                // Attempt to drop foreign key constraint if present
                try {
                    DB::statement('ALTER TABLE `users` DROP FOREIGN KEY fk_users_role');
                } catch (\Throwable $e) {
                    // ignore if cannot drop (constraint may not exist or name different)
                }

                // Modify column to be nullable
                try {
                    DB::statement("ALTER TABLE `users` MODIFY `role_id` BIGINT UNSIGNED NULL;");
                } catch (\Throwable $e) {
                    // ignore
                }

                // Re-create FK if roles table exists
                if (Schema::hasTable('roles')) {
                    try {
                        DB::statement("ALTER TABLE `users` ADD CONSTRAINT fk_users_role FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE SET NULL ON UPDATE CASCADE;");
                    } catch (\Throwable $e) {
                        // ignore
                    }
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('users') && Schema::hasColumn('users', 'role_id')) {
            $driver = DB::getDriverName();
            if ($driver === 'mysql') {
                try {
                    DB::statement("ALTER TABLE `users` MODIFY `role_id` BIGINT UNSIGNED NOT NULL DEFAULT 0;");
                } catch (\Throwable $e) {
                    // ignore
                }

                if (Schema::hasTable('roles')) {
                    try {
                        DB::statement("ALTER TABLE `users` ADD CONSTRAINT fk_users_role FOREIGN KEY (`role_id`) REFERENCES `roles`(`id`) ON DELETE RESTRICT ON UPDATE CASCADE;");
                    } catch (\Throwable $e) {
                        // ignore
                    }
                }
            }
        }
    }
};
