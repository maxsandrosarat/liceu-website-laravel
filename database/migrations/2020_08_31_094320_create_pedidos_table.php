<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('endereco_id')->nullable();
            $table->foreign('endereco_id')->references('id')->on('enderecos');
            $table->enum('status',['RESERV','FEITO','PAGO','CANCEL']);
            $table->float('total');
            $table->string('observacao')->nullable();
            $table->unsignedBigInteger('forma_pagamento_id')->nullable();
            $table->foreign('forma_pagamento_id')->references('id')->on('forma_pagamentos');
            $table->enum('tipoPagamento',['presencial','online'])->nullable();
            $table->float('troco')->default(0);
            $table->unsignedBigInteger('entrega_id')->nullable();
            $table->foreign('entrega_id')->references('id')->on('entregas');
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
        Schema::dropIfExists('pedidos');
    }
}
