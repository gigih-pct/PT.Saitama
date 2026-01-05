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
        Schema::create('presensi_assessments', function (Blueprint $schema) {
            $schema->id();
            $schema->foreignId('user_id')->constrained()->onDelete('cascade');
            $schema->integer('day');
            $schema->integer('month');
            $schema->integer('year');
            $schema->string('status', 2)->nullable(); // H, A, S, I
            $schema->string('phone')->nullable();
            $schema->date('date')->nullable();
            $schema->timestamps();
            
            $schema->unique(['user_id', 'day', 'month', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi_assessments');
    }
};
