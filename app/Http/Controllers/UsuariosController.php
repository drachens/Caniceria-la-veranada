<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsuariosController extends Controller
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
        return view('admin.register');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =  Validator::make($request->all(),[
            'nombre'=>'required|not_regex:/\d/|max:255',
            'rut'=>'regex:/^\d{1,2}\.\d{3}\.\d{3}-[\dk]$/|required|max:255',
            'correo'=>'email:rfc|required|max:255|unique:usuarios,correo',
            'password'=>'max:255|min:8',
            'rol'=>'required',
        ]);

        $validated = $validator->validated();

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput($validated);
        }
        $usuario = Usuarios::create([
            'nombre'=>strtolower($request->nombre),
            'rut'=>strtolower($request->rut),
            'correo'=>$request->correo,
            'password'=>Hash::make($request->password),
            'rol'=>$request->rol,
        ]); 
        
        if($usuario){
            return back()->with('success','Cuenta creada!');
        }
        else{
            return back()->with('fail','Error al crear la cuenta, intente más tarde.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function show(Usuarios $usuarios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function edit(Usuarios $usuarios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Usuarios $usuarios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuarios  $usuarios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuarios $usuarios)
    {
        //
    }
}
