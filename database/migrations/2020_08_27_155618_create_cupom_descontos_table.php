<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCupomDescontosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cupom_descontos', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('localizador')->unique();
            $table->decimal('desconto',6,2)->default(0);
            $table->enum('modo_desconto', ['valor','porc'])->default('porc');
            $table->decimal('limite',6,2)->default(0)->nullable();
            $table->enum('modo_limite', ['valor','qtd'])->default('qtd')->nullable();
            $table->dateTime('validade');
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
        Schema::dropIfExists('cupom_descontos');
    }
}
