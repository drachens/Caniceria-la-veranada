@extends('layout')

@section('content')
<hr>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-5">
                @if(Session::has('error'))
                    <div class="bg-danger">
                        {{Session::get('error')}}
                    </div>
                @endif
                @if(Session::has('success'))
                    <div class="bg-success">
                        {{Session::get('success')}}
                    </div>
                @endif
            </div>
        </div>
    </div>
@foreach($users as $key=>$user)

    <div class="card col-6 offset-3 mt-4 mb-4">
        <div class="card-header bg-dark text-white">
            <div class="d-flex flex-row">
                <h1 class="ml-auto">{{$user['rol']}}</h1>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-7 offset-3">
                    <div class="d-flex flex-row">
                        <h5 class="mr-auto">Nombre: </h5>
                        <h5 class="ml-auto">{{$user['nombre']}} {{$user['apellido']}}</h5>
                    </div>
                    <div class="d-flex flex-row">
                        <h5 class="mr-auto">Rut: </h5>
                        <h5 class="ml-auto">{{$user['rut']}}</h5>
                    </div>
                    <div class="d-flex flex-row">
                        <h5 class="mr-auto">Rol: </h5>
                        <h5 class="ml-auto">{{$user['rol']}}</h5>
                    </div>
                </div>
            </div>
        </div>
        <form action="{{url('deleteUser')}}" method="post" id="{{$user['rut']}}{{$user['rol']}}" onsubmit="return confirmar()">
            @csrf
            <input type="hidden" name="rut" value="{{$user['rut']}}">
            <input type="hidden" name="rol" value="{{$user['rol']}}">
        </form>  
        <div class="card-footer bg-dark text-white">
            <div class="row">
                <div class="col-6 offset-3">
                    <button type="submit" form="{{$user['rut']}}{{$user['rol']}}" class="btn btn-lg btn-block btn-danger">Eliminar</button>
                </div>
            </div>
        </div>
    </div>
    
@endforeach
</div>
<hr>
<script type="text/javascript">
    function confirmar(){
        var opcion = confirm("¿Desea eliminar todo lo existente de este usuario?");
        if(opcion){
            return true;
        }
        else{
            return false;
        }
    }
</script>
@endsection