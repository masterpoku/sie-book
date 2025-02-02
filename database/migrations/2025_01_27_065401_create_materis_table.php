<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tb_materi', function (Blueprint $table) {
            $table->id(); // auto-incrementing primary key
            $table->string('mapel'); // Mata Pelajaran
            $table->string('kelas'); // Kelas
            $table->string('name'); // Nama Materi
            $table->longText('description')->nullable(); // Deskripsi Materi (bisa kosong)
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_materi');
    }
};
