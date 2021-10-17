<?php
use App\Categorias;
$categorias = Categorias::all()
?>
@extends('layout')
@section('content')
    <div class="container">
    <div class="col-6">
        Crear producto
        <div class="container">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <form action="{{ asset('/storageProd') }}" method="post" enctype="multipart/form-data">
        @csrf <!--- imprime llave de seguridad para que laravel nos responda al enviar la informacion --->
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" value="{{ old('nombre') }}">
        <br>
        <label for="precio">Precio</label>
        <input type="number" name="precio" value="{{ old('precio') }}">
        <br>
        <label for="descri">Descripcion</label>
        <input type="text" name="descri" value="{{ old('descri') }}">
        <br>
        <label for="id_cat">Categoria</label>
            <select class="form-control" id="id_cat" name="id_cat">
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
            @endforeach
            </select>
        <br>
        <label for="peso">Peso</label>
        <input type="number" name="peso" value="{{ old('peso') }}">
        <br>
        <label for="cantidad">Cantidad</label>
        <input type="number" name="cantidad" value="{{ old('cantidad') }}">
        <br>
        <label for="foto">Imagen</label>
        <input type="file" name="foto" value="{{ old('foto') }}">
        <br>
        <button type="submit" class="btn btn-primary">Crear</button>
        </form>
    </div>
    </div>
</div>
@endsection