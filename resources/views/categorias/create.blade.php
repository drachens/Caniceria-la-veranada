@extends('layout')

@section('content')
<div>
    <h3>Agergar Categoria</h3>
    <form action="{{url('/crearCategoria')}}" method="post">
    @csrf
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre">
    <br>
    <label for="descri">Descripcion</label>
    <input type="text" name="descri">
    <br>
    <button class="btn btn-secondary" type="submit">Crear</button>
    <br>
    </form>
</div>
@endsection