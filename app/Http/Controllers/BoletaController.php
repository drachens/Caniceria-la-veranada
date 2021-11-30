<?php

namespace App\Http\Controllers;

use App\Boleta;
use Illuminate\Http\Request;
use App\Clientes;
use App\Detalle_Orden;
use App\Orden_Compra;
use App\Productos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class BoletaController extends Controller
{
    function crearBoleta($numero){
        $orden = Orden_Compra::where('numero',$numero)->first();
        $monto = 0;
        $detalles = DB::table('detalle__ordens')
        ->where('num_orden',$numero)
        ->get();
        $iva = 19;
        $cliente = DB::table('clientes')->where('rut',$orden->rut_cliente)->first();
        foreach($detalles as $detalle){
            $precio = Productos::where('SKU',$detalle->SKU)->first()->precio;
            $monto = $monto + ($detalle->cantidad*$precio);
        }
        $monto_sin_iva = intval($monto/(($iva/100)+1));
        $iva_val = $monto - $monto_sin_iva;
        $time = Carbon::now()->toDateTimeString();
        $boleta = Boleta::create([
            'num_orden'=>$numero,
            'iva'=>$iva_val,
            'monto'=>$monto,
            'monto_sin_iva'=>$monto_sin_iva,
            'nombre'=>$cliente->nombre,
            'apellido'=>$cliente->apellido,
            'rut'=>$cliente->rut,
            'fecha'=>$time,
        ]);
        if($boleta){
            $update = DB::table('orden__compras')
            ->where('numero',$numero)
            ->update([
                'estado'=>'Entregado',
            ]);
            if($update){
                return redirect('/retiroPedidos');
            }
            else{
                return "error";
            }
        }
        else{
            return ($cliente->nombre);
        }
    }

    function indexBoletas(){
        $boletasFinal = [];
        $boletas = DB::table('boletas')
        ->get();
        foreach($boletas as $boleta){
            $productoFinal = [];
            $detalles = DB::table('detalle__ordens')
            ->where('num_orden',$boleta->num_orden)
            ->get();
            foreach($detalles as $detalle){
                $producto = DB::table('productos')
                ->where('SKU',$detalle->SKU)
                ->first();
                $lote = $producto->precio * $detalle->cantidad;
                $lote_sin_iva = intval($lote/((19/100)+1));
                $lote_iva = $lote - $lote_sin_iva;
                $productoInicial = [
                    'nombre'=>$producto->nombre,
                    'precio'=>$producto->precio,
                    'SKU'=>$producto->SKU,
                    'cantidad'=>$detalle->cantidad,
                    'lote'=>$lote,
                    'lote_iva'=>$lote_iva,
                    'lote_sin_iva'=>$lote_sin_iva,
                ];
                array_push($productoFinal,$productoInicial);
            }
            $boletasInicial = [
                'numero' => $boleta->numero,
                'num_orden'=>$boleta->num_orden,
                'nombre'=>$boleta->nombre,
                'apellido'=>$boleta->apellido,
                'rut'=>$boleta->rut,
                'monto'=>$boleta->monto,
                'iva'=>$boleta->iva,
                'monto_sin_iva'=>$boleta->monto_sin_iva,
                'fecha'=>$boleta->fecha,
                'detalleProd'=>$productoFinal,
            ];
            array_push($boletasFinal,$boletasInicial);
        }
        return view('admin.indexBoletas',compact('boletasFinal'));
    }
}
