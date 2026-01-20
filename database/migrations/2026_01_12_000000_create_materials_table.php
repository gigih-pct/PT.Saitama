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
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sensei_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('kelas_id')->nullable()->constrained('kelases')->onDelete('set null');
            $table->string('subject'); // e.g., Kanji, Kotoba, Bunpou
            $table->string('title');
            $table->string('level'); // e.g., A2, N5
            $table->string('file_path');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materials');
    }
};
