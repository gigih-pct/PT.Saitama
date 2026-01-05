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
        Schema::table('wawancara_assessments', function (Blueprint $table) {
            $table->integer('cara_duduk')->nullable();
            $table->integer('suara')->nullable();
            $table->integer('fokus')->nullable();
            $table->integer('sum_sikap')->nullable();
            $table->decimal('percent_sikap', 5, 2)->nullable();
            $table->text('note_sikap')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wawancara_assessments', function (Blueprint $table) {
            $table->dropColumn(['cara_duduk', 'suara', 'fokus', 'sum_sikap', 'percent_sikap', 'note_sikap']);
        });
    }
};
