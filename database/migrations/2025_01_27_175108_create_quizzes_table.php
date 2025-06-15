<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quizzes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('submateris_id'); // Kolom untuk relasi ke submateri
            $table->longtext('pertanyaan'); // Pertanyaan essay
            $table->text('jawaban_benar'); // Jawaban essay yang dianggap benar
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quizzes');
    }
};
