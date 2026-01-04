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
            $table->float('eval3')->nullable()->after('eval2');
            $table->float('eval4')->nullable()->after('eval3');
            $table->float('eval5')->nullable()->after('eval4');
            $table->float('eval6')->nullable()->after('eval5');
            
            $table->date('eval1_at')->nullable()->after('eval6');
            $table->date('eval2_at')->nullable()->after('eval1_at');
            $table->date('eval3_at')->nullable()->after('eval2_at');
            $table->date('eval4_at')->nullable()->after('eval3_at');
            $table->date('eval5_at')->nullable()->after('eval4_at');
            $table->date('eval6_at')->nullable()->after('eval5_at');
        });

        // Copy data from 'date' to 'eval1_at' if any, then drop 'date'
        DB::table('bunpou_assessments')->update(['eval1_at' => DB::raw('`date`')]);

        Schema::table('bunpou_assessments', function (Blueprint $table) {
            $table->dropColumn('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bunpou_assessments', function (Blueprint $table) {
            $table->date('date')->nullable()->after('eval2');
        });

        DB::table('bunpou_assessments')->update(['date' => DB::raw('`eval1_at`')]);

        Schema::table('bunpou_assessments', function (Blueprint $table) {
            $table->dropColumn(['eval3', 'eval4', 'eval5', 'eval6', 'eval1_at', 'eval2_at', 'eval3_at', 'eval4_at', 'eval5_at', 'eval6_at']);
        });
    }
};
