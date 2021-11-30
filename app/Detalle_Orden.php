<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalle_Orden extends Model
{
    protected $fillable = ['id','SKU','cantidad','num_orden'];
}
