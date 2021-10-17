<?php

namespace App\Http\Controllers;

use App\Clientes;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientesController extends Controller
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
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //tener 1 minuscula, mayuscula, numero y simbolo
        $validator = Validator::make($request->all(),[
            'nombre'=>'not_regex:/\d/|required|max:255',
            'apellido'=>'not_regex:/\d/|max:255',
            'correo'=>'required|email:rfc|max:255|unique:clientes,correo',
            'ciudad'=>'max:255',
            'calle'=>'max:255',
            'numero'=>'max:255',
            'telefono'=>'regex:/^\+56/|not_regex:/[a-zA-Z]/|required|max:12|min:12',
            'password'=>'max:255|min:5', 
            'rut'=>'regex:/^\d{1,2}\.\d{3}\.\d{3}-[\dk]$/|required|max:255',
        ]);
        $validated = $validator->validated();
        if ($validator->fails()) {
            return redirect('/registro')
            ->withErrors($validator)
            ->withInput($validated);
        }

        $cliente = Clientes::create([
            'rut'=>strtolower($request->rut),
            'nombre'=>strtolower($request->nombre),
            'apellido'=>strtolower($request->apellido),
            'correo'=>$request->correo,
            'ciudad'=>strtolower($request->ciudad),
            'calle'=>strtolower($request->calle),
            'numero'=>$request->numero,
            'telefono'=>$request->telefono,
            'password'=>Hash::make($request->password,[
                'rounds'=>12,
            ])
        ]);

        
        
       
        return redirect('/'); //mensaje de cuenta creada //datos validados
        

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function show(Clientes $clientes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function edit(Clientes $clientes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Clientes $clientes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Clientes  $clientes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Clientes $clientes)
    {
        //
    }
}
