<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Productos;
use App\Imagenes;
use App\Clientes;
use App\Orden_Compra;
use Illuminate\Http\Request;

class DetalleOrdenController extends Controller
{
    public function indexDetalleOrden($numero){
        $ordenFinal=[];
        $ordenes = DB::table('detalle__ordens')
        ->where('num_orden',$numero)
        ->get();
        foreach($ordenes as $orden){
            $producto = Productos::where('SKU',$orden->SKU)->first();
            $imagen = Imagenes::where('id_prod',$producto->SKU)->first();
            $ordenIndividual = [
                'SKU'=>$producto->SKU,
                'nombre'=>$producto->nombre,
                'precio'=>$producto->precio,
                'imagen'=>$imagen->path,
                'cantidad'=>$orden->cantidad,
                'num_orden'=>$numero,
                'precio_lote'=>$orden->cantidad*$producto->precio,
            ];
            array_push($ordenFinal,$ordenIndividual);
        }
        return view('clientes.detalleOrden',compact('ordenFinal'));
    }

    public function indexDetalleOrdenAdmin($numero){
        $ordenFinal=[];
        $rut_cliente = Orden_Compra::where('numero',$numero)->first();
        $cliente = Clientes::where('rut',$rut_cliente->rut_cliente)->first();
        $ordenes = DB::table('detalle__ordens')
        ->where('num_orden',$numero)
        ->get();
        foreach($ordenes as $orden){
            $producto = Productos::where('SKU',$orden->SKU)->first();
            $imagen = Imagenes::where('id_prod',$producto->SKU)->first();
            $ordenIndividual = [
                'SKU'=>$producto->SKU,
                'nombre'=>$producto->nombre,
                'precio'=>$producto->precio,
                'imagen'=>$imagen->path,
                'cantidad'=>$orden->cantidad,
                'num_orden'=>$numero,
                'precio_lote'=>$orden->cantidad*$producto->precio,
                'nombre_cliente' => $cliente->nombre,
                'apellido'=> $cliente->apellido,
                'telefono'=> $cliente->telefono,
            ];
            array_push($ordenFinal,$ordenIndividual);
        }
        return view('admin.detalleOrden',compact('ordenFinal'));
    }
}
