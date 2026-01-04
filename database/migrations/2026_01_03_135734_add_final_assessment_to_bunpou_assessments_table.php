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
        Schema::table('bunpou_assessments', function (Blueprint $table) {
            $table->float('final_ujian')->nullable()->after('eval6_at');
            $table->float('final_nilai')->nullable()->after('final_ujian');
            $table->date('final_at')->nullable()->after('final_nilai');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bunpou_assessments', function (Blueprint $table) {
            $table->dropColumn(['final_ujian', 'final_nilai', 'final_at']);
        });
    }
};
