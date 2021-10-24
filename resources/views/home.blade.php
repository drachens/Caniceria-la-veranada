@extends('layout')

@section('content')
    <h1>Contenido de Home</h1>
    {{ Session::get('LoggedUser') }}
    {{ Session::get('type') }}
@endsection