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
        Schema::create('wawancara_assessments', function (Blueprint $バランス) {
            $バランス->id();
            $バランス->foreignId('user_id')->constrained()->onDelete('cascade');
            $バランス->integer('program')->nullable();
            $バランス->integer('umum')->nullable();
            $バランス->integer('jepang')->nullable();
            $バランス->integer('indo')->nullable();
            $バランス->integer('sum')->nullable();
            $バランス->decimal('percent', 5, 2)->nullable();
            $バランス->text('note')->nullable();
            $バランス->date('date')->nullable();
            $バランス->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wawancara_assessments');
    }
};
