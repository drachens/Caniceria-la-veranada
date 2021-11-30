<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Clientes;
use App\Carritos;
use App\Detalle_Orden;
use App\Orden_Compra;
use App\procarritos;
use App\Productos;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use DateTime;
use Ramsey\Uuid\Codec\TimestampLastCombCodec;

class OrdenCompraController extends Controller
{
    public function indexMisPedidos($id)
    {
        $rut = DB::table('clientes')
        ->where('id',$id)
        ->first()
        ->rut;

        $pedidos = DB::table('orden__compras')
        ->where('rut_cliente',$rut)
        ->get();

        return view('clientes.misPedidos',compact('pedidos'));

    }
    public function indexPedidosConfirmacion(){
        $pedidos = DB::table('orden__compras')
        ->where('estado','Falta confirmar')
        ->get();
        $pedidosFinal = [];
        foreach($pedidos as $pedido){
            $cliente = Clientes::where('rut',$pedido->rut_cliente)->first();
            $pedidoNuevo = [
                'numero' => $pedido->numero,
                'rut_cliente'=> $pedido->rut_cliente,
                'fecha_orden'=> $pedido->fecha_orden,
                'fecha_confirm'=> $pedido->fecha_confirm,
                'estado' => $pedido->estado,
                'monto' => $pedido->monto,
                'nombre' => $cliente->nombre,
                'apellido' => $cliente->apellido,
                'telefono' => $cliente->telefono,
                'correo' => $cliente->correo,
            ];
            array_push($pedidosFinal,$pedidoNuevo);
        }

        return view('admin.confirmarPedido',compact('pedidosFinal'));
    }

    function indexRetiroPedidos(){
        $pedidos = DB::table('orden__compras')
        ->where('estado','Confirmado')
        ->get();
        $pedidosFinal = [];
        foreach($pedidos as $pedido){
            $cliente = Clientes::where('rut',$pedido->rut_cliente)->first();
            $detalles = Detalle_Orden::where('num_orden',$pedido->numero)->get();
            $detalleInicial = [];
            foreach($detalles as $detalle){
                $producto = Productos::where('SKU',$detalle->SKU)->first();
                $detalle_producto = [
                    'nombre'=>$producto->nombre,
                    'precio'=>$producto->precio,
                    'SKU'=>$producto->SKU,
                    'cantidad'=>$detalle->cantidad,
                    'precio_lote'=>$detalle->cantidad * $producto->precio,
                ];
                array_push($detalleInicial,$detalle_producto);
            }
            $pedidoInicial = [
                'numero' => $pedido->numero,
                'rut_cliente'=> $pedido->rut_cliente,
                'fecha_orden'=> $pedido->fecha_orden,
                'fecha_confirm'=> $pedido->fecha_confirm,
                'estado'=>$pedido->estado,
                'monto'=>$pedido->monto,
                'nombre_cli'=>$cliente->nombre,
                'apellido'=>$cliente->apellido,
                'telefono'=>$cliente->telefono,
                'detalle_orden'=>$detalleInicial,
            ];
            array_push($pedidosFinal,$pedidoInicial);
        }
        //return json_encode($pedidosFinal);
        return view('admin.retiroPedidos',compact('pedidosFinal'));
    }

    function confirmarPedido($numero){
        $time = Carbon::now()->toDateTimeString();
        $pedido = DB::table('orden__compras')
        ->where('numero',$numero)
        ->update([
            'estado'=>'Confirmado',
            'fecha_confirm'=>$time,
        ]);
        return redirect('/confirmarPedidos');
    }

    function rechazarPedido($numero){
        $time = Carbon::now()->toDateTimeString();
        $pedido = DB::table('orden__compras')
        ->where('numero',$numero)
        ->update([
            'estado'=>'Rechazado',
            'fecha_confirm'=>$time,
        ]);
        return redirect('/confirmarPedidos');
    }
}
