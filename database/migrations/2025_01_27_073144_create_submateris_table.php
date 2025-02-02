<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('submateris', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('materi_id');  // Just a regular column, no foreign key
            $table->string('name');
            $table->longtext('description')->nullable();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('submateris');
    }
};
