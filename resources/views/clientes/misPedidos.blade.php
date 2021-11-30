@extends('layout')


@section('content')
<hr>
<?php $n=0 ?>
<div class="row mt-4 mb-4">
    <div class="col-6 col-sm-10 col-lg-6 offset-3">
    @foreach($pedidos as $pedido)
        <div class="card mt-4 mb-5">
            <div class="card-header bg-dark text-white">
                <div class="d-flex flex-row">
                    <h3 class="mr-auto text-white">N° Orden</h3>
                    <h3 class="ml-auto text-gold">{{$pedido->numero}}</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-row">
                    <h5 class="mr-auto">Rut :</h5>
                    <h5 class="ml-auto">{{$pedido->rut_cliente}}</h5>
                </div>
                <hr>
                <div class="d-flex flex-row">
                    <h5 class="mr-auto">Fecha de orden :</h5>
                    <h5 class="ml-auto">{{$pedido->fecha_orden}}</h5>
                </div>
                <hr>
                <div class="d-flex flex-row">
                    <h5 class="mr-auto">Fecha de confirmación :</h5>
                    <h5 class="ml-auto">{{$pedido->fecha_confirm}}</h5>
                </div>
                <hr>
                <div class="d-flex flex-row">
                    <h5 class="mr-auto">Estado pedido :</h5>
                    <!--- Estilo estado del pedido --->
                    <?php
                        if($pedido->estado == 'Falta confirmar'){
                            $clase = "class='ml-auto text-warning bg-dark text-uppercase'";
                        }
                    ?>
                    <h5 {{$clase ?? '' }}>{{$pedido->estado}}</h5>
                </div>
                <hr>
                <br>
                <br>
                
                <div class="d-flex flex-row">
                    <div class="col-6 ml-auto">
                        <div class="d-flex flex-row">
                            <h4 class="mr-auto">Monto: </h4>
                            <h4 class="ml-auto">${{$pedido->monto}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center bg-dark text-white">
                <a href="/mispedidos/detalle/{{$pedido->numero}}"><button class="btn btn-gold btn-lg">Ver Detalle</button></a>
            </div>  
        </div>
    @endforeach
    </div>

</div>
<hr>

@endsection
