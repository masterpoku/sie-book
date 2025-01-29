<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

   public function up()
   {
       Schema::create('tb_kelas', function (Blueprint $table) {
           $table->id(); // Kolom id dengan auto increment
           $table->string('kelas'); // Kolom kelas
           $table->timestamps(); // Kolom create_at dan update_at
       });
   }

   /**
    * Reverse the migrations.
    *
    * @return void
    */
   public function down()
   {
       Schema::dropIfExists('tb_kelas');
   }
};
