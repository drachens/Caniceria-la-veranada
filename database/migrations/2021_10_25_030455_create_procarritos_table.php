<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcarritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procarritos', function (Blueprint $table) {
            $table->id('id');
            $table->bigInteger('SKU');
            $table->string('nombre');
            $table->bigInteger('id_carrito');
            $table->integer('cantidad');
            $table->integer('precio');
            $table->string('foto');
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
        Schema::dropIfExists('procarritos');
    }
}
