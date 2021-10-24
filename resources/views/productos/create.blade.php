<?php
use App\Categorias;
$categorias = Categorias::all()
?>
@extends('layout')
@section('content')
    <hr>
    <div class="row text-center">
        <div class="col-6 offset-3">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Agregar Productos</h5>
                </div>
            <div class="card-body text-left">    
                <form action="{{ asset('/storageProd') }}" method="post" enctype="multipart/form-data">
                    @csrf <!--- imprime llave de seguridad para que laravel nos responda al enviar la informacion --->
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
                    <div class="form-group mt-4 {{$errors->has('nombre') ? 'text-danger' : ''}}">
                        <label for="nombre">Nombre (*)</label>
                        <input class="form-control {{$errors->has('nombre') ? 'is-invalid' : ''}}" type="text" name="nombre" value="{{ old('nombre') }}">
                        {!! $errors->first('nombre','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('precio') ? 'text-danger' : ''}}">
                        <label for="precio">Precio (*)</label>
                        <input class="form-control {{$errors->has('precio') ? 'is-invalid' : ''}}" type="number" name="precio" value="{{ old('precio') }}">
                        {!! $errors->first('precio','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('id_cat') ? 'text-danger' : ''}}">
                        <label for="id_cat">Categoria (*)</label>
                            <select class="form-control {{$errors->has('id_cat') ? 'is-invalid' : ''}}" id="id_cat" name="id_cat">
                            @foreach($categorias as $categoria)
                                <option value="{{ $categoria->id }}">{{ ucwords($categoria->nombre) }}</option>
                            @endforeach
                            </select>
                        {!! $errors->first('id_cat','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('peso') ? 'text-danger' : ''}}">
                        <label for="peso">Peso</label>
                        <input class="form-control {{$errors->has('peso') ? 'is-invalid' : ''}}" type="number" name="peso" value="{{ old('peso') }}">
                        <small class="text-muted">Ingrese peso en gramos.</small>
                        {!! $errors->first('peso','<br><span class="help-block">:message</span>') !!}
                    </div>
                    <div class="group-form {{$errors->has('cantidad') ? 'text-danger' : ''}}">
                        <label for="cantidad">Cantidad</label>
                        <input class="form-control {{$errors->has('cantidad') ? 'is-invalid' : ''}}" type="number" name="cantidad" value="{{ old('cantidad') }}">
                        {!! $errors->first('cantidad','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group mt-2 {{$errors->has('descri') ? 'text-danger' : ''}}">
                        <label for="descri">Descripcion</label>
                        <textarea class="form-control {{$errors->has('descri') ? 'is-invalid' : ''}}" rows="3" type="text" name="descri" value="{{ old('descri') }}"></textarea>
                        {!! $errors->first('descri','<span class="help-block">:message</span>') !!}
                    </div>
                    <br>
                    <hr>
                    <div class="form-group mb-4 {{$errors->has('foto') ? 'text-danger' : ''}}">
                        <label for="foto">Imagen</label>
                        <input class="form-control-file {{$errors->has('foto') ? 'is-invalid' : ''}}" type="file" name="foto" value="{{ old('foto') }}">
                        {!! $errors->first('foto','<span class="help-block">:message</span>') !!}
                    </div>
                    <hr>
                    <br>
                    <button type="submit" class="btn btn-dark btn-block">Crear</button>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
@endsection