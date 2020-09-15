<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProdutosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produtos', function (Blueprint $table) {
            $table->id();
            $table->string('foto')->nullable();
            $table->string('nome');
            $table->integer('turma');
            $table->enum('ensino',['EFI','EFII','EM','TODOS']);
            $table->string('embalagem')->nullable();
            $table->string('marca')->nullable();
            $table->float('preco');
            $table->integer('estoque');
            $table->longText('descricao')->nullable();
            $table->unsignedBigInteger('categoria_id');
            $table->boolean('ativo')->default(true);
            $table->boolean('promocao')->default(false);
            $table->foreign('categoria_id')->references('id')->on('categorias');
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
        Schema::dropIfExists('produtos');
    }
}
