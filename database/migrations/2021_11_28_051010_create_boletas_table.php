<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBoletasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('boletas', function (Blueprint $table) {
            $table->id('numero');
            $table->bigInteger('num_orden');
            $table->integer('iva');
            $table->integer('monto');
            $table->integer('monto_sin_iva');
            $table->string('nombre');
            $table->string('apellido');
            $table->string('rut');
            $table->dateTime("fecha",$precision = 0);
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
        Schema::dropIfExists('boletas');
    }
}
