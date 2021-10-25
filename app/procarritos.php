<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class procarritos extends Model
{
    protected $fillable = ['id','SKU','nombre','id_carrito','cantidad','precio','foto'];
}
