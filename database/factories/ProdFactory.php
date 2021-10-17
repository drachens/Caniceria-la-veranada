<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Prod;
use Faker\Generator as Faker;

$factory->define(Prod::class, function (Faker $faker) {
    for ($i=0; $i<30;$i++) { 
        $title = "Producto_";
        $precio = 2000+$i*100;
        $peso = 100+$i*4;
        return [
            'nombre'=>$title.$faker->numerify,
            'descripcion'=>$faker->text(30),
            'precio'=>$precio+intval($faker->numerify),
            'peso'=>$faker->numerify
        ];
    }

});
