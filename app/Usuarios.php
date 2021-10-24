<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $fillable = ['rut','nombre','apellido','correo','password','rol','telefono'];
}
