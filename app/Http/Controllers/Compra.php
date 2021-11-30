<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Clientes;
use App\Carritos;
use App\Orden_Compra;
use App\Detalle_Orden;
use App\procarritos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use DateTime;
use Ramsey\Uuid\Codec\TimestampLastCombCodec;

class Compra extends Controller
{
    public function create(Request $request)
    {
        $userId = $request->session()->get('LoggedUser');
        $rut = Clientes::where('id',$userId)->first()->rut;
        $telefono = Clientes::where('id',$userId)->first()->telefono;
        $id_carrito = Carritos::where('id_cli',$userId)->first()->id;
        $monto = $request->session()->get('monto');
        if(!$id_carrito){
            return back()->with(
                'error','No tienes un carrito.'
            );
        }
        else{//Existe carrito
            $carrito = procarritos::where('id_carrito',$id_carrito)->get();
            if(count($carrito) == 0){
                return back()->with(
                    'error','Carrito vacio.'
                );
            }
            else { //Existen items en el carrito.
                //Crear orden de compra
                $time = Carbon::now()->toDateTimeString();
                if(!$rut){ //Si cliente aun no ingresa rut
                    return back()->with(
                        'error','Debe ingresar su rut y/o teléfono para seguir con la compra.'
                    );
                }
                elseif (!$telefono) {
                    return back()->with(
                        'error','Debe ingresar su rut y/o teléfono para seguir con la compra.'
                    );
                }
                else{
                    //Se crea orden de compra
                    $orden = Orden_Compra::create([
                        'rut_cliente'=>$rut,
                        'fecha_orden'=>$time,
                        'estado' => 'Falta confirmar',
                        'monto' => $monto,
                        ]);
                    //Se crea detalle de compra
                    $num_orden = $orden->id;
                    foreach ($carrito as $item ) {
                        //Agregar cada producto al detalle de compra.
                        Detalle_Orden::create([
                            'SKU'=>$item->SKU,
                            'cantidad'=>$item->cantidad,
                            'num_orden'=>$num_orden,
                        ]);  
                        }
                    $data = [
                    'num_orden'=>$num_orden,
                    'monto'=>$monto,
                    'estado'=>$orden->estado,
                    ];

                    //Vaciar carrito
                    $el = procarritos::where('id_carrito',$id_carrito)
                    ->delete();

                    if($el){
                        return view('carrito.compraHecha',compact('data'));
                        }
                    }
                
                
                 
            }
        }
        

    }
}
