<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('validasi', function (Blueprint $table) {
            $table->id();
            $table->string('validitas');
            $table->string('indikator');
            $table->text('pernyataan'); // Bisa lebih dari satu kalimat
            $table->integer('skor');
            $table->text('catatan')->nullable(); // Tambahin kolom catatan (bisa kosong)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('validasi');
    }
};
