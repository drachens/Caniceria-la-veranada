<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use App\Productos;
use App\Imagenes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ProductosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $prods = DB::table('productos')
        ->join('imagenes','productos.SKU','=','imagenes.id_prod')
        ->select('productos.SKU','productos.nombre','productos.precio','productos.descri','productos.peso','productos.cantidad','imagenes.path')
        ->where('id_cat','=',$id)
        ->get();

        return view('productos.indexProductos',compact('prods'));
        //return response()->json($prods);
    }

    public function editar($id)
    {
        $productos = DB::table('productos')
        ->join('imagenes','productos.SKU','=','imagenes.id_prod')
        ->select('productos.SKU','productos.nombre','productos.precio','productos.descri','productos.peso',
        'productos.cantidad','productos.id_cat','imagenes.path')
        ->where('productos.SKU','=',$id)
        ->get();

        return view('productos.editar',compact('productos'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('productos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosProductos = request()->except('_token','foto');
        
        $validator = Validator::make($request->all(),[
            'nombre'=>'required|unique:productos|max:255|string',
            'precio'=>'required|numeric',
            'id_cat'=>'required|exists:categorias,id',
            'descri'=>'max:66535|string|nullable',
            'foto'=>'file|image|max:1024',
            'peso'=>'required_without:cantidad|numeric|nullable',
            'cantidad'=>'required_without:peso|numeric|nullable',
        ]);
        $validated = $validator->validated();
        
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput($validated);
        }
        $prod = Productos::create([
            'nombre'=>strtolower($request->nombre),
            'precio'=>$request->precio,
            'descri'=>strtolower($request->descri),
            'id_cat'=>$request->id_cat,
            'peso'=>$request->peso,
            'cantidad'=>$request->cantidad,
        ]);
        $id_prod = $prod->id;

        if ($request->hasFile('foto')) {
            Storage::disk('local')->put('public/imagenes',$request->file('foto'));
            $foto = $request->file('foto')->store('/storage/imagenes');
            //$foto = Storage::path($request->file('foto'));
            Imagenes::create([
                'id_prod'=>$id_prod,
                'path'=>$foto,
            ]);
        }
        else{
            Imagenes::create([
                'id_prod'=>$id_prod,
                'path'=>'storage/imagenes/producto-default.jpg',
            ]); 
        }

        if($prod){
            return back()->with('success','Producto '.ucwords($request->nombre).' agregado!');
        }
        else{
            return back()->with('fail','Error al agegar el producto, intente más tarde.');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function show(Productos $productos)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function edit(Productos $productos)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nombre'=>'required|max:255|string',
            'precio'=>'required|numeric',
            'id_cat'=>'required|exists:categorias,id',
            'descri'=>'max:66535|string|nullable',
            'foto'=>'file|image|max:1024',
            'peso'=>'required_without:cantidad|numeric|nullable',
            'cantidad'=>'required_without:peso|numeric|nullable',
            'SKU'=>'required|exists:productos,SKU',
        ]);
        $validated = $validator->validated();
        
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput($validated);
        }

        $update = DB::table('productos')
        ->where('SKU',$request->SKU)
        ->update([
            'nombre'=>strtolower($request->nombre),
            'precio'=>$request->precio,
            'descri'=>strtolower($request->descri),
            'id_cat'=>$request->id_cat,
            'peso'=>$request->peso,
            'cantidad'=>$request->cantidad,
        ]);

        if ($request->hasFile('foto')) {
            Storage::disk('local')->put('public/imagenes',$request->file('foto'));
            $foto = $request->file('foto')->store('/storage/imagenes');
            //$foto = Storage::path($request->file('foto'));
            $updateImage = DB::table('imagenes')
            ->where('id_prod',$request->SKU)
            ->update([
                'path'=>$foto,
            ]);
        }

        if($update>=0){
            return back()->with('success','Producto '.ucwords($request->nombre).' actualizado!');
        }
        else{
            return back()->with('fail','Error al actualizar el producto, intente más tarde.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Productos  $productos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Productos $productos)
    {
        //
    }
}
