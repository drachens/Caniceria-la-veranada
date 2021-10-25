<?php

namespace App\Http\Controllers;
use App\procarritos;
use App\Carritos;
use Illuminate\Http\Request;

class CarritosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($user)
    {
        $carritoMaster = Carritos::where('id_cli',$user)->first();

        $id_carrito = $carritoMaster->id;

        $carrito = procarritos::where('id_carrito',$id_carrito)->get();

        return view('carrito.index',compact('carrito'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Carritos  $carritos
     * @return \Illuminate\Http\Response
     */
    public function show(Carritos $carritos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Carritos  $carritos
     * @return \Illuminate\Http\Response
     */
    public function edit(Carritos $carritos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Carritos  $carritos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Carritos  $carritos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carritos $carritos)
    {
        //
    }
}
