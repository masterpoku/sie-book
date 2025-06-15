<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJawabanEsaiTable extends Migration
{
    public function up()
    {
        Schema::create('jawaban_esai', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('siswa_id');
            $table->string('sub_materi');
            $table->text('jawaban');
            $table->timestamps();
            $table->string('penilaian')->nullable();


            // Kalau pakai foreign key (boleh dihapus kalau gak pakai relasi)
            // $table->foreign('siswa_id')->references('id')->on('siswa')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('jawaban_esai');
    }
}
