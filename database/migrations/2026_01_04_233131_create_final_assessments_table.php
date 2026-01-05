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
        Schema::create('final_assessments', function (Blueprint $schema) {
            $schema->id();
            $schema->foreignId('user_id')->constrained()->onDelete('cascade');
            
            // Subjects
            $schema->integer('hiragana')->nullable();
            $schema->integer('katakana')->nullable();
            $schema->integer('bunpou')->nullable();
            $schema->integer('kerja')->nullable();
            $schema->integer('sifat')->nullable();
            $schema->integer('benda')->nullable();
            $schema->integer('terjemah')->nullable();
            $schema->integer('dengar')->nullable();
            $schema->integer('bicara')->nullable();
            
            // Metrics
            $schema->string('sikap', 2)->nullable()->default('A');
            $schema->decimal('kehadiran', 5, 2)->nullable()->default(100.00);
            $schema->decimal('rata_rata', 5, 2)->nullable();
            $schema->string('grade', 2)->nullable();
            
            $schema->date('date')->nullable();
            $schema->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_assessments');
    }
};
