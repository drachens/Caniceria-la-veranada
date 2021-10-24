<?php

namespace App\Http\Controllers;

use App\Clientes;
use Illuminate\Support\Facades\DB;
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
        return view('clientes.login');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.register');
    }

    public function editar($id)
    {
        $userInfo = DB::table('clientes')
        ->where('id',$id)
        ->get();
        return view('clientes.editar',compact('userInfo'));
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
            'nombre'=>'required|not_regex:/\d/|max:255',
            //'apellido'=>'not_regex:/\d/|max:255',
            'correo'=>'email:rfc|required|max:255|unique:clientes,correo',
            //'ciudad'=>'max:255',
            //'calle'=>'max:255',
            //'numero'=>'max:255',
            //'telefono'=>'regex:/^\+56/|not_regex:/[a-zA-Z]/|required|max:12|min:12',
            'password'=>'max:255|min:8', 
            //'rut'=>'regex:/^\d{1,2}\.\d{3}\.\d{3}-[\dk]$/|required|max:255',
        ]);
        $validated = $validator->validated();
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput($validated);
        }

        $cliente = Clientes::create([
            'nombre'=>strtolower($request->nombre),
            'correo'=>$request->correo,
            'password'=>Hash::make($request->password),
        ]); 
       
        if($cliente){
            return back()->with('success','Cuenta creada!');
        } //mensaje de cuenta creada //datos validados
        else{
            return back()->with('fail','Error al crear la cuenta, intente de nuevo en un momento.');
        }

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
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nombre'=>'required|not_regex:/\d/|max:255',
            'apellido'=>'nullable|not_regex:/\d/|max:255',
            'ciudad'=>'max:255',
            'calle'=>'max:255',
            'numero'=>'max:255',
            'telefono'=>'nullable|regex:/^\+56/|not_regex:/[a-zA-Z]/|max:12|min:12',
            'password'=>'max:255|min:8', 
            'rut'=>'nullable|regex:/^\d{1,2}\.\d{3}\.\d{3}-[\dk]$/|max:255',
        ]);
        $validated = $validator->validated();
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput($validated);
        }

        $update = DB::table('clientes')
        ->where('correo',$request->correo)
        ->update([
            'nombre'=>$request->nombre,
            'apellido'=>$request->apellido,
            'telefono'=>$request->telefono,
            'rut'=>$request->rut,
            'ciudad'=>$request->ciudad,
            'calle'=>$request->calle,
            'numero'=>$request->numero,
        ]);

        if($update>=0){
            return back()->with('success','Datos actualizados!');
        }
        else{
            return back()->with('fail','Error al actualizar el datos, intente más tarde.');
        }
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
