<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clientes', function (Blueprint $table) {
            $table->id("id");

            $table->string("rut")->nullable();
            $table->string("telefono")->nullable();
            $table->string("nombre");
            $table->string("apellido")->nullable();
            $table->string("correo");
            $table->string("password");
            $table->string("ciudad")->nullable();
            $table->string("calle")->nullable();
            $table->string("numero")->nullable();
            
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
        Schema::dropIfExists('clientes');
    }
}
