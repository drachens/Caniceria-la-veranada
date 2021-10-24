<?php
use App\Categorias;
$categorias = Categorias::all();
use Illuminate\Support\Facades\DB;
?>
@extends('layout')

@section('content')

@foreach($productos as $prods)
<?php
 $cat = DB::table('categorias')->select('nombre')->where('id','=',$prods->id_cat)->get();
 $nombre = $cat[0]->nombre;
?>
<hr>
<div class="row">
    <div class="col-md-6 col-lg-6 col-sm-12 col-12 offset-md-3 offset-lg-3">
        <div class="card text-center">
            <div class="card-header">
                <h5 class="card-title"> Editar {{ ucwords($prods->nombre) }}</h5>
            </div>
            <img class="card-img-top mt-3" src="{{ url($prods->path) }}" style="width:300px;height:300px;display:block;margin:auto " alt="">
            <hr>
            <div class="card-body text-left">
                <form action="{{ asset('/updateProd') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @endif
                    @if(Session::has('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    <div class="alert alert-info">
                        <small class="mb-4 text-muted">Los campos con (*) son obligatorios.</small>
                        <br>
                        <small class="mb-4 text-muted">Debe ingresar peso o cantidad ( puede ingresar ambos ).</small>
                    </div>
                    <div class="form-group {{$errors->has('nombre') ? 'text-danger' : ''}}">
                        <label for="nombre">Nombre (*)</label>
                        <input class="form-control {{$errors->has('nombre') ? 'is-invalid' : ''}}" type="text" name="nombre" id="nombre" value="{{$prods->nombre}}" placeholder="">
                        {!! $errors->first('nombre','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('precio') ? 'text-danger' : ''}}">
                        <label for="precio">Precio (*)</label>
                        <input class="form-control {{$errors->has('precio') ? 'is-invalid' : ''}}" type="number" name="precio" id="precio" value="{{ $prods->precio }}" placeholder="">
                        {!! $errors->first('precio','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('peso') ? 'text-danger' : ''}}">
                        <label for="peso">Peso</label>
                        <input class="form-control {{$errors->has('peso') ? 'is-invalid' : ''}}" type="number" name="peso" id="peso" value="{{ $prods->peso }}" placeholder="">
                        <small class="text-muted">Ingrese peso en gramos.</small>
                        {!! $errors->first('peso','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('cantidad') ? 'text-danger' : ''}}">
                        <label for="cantidad">Cantidad</label>
                        <input class="form-control {{$errors->has('cantidad') ? 'is-invalid' : ''}}" type="number" name="cantidad" id="cantidad" value="{{ $prods->cantidad }}" placeholder="">
                        {!! $errors->first('cantidad','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('id_cat') ? 'text-danger' : ''}}">
                        <label for="id_cat">Categoria</label>
                        <select class="form-control mb-2 {{$errors->has('id_cat') ? 'is-invalid' : ''}}" id="id_cat" name="id_cat">
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ ucwords($categoria->nombre) }}</option>
                            @endforeach
                        </select>
                        <div class="alert alert-info">
                            <small >Categoria actual: {{ ucwords($nombre) }}</small>
                        </div> 
                        {!! $errors->first('id_cat','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('descri') ? 'text-danger' : ''}}">
                        <label for="descri">Descripcion</label>
                        <textarea class="form-control {{$errors->has('descri') ? 'is-invalid' : ''}}" type="text" rows="3" name="descri" id="descri" value="{{ $prods->descri }}" placeholder="">
                        </textarea>
                        {!! $errors->first('descri','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('foto') ? 'text-danger' : ''}}">
                        <label for="foto">Nueva imagen</label>
                        <input class="form-control-file {{$errors->has('foto') ? 'is-invalid' : ''}}"  type="file" name="foto" value="{{ $prods->path }}">
                        {!! $errors->first('foto','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group">
                        <input type="hidden" name="SKU" id="SKU" value="{{ $prods->SKU }}">
                    </div>
                    <button class="btn btn-dark btn-block">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
@endforeach

@endsection