<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Boleta extends Model
{
    protected $fillable = ['numero','num_orden','iva','monto','monto_sin_iva','nombre','apellido','rut','fecha'];
}
