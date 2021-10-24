@extends('layout')

@section('content')
<hr>
<div class="row text-center">
    <div class="col-md-6 offset-3">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Acceso a la página</h5>
            </div>
            <div class="card-body text-left">
                <form method="POST" action="{{ route('login') }}">
                @if(Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                @endif

                @csrf
                <div class="form-group {{$errors->has('email') ? 'text-danger' : ''}}">
                    <label class="card-text" for="correo">Email</label>
                    <input class="form-control  {{$errors->has('email') ? 'is-invalid' : ''}}" type="email" name="correo" placeholder="Ingresa tu email" value="{{ old('correo') }}">
                    {!! $errors->first('email', '<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{$errors->has('password') ? 'text-danger' : ''}}">
                    <label for="password" class="card-text">Contraseña</label>
                    <input type="password" class="form-control {{$errors->has('password') ? 'is-invalid' : ''}}" name="password" placeholder="Ingresa tu contraseña">
                    {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
                </div>
                <button class="btn btn-dark btn-block mt-4" >Ingresar</button>
                <br>
                <a href="{{ url('register') }}">Si no tienes una cuenta creada, regístrate</a>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
@endsection