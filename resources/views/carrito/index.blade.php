@extends('layout')

@section('content')
<hr>
<?php
    $monto = 0;
    foreach($carrito as $prod){
        $monto = $monto + $prod->cantidad*$prod->precio;
    }
?>
<div class="row">
    <div class="col-lg-10 col-md-10 col-sm-12 offset-lg-1 offset-md-1 text-center">
        <div class="card ">
            <div class="card-header">
                <h2 class="card-title my-4">Mi carrito</h2>
                <hr>
                <div class="row">
                    <div class="col-4 text-left">
                        <h5>Nombre</h5>
                    </div>
                    <div class="col-3">
                        <h5>Cantidad</h5>
                    </div>
                    <div class="col-3">
                        <h5>Precio</h5>
                    </div>
                    <div class="col-2">
                        <h5>Borrar</h5>
                    </div>
                </div>
            </div>
            <div class="card-body flex">
            @foreach($carrito as $producto)
                <div class="row">
                    <div class="col-4 text-left">
                        <h5>{{ucwords($producto->nombre)}}</h5>
                    </div>
                    <div class="col-3 text-center align-items-center pl-4">
                        <form action="{{url('updateCarritoLogin')}}" method="POST" class="form-inline">
                        @csrf
                        <input type="hidden" name="SKU" value="{{$producto->SKU}}" >
                        <input type="number" class=" mr-2 col-4 form-control" name="cantidad" value="{{$producto->cantidad}}">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i></button>
                        </form>
                    </div>
                    <div class="col-3">
                        <h6>${{$producto->precio}}</h6>
                    </div>
                    <div class="col-2">
                        <form action="{{url('deleteCarritoLogin')}}" method="POST">
                            @csrf
                            <input type="hidden" value="{{$producto->SKU}}" name="SKU">
                            <button class="btn btn-danger" type="submit"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
                <hr>
                @endforeach
                <h4 class="text-center">Monto total: ${{$monto}}</h4>
                <button class="btn btn-success btn-block" disabled>Pagar</button>
            </div>
        </div>
    </div>
</div>

<hr>
@endsection