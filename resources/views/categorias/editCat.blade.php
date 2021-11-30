@extends('layout')

@section('content')
<hr>
<div class="row">
    <div class="col-12">
        <div class="row">
            <h1 class="ml-3 mb-4 mt-1">Editar Categorias</h1>
        </div>
    </div>
    @if(Session::has('success'))
    <div class="col-12">
        <div class="row">
            <div class="alert alert-success col-4 mt-1">
                {{ Session::get('success') }}
            </div>
        </div>
    </div>
    @endif
@foreach($categorias as $categoria)
<div class="d-flex flex-row col-lg-4 col-md-6 col-sm-12 mt-3 mb-4">
    <div class="card col-12">
        <div class="card-header bg-dark text-white text-center">
            <h3>{{ucwords($categoria->nombre)}}</h3>
        </div>
        <div class="card-body">
            <form action="{{url('editCat')}}" method="post" id="formCat{{$categoria->id}}" onsubmit="return confirmar()">
                @csrf
                <div class="form-group">
                    <label for="nombre">Nombre Categoría: </label>
                    <input id="nombre" class="form-control" type="text" name="nombre" value="{{$categoria->nombre}}">
                </div>
                <div class="form-group">
                    <label for="descri">Descipción: </label>
                    <textarea class="form-control" name="descri" id="descri" rows="4" placeholder="{{$categoria->descri}}"></textarea>
                </div>
                <input type="hidden" value="{{$categoria->id}}" name="id">
            </form>
        </div>
        <div class="card-footer bg-dark text-white">
            <div class="row justify-content-center">
                <div class="col-8">
                    <button type="submit" form="formCat{{$categoria->id}}" class="btn btn-block btn-lg btn-gold ">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach
</div>
<hr>
<script type="text/javascript">
    function confirmar(){
        var opcion = confirm("¿Desea modificar la categoría?");
        if(opcion){
            return true;
        }
        else{
            return false;
        }
    }
</script>
@endsection