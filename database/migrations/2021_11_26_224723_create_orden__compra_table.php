<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOrdenCompraTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orden__compra', function (Blueprint $table) {
            $table->id("numero");
            $table->string("rut_cliente");
            $table->dateTime("fecha_orden",$precision = 0);
            $table->dateTime("fecha_confirm",$precision = 0)->nullable();
            $table->string("estado");
            $table->bigInteger("monto");
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
        Schema::dropIfExists('orden__compras');
    }
}
