<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFotosAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fotos_albuns', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->longText('descricao')->nullable();
            $table->unsignedBigInteger('album_id');
            $table->foreign('album_id')->references('id')->on('albuns');
            $table->integer('total_gostei')->default(0);
            $table->integer('total_naogostei')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fotos_albuns');
    }
}
