@extends('layout')

@section('content')


@if($data)
<hr>
<div class="row mt-4 mb-4">
    <div class="col-lg-5 col-md-5 col-sm-10  text-left">
        <div class="card text-white bg-success">
            <div class="card-header text-center">
                <br>
                <h2>¡Pedido Realizado!</h2>
                <br>
            </div>
            <div class="card-body">
                <div class="d-flex flex-row">
                    <h5>Número de Orden</h5>
                    <h5 class="ml-auto">{{$data['num_orden']}}</h5>
                </div>
                <hr>
                <div class="d-flex flex-row">
                    <h5>Monto a pagar</h5>
                    <h5 class="ml-auto">${{$data['monto']}}</h5>
                </div>
                <hr>
                <div class="d-flex flex-row">
                    <h5>Estado de la orden</h5>
                    <h5 class="ml-auto">{{$data['estado']}}</h5>
                </div>
            </div>
        </div>
        <div class="card bg-info text-white mt-4 text-center">
            <div class="card-body">
                <h5>Para ver el estado de tus pedidos haz click en el botón.</h5>
                <a href="/miperfil/mispedidos/{{Session::get('LoggedUser')}}"><button class="btn btn-dark">Ver Pedidos</button></a>
            </div>
        </div>
    </div>
</div>


@endif
<hr>
@endsection