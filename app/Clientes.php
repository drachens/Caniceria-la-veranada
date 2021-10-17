<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $fillable = ['rut','nombre','apellido','correo','password','ciudad','calle','numero','telefono'];
}
