<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormaDePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forma_de_pagos', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_pago', 255)->nullable();
            $table->string('metodo', 255)->nullable();
            $table->string('monto', 255)->nullable();
            $table->string('tasa', 255)->nullable();
            $table->string('referencia', 255)->nullable();
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
        Schema::dropIfExists('forma_de_pagos');
    }
}
