<?php

namespace App\Http\Controllers;
use App\Carritos;
use App\Prods_carrito;
use App\Productos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\procarritos;
use App\Imagenes;

class ProcarritosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($idProd,$user)
    {
        //Datos producto
        $producto = Productos::where('SKU',$idProd)->first();
        //obtener id del usuario y ver si tiene un carrito
        $carro = Carritos::where('id_cli',$user)->first();
        $imagen = Imagenes::where('id_prod',$idProd)->first();
        if(!$carro){
            $carro = Carritos::create([
                'id_cli'=>$user,
            ]);
            
        }
        //ver si existe ese mismo producto en su carrito
        $existeProd = procarritos::where('id_carrito',$carro->id)->where('SKU',$idProd)->first();
        //si existe
        if($existeProd){
           $fail= procarritos::where('id_carrito',$carro->id)
            ->where('SKU',$idProd)
            ->update(['cantidad'=>$existeProd->cantidad+1]);

            if($fail){
                return back()->with('success','Producto '.$producto->nombre.' agregado al carrito!');
            }
            else{
                return back()->with('fail','No se pudo agregar al carro, intente mas tarde.');
            }
        }

        $prodNuevo = procarritos::create([
            'SKU'=>$idProd,
            'nombre'=>$producto->nombre,
            'id_carrito'=>$carro->id,
            'cantidad'=>1,
            'precio'=>$producto->precio,
            'foto'=>$imagen->path,
        ]);

        if($prodNuevo){
            return back()->with('success','Producto '.$producto->nombre.' agregado al carrito!');
        }
        else{
            return back()->with('fail','No se pudo agregar al carro, intente mas tarde.');
        }

        //recibo id producto
        }
    

    /**
     * Display the specified resource.
     *
     * @param  \App\procarritos  $procarritos
     * @return \Illuminate\Http\Response
     */
    public function show(procarritos $procarritos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\procarritos  $procarritos
     * @return \Illuminate\Http\Response
     */
    public function edit(procarritos $procarritos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\procarritos  $procarritos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $userId = $request->session()->get('LoggedUser');
        $carro = Carritos::where('id_cli',$userId)->first();
        $cantidad = $request->cantidad;
        $SKU = $request->SKU;

        if($cantidad == 0){

            $el = procarritos::where('id_carrito',$carro->id)
            ->where('SKU',$SKU)
            ->delete();

            return back();
        }


        $fail= procarritos::where('id_carrito',$carro->id)
            ->where('SKU',$SKU)
            ->update(['cantidad'=>$cantidad]);
        
        if($fail){
            return back();
        }
        else{
            print "error";
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\procarritos  $procarritos
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $userId = $request->session()->get('LoggedUser');
        $carro = Carritos::where('id_cli',$userId)->first();
        $SKU = $request->SKU;
        
        $el = procarritos::where('id_carrito',$carro->id)
        ->where('SKU',$SKU)
        ->delete();

        if($el){
            return back();
        }
    }
}
