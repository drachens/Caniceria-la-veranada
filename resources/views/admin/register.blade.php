@extends('layout')

@section('content')
<hr>
<div class="row text-center">
    <div class="col-6 offset-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Registro de admin/vendedor</h5>
            </div>
            <div class="card-body text-left">
                <form method="POST" action="{{ route('registroAdmin') }}">
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
                    <input class="form-control {{$errors->has('nombre') ? 'is-invalid' : ''}}" type="text" name="nombre" value="{{ old('nombre') }}" placeholder="Ingrese su nombre">
                    {!! $errors->first('nombre','<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{$errors->has('rut') ? 'text-danger' : ''}}">
                    <label for="rut">Rut</label>
                    <input class="form-control {{$errors->has('rut') ? 'is-invalid' : ''}}" type="text" name="rut" value="{{ old('rut') }}" placeholder="Ingrese su rut">
                    <small class="text-muted">Formato del rut: 12.345.678-9</small>
                    {!! $errors->first('rut','<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{$errors->has('correo') ? 'text-danger' : ''}}">
                    <label for="correo">Correo</label>
                    <input class="form-control {{$errors->has('correo') ? 'is-invalid' : ''}}" type="email" name="correo" value="{{ old('correo') }}" placeholder="Ingrese su correo">              
                    {!! $errors->first('correo','<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{$errors->has('password') ? 'text-danger' : ''}}">
                    <label for="password">Contraseña</label>
                    <input class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" type="password" name="password" value="{{ old('password') }}" placeholder="Ingrese su contraseña">
                    {!! $errors->first('password','<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{$errors->has('rol') ? 'text-danger' : ''}}">
                    <label class="mr-sm-2" for="rol">Rol</label>
                    <select class="custom-select mr-sm-2 {{$errors->has('rol') ? 'is-invalid' : ''}}" id="inlineFormCustomSelect" value="{{ old('rol') }}" name="rol" required>
                        <option value="admin">Administrador</option>
                        <option value="vendedor">Vendedor</option>
                    </select>
                </div>
                <br>
                <button class="btn btn-dark btn-block">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
@endsection