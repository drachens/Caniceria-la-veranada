<?php

namespace App\Http\Controllers;

use App\Usuarios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Clientes;
use App\Carritos;
use App\Orden_Compra;
use App\Detalle_Orden;
use App\Boleta;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function usuariosIndex()
    {
        $users = [];
        $usuarios = DB::table('usuarios')
        ->get();
        $clientes = DB::table('clientes')
        ->get();
        foreach($usuarios as $usuario){
            $user = [
                'nombre'=>$usuario->nombre,
                'apellido'=>$usuario->apellido,
                'rut'=>$usuario->rut,
                'rol'=>$usuario->rol,
            ];
            array_push($users,$user);
        }
        foreach($clientes as $cliente){
            $client = [
                'nombre'=>$cliente->nombre,
                'apellido'=>$cliente->apellido,
                'rut'=>$cliente->rut,
                'rol'=>'cliente',
            ];
            array_push($users,$client);
        }
        return view('admin.eliminarUsuario',compact('users'));
    }

    function eliminarUser(Request $request){
        $rut = $request->rut;
        $rol = $request->rol;
        if($rol == 'admin'){
            return back()->with('error','No se puede eliminar cuentas de Administrador.');
        }
        else if($rol == 'vendedor'){
            $delete = DB::table('usuarios')
            ->where('rut',$rut)
            ->delete();
            if($delete){
                return back()->with('success','Usuario vendedor eliminado correctamente.');
            }
            else{
                return back()->with('error','Hubo un error, por favor intente más tarde.');
            }
        }
        else{
            $user = Clientes::where('rut',$rut)->first();
            $id_user = $user->id;
            $carrito = Carritos::where('id_cli',$id_user)->first();
            $id_carrito = $carrito->id;
            $deleteProdCarrito = DB::table('procarritos')
            ->where('id_carrito',$id_carrito)
            ->delete();
            if($deleteProdCarrito){
                $deleteCarrito=Carritos::where('id',$id_carrito)
                ->delete();
            }
            $ordenes = Orden_Compra::where('rut_cliente',$rut)
            ->get();
            foreach($ordenes as $orden){
                $num_orden = $orden->numero;
                $detalles = Detalle_Orden::where('num_orden',$num_orden)
                ->get();
                foreach($detalles as $detalle){
                    Detalle_Orden::where('id',$detalle->id)
                    ->delete();
                }
                Orden_Compra::where('numero',$orden->numero)
                ->delete();
            }
            Boleta::where('rut',$rut)->delete();

            $deleteCliente = DB::table('clientes')
            ->where('rut',$rut)
            ->delete();
            if($deleteCliente){
                return back()->with('success','Usuario cliente eliminado correctamente.');
            }
            else{
                return back()->with('error','Hubo un error.');
            }

        }
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
