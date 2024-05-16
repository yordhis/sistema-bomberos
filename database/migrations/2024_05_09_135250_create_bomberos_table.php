<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBomberosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bomberos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 255)->nullable();
            $table->string('cedula', 255)->nullable();
            $table->string('telefono', 255)->nullable();
            $table->string('correo', 255)->nullable();
            $table->string('direccion', 255)->nullable();
            $table->string('cargo', 255)->nullable();
            $table->string('rol', 255)->nullable();
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
        Schema::dropIfExists('bomberos');
    }
}
