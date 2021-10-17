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

        return view('productos.indexProd',compact('prods'));
        //return response()->json($prods);
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
            'nombre'=>'required|unique:productos|max:255',
            'precio'=>'required',
            'id_cat'=>'required|exists:categorias,id',
            'descri'=>'max:1024',
            'foto'=>'required',
        ]);
        $validated = $validator->validated();
        
        if ($validator->fails()) {
            return redirect("/storageProd")
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


        return redirect('/');
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
    public function update(Request $request, Productos $productos)
    {
        //
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
