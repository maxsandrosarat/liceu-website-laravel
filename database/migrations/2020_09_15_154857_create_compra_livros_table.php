<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompraLivrosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('compra_livros', function (Blueprint $table) {
            $table->id();
            $table->string('nomeAluno');
            $table->integer('serie');
            $table->string('turma')->default('A');
            $table->enum('ensino',['EFI','EFII','EM','TODOS']);
            $table->string('nomeResp');
            $table->string('cpf');
            $table->float('valor');
            $table->string('formaPagamento');
            $table->string('user');
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
        Schema::dropIfExists('compra_livros');
    }
}
