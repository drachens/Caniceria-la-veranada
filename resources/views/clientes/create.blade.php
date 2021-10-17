@extends('layout')

@section('content')

<div class="container m-0 justify-content-center align-items-center mb-5 mt-4">
    <div class="row justify-content-center mx-1">
        <div class="col-8 text-center py-4 bg-dark mb-4">
            <h3 class="text-white">Registrate</h3>
        </div>
    </div>
    <form action="{{ url('/registroCrearCliente') }}" method="post">
    @csrf
        <div class="row justify-content-center allign-items-center form-group my-2">
            <div class="col-4">
                <label class="ml-1" for="nombre">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" value="{{ old('nombre') }}" placeholder="Ingrese nombre">
            </div>
            <div class="col-4">
                <label class="ml-1" for="password">Apellido</label>
                <input type="text" class="form-control" name="apellido" id="apellido" value="{{ old('apellido') }}" placeholder="Ingrese apellido">
            </div>
        </div>
        <div class="row justify-content-center allign-items-center form-group my-5">
            <div class="col-3">
                <label class="ml-1" for="ciudad">Ciudad</label>
                <input type="text" class="form-control" name="ciudad" id="ciudad" value="{{ old('ciudad') }}" placeholder="Ingrese ciudad">
            </div>
            <div class="col-3">
                <label class="ml-1" for="calle">Calle</label>
                <input type="text" class="form-control" name="calle" id="calle" value="{{ old('calle') }}" placeholder="Ingrese calle">
            </div>
            <div class="col-2">
                <label class="ml-1" for="numero">Numero/Depto</label>
                <input type="text" class="form-control" name="numero" id="numero" value="{{ old('numero') }}" placeholder="numero/bloque/depto">
            </div>
        </div>
        <div class="row justify-content-center allign-items-center form-group my-5">
            <div class="col-4">
                <label class="ml-1" for="correo">Correo</label>
                <input type="text" class="form-control" name="correo" id="correo" value="{{ old('correo') }}" placeholder="Ingrese correo">
            </div>
            <div class="col-4">
                <label class="ml-1" for="password">Contraseña</label>
                <input type="password" class="form-control" name="password" id="password" value="{{ old('password') }}" placeholder="">
            </div>
        </div>
        <div class="row justify-content-center allign-items-center form-group my-5">
            <div class="col-4">
                <label class="ml-1" for="rut">Rut</label>
                <input type="text" class="form-control" name="rut" id="rut" value="{{ old('rut') }}" placeholder="Ingrese rut">
                <small id="rut" class="form-text text-muted">Ingrese segun siguiente formato: 12.345.678-9.</small>
            </div>
            <div class="col-4">
                <label class="ml-1" for="telefono">Teléfono</label>
                <input type="text" class="form-control" name="telefono" id="telefono" value="{{ old('telefono') }}" placeholder="Ingrese número de teléfono">
                <small id="telefono" class="form-text text-muted">Ingrese segun siguiente formato: +56999776655.</small>
            </div>
        </div>
        <div class="row justify-content-center allign-items-center form-group text-center mt-5">
            <div class="col-4">
                <button class="btn btn-block btn-success" type="submit">Registrar</button>
            </div>
        </div>
    </form>
    @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
    @endif
</div>

@endsection