<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlbumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('albuns', function (Blueprint $table) {
            $table->id();
            $table->string('foto_capa')->nullable();
            $table->string('titulo');
            $table->longText('descricao')->nullable();
            $table->integer('qtd_fotos')->default(0);
            $table->integer('total_gostei')->default(0);
            $table->integer('total_naogostei')->default(0);
            $table->integer('total_visualizacao')->default(0);
            $table->boolean('ativo')->default(true);
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
        Schema::dropIfExists('albuns');
    }
}
