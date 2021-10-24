@extends('layout')

@section('content')
<hr>
@foreach($userInfo as $user)

@endforeach
<div class="row text-center">
    <div class="col-md-8 col-lg-8 col-sm-12 offset-md-2 offset-lg-2">
        <div class="card">
            <div class="card-header">
                <h2>Mi perfil</h2>
            </div>
            <hr>
            <div class="card-body text-left">
                <form action="{{ url('updateCliente') }}" method="POST">
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
                    <div class="form-group {{$errors->has('nombre') ? 'text-danger' : ''}}">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control {{$errors->has('nombre') ? 'is-invalid' : ''}}" name="nombre" value="{{ ucwords($user->nombre) }}" id="nombre">
                        {!! $errors->first('nombre','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('apellido') ? 'text-danger' : ''}}">
                        <label for="apellido">Apellido</label>
                        <input type="text" class="form-control {{$errors->has('apellido') ? 'is-invalid' : ''}}" name="apellido" value="{{ ucwords($user->apellido) }}" id="apellido">
                        {!! $errors->first('apellido','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('rut') ? 'text-danger' : ''}}">
                        <label for="rut">Rut</label>
                        <input type="text" class="form-control {{$errors->has('rut') ? 'is-invalid' : ''}}" name="rut" value="{{ $user->rut }}" id="rut">
                        <small class="text-muted">Formato del rut: 12.345.678-9</small>
                        {!! $errors->first('rut','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('telefono') ? 'text-danger' : ''}}">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control {{$errors->has('telefono') ? 'is-invalid' : ''}}" name="telefono" value="{{ $user->telefono }}" id="telefono">
                        <small class="text-muted">Formato: +56XXXXXXXXX</small>
                        {!! $errors->first('telefono','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('ciudad') ? 'text-danger' : ''}}">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" class="form-control {{$errors->has('ciudad') ? 'is-invalid' : ''}}" name="ciudad" value="{{ $user->ciudad }}" id="ciudad">
                        {!! $errors->first('ciudad','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('calle') ? 'text-danger' : ''}}">
                        <label for="calle">Calle</label>
                        <input type="text" class="form-control {{$errors->has('calle') ? 'is-invalid' : ''}}" name="calle" value="{{ $user->calle }}" id="calle">
                        {!! $errors->first('calle','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('numero') ? 'text-danger' : ''}}">
                        <label for="numero">Número</label>
                        <input type="text" class="form-control {{$errors->has('numero') ? 'is-invalid' : ''}}" name="numero" value="{{ $user->numero }}" id="numero">
                        <small class="text-muted">Número de casa/block/departamento</small>
                        {!! $errors->first('numero','<span class="help-block">:message</span>') !!}
                    </div>
                    <input type="hidden" name="correo" id="correo" value="{{ $user->correo }}">
                    <button class="btn btn-dark btn-block">Actualizar datos</button>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
@endsection