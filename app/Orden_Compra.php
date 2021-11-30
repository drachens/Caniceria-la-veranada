<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden_Compra extends Model
{
    protected $fillable = ['numero','rut_cliente','fecha_orden','fecha_confirm','estado','monto'];
}
