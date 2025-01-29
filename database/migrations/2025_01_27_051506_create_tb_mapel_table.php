<?php
// database/migrations/xxxx_xx_xx_xxxxxx_create_tb_mapel_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbMapelTable extends Migration
{
    public function up()
    {
        Schema::create('tb_mapel', function (Blueprint $table) {
            $table->id();
            $table->string('mapel');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_mapel');
    }
}
