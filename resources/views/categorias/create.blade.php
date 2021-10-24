@extends('layout')

@section('content')
<hr>
<div class="row text-center">
    <div class="col-6 offset-3">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Agergar Categoria</h3>
            </div>
            <div class="card-body text-left">
                <form action="{{url('/crearCategoria')}}" method="post">
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
                @csrf
                <div class="form-group {{$errors->has('nombre') ? 'text-danger' : ''}}">
                    <label for="nombre">Nombre (*)</label>
                    <input class="form-control {{$errors->has('nombre') ? 'is-invalid' : ''}}" type="text" name="nombre" value="{{ old('nombre') }}">
                    {!! $errors->first('nombre','<span class="help-block">:message</span>') !!}
                </div>
                <div class="form-group {{$errors->has('descri') ? 'text-danger' : ''}}">
                    <label for="descri">Descripcion</label>
                    <textarea rows="4" class="form-control {{$errors->has('descri') ? 'is-invalid' : ''}}" type="text" name="descri" value="{{ old('descri') }}"></textarea>
                    {!! $errors->first('descri','<span class="help-block">:message</span>') !!}
                </div>
                <br>
                <button class="btn btn-dark btn-block" type="submit">Crear</button>
                <br>
                </form>
            </div>
        </div>
    </div>
</div>
<hr>
@endsection