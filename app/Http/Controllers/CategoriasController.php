<?php

namespace App\Http\Controllers;

use App\Categorias;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categorias = Categorias::all();
        return($categorias);
    }

    public function indexEditCat(){
        $categorias = Categorias::all();
        
        return view('categorias.editCat',compact('categorias'));
    }
    public function editCat(Request $request){
        $id = $request->id;
        $nuevo_nombre = $request->nombre;
        $nueva_descri = $request->descri;
        $antiguo_nombre = Categorias::where('id',$id)->first()->nombre;
        $antigua_descri = Categorias::where('id',$id)->first()->descri;

        $validator = Validator::make($request->all(),[
            'nombre'=>'max:255|string',
            'descri'=>'max:66535|string|nullable',
        ]);
        $validated = $validator->validated();
        
        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput($validated);
        }

        $exist = Categorias::where('id',$id)->first();
        if($exist){
            if(!($nuevo_nombre==$antiguo_nombre)){
                $update1 = Categorias::where('id',$id)
                ->update([
                    'nombre'=>$nuevo_nombre,
                ]);
                if($nueva_descri){
                    if(!($nueva_descri == $antigua_descri)){
                        $update2 = Categorias::where('id',$id)
                        ->update([
                            'descri'=>$nueva_descri,
                        ]);
                    }
                }
                $nombreFinal = $nuevo_nombre;
            }
            else{
                if($nueva_descri){
                    if(!($nueva_descri == $antigua_descri)){
                        $update2 = Categorias::where('id',$id)
                        ->update([
                            'descri'=>$nueva_descri,
                        ]);
                    }
                }
                $nombreFinal = $antiguo_nombre;
            }
        }
        return redirect('/editCategoria')->with('success','Categoría '.$nombreFinal.' editada satisfactoriamente.');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categorias.create');
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
            'descri'=>'max:65535',
        ]);

        $validated = $validator->validated();

        if ($validator->fails()) {
            return back()
            ->withErrors($validator)
            ->withInput($validated);
        }

        $categoria = Categorias::create([
            'nombre'=>strtolower($request->nombre),
            'descri'=>strtolower($request->descri),
        ]);

        if($categoria){
            return back()->with('success','Categoria '.ucwords($request->nombre).' creada!');
        }
        else{
            return back()->with('fail','Error al crear la categoria, intente más tarde.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function show(Categorias $categorias)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function edit(Categorias $categorias)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Categorias $categorias)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Categorias  $categorias
     * @return \Illuminate\Http\Response
     */
    public function destroy(Categorias $categorias)
    {
        //
    }
}
