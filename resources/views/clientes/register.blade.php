@extends('layout')

@section('content')

<hr>
<div class="row text-center">
    <div class="col-6 offset-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Registrate</h5>
            </div>
            <div class="card-body text-left">
                <form method="POST" action="{{ route('registroCrearCliente') }}">
                    @if(Session::get('success'))
                        <div class="alert alert-success">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @csrf
                    <div class="form-group {{$errors->has('nombre') ? 'text-danger' : ''}}">
                        <label for="nombre">Nombre</label>
                        <input type="text" class="form-control {{$errors->has('nombre') ? 'is-invalid' : ''}}" name="nombre" value="{{ old('nombre') }}" placeholder="Ingrese su nombre">
                        {!! $errors->first('nombre','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('correo') ? 'text-danger' : ''}}">
                        <label class="card-text" for="correo">Correo</label>
                        <input type="email" class="form-control {{$errors->has('correo') ? 'is-invalid' : ''}}" name="correo" value="{{old('correo')}}" placeholder="Ingrese correo">
                        {!! $errors->first('correo','<span class="help-block">:message</span>') !!}
                    </div>
                    <div class="form-group {{$errors->has('password') ? 'text-danger' : ''}}">
                        <label class="card-text" for="password">Contraseña</label>
                        <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" name="password" placeholder="Ingrese contraseña">
                        {!! $errors->first('password','<span class="help-block">:message</span>') !!}
                    </div>
                    <button class="btn btn-dark btn-block mt-4">Registrar</button>
                    <br>
                    <a href="{{ url('ingreso') }}">¿Ya tienes una cuenta registrada?, entonces ingresa.</a>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>

@endsection