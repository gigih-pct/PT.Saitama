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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'no_wa_pribadi')) {
                $table->string('no_wa_pribadi')->nullable()->after('status');
            }
            if (!Schema::hasColumn('users', 'wa_orang_tua')) {
                $table->string('wa_orang_tua')->nullable()->after('no_wa_pribadi');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['no_wa_pribadi', 'wa_orang_tua']);
        });
    }
};
