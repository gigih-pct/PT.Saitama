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
        Schema::create('fmd_assessments', function (Blueprint $schema) {
            $schema->id();
            $schema->foreignId('user_id')->constrained()->onDelete('cascade');
            $schema->string('type'); // mtk, lari, pushup
            
            $schema->string('week1_val')->nullable();
            $schema->string('week1_ket')->nullable(); // TH, L, TL
            $schema->integer('week1_score')->default(0); // 1 or 0
            
            $schema->string('week2_val')->nullable();
            $schema->string('week2_ket')->nullable();
            $schema->integer('week2_score')->default(0);
            
            $schema->string('week3_val')->nullable();
            $schema->string('week3_ket')->nullable();
            $schema->integer('week3_score')->default(0);
            
            $schema->string('week4_val')->nullable();
            $schema->string('week4_ket')->nullable();
            $schema->integer('week4_score')->default(0);
            
            $schema->string('week5_val')->nullable();
            $schema->string('week5_ket')->nullable();
            $schema->integer('week5_score')->default(0);
            
            $schema->integer('total_score')->default(0);
            $schema->date('date')->nullable();
            $schema->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fmd_assessments');
    }
};
