@extends('layout')

@section('content')
<hr>

<div class="row">

@foreach($pedidosFinal as $key=>$pedido)

    <div class="card col-12 mt-4 mb-4">
        <div class="card-header text-center bg-dark text-white">
            <div class="row ">
                <div class="col-12 mt-3 mb-2 ">
                    <h2 class="font-weight-bold">Orden N°{{$pedido['numero']}}</h2>
                </div>
            </div>
        </div>
        <div class="card-body ">
            <div class="row">
                <div class="col-6">
                    <h4 class="text-center mb-4">Información Orden de Compra</h4>
                    <div class="d-flex flex-row">
                        <h5 class="mr-auto font-weight-bold">Fecha de orden:</h5>
                        <h5 class="ml-auto">{{$pedido['fecha_orden']}}</h5>
                    </div>
                    <div class="d-flex flex-row">
                        <h5 class="mr-auto font-weight-bold">Fecha de confirmación: </h5>
                        <h5 class="ml-auto">{{$pedido['fecha_confirm']}}</h5>
                    </div>
                    <div class="d-flex flex-row">
                        <h5 class="mr-auto font-weight-bold">Estado:</h5>
                        <h5 class="ml-auto bg-dark text-success">{{$pedido['estado']}}</h5>
                    </div>
                    <hr>
                    <h4 class="text-center mb-4">Información Personal</h4>
                    <div class="d-flex flex-row">
                        <h5 class="mr-auto font-weight-bold">Nombre Cliente:</h5>
                        <h5 class="ml-auto">{{$pedido['nombre_cli']}} {{$pedido['apellido']}}</h5>
                    </div>
                    <div class="d-flex flex-row">
                        <h5 class="mr-auto font-weight-bold">Rut Cliente:</h5>
                        <h5 class="ml-auto">{{$pedido['rut_cliente']}}</h5>
                    </div>
                    <div class="d-flex flex-row">
                        <h5 class="mr-auto font-weight-bold">Teléfono Cliente:</h5>
                        <h5 class="ml-auto">{{$pedido['telefono']}}</h5>
                    </div>
                </div>
                <div class="col-6">
                    <h4 class="text-center">------------Detalle Productos------------</h4>
                    <div class="row">
                        <div class="col-6 offset-3">
                        @foreach($pedido['detalle_orden'] as $key2=>$orden)
                        <div class="d-flex flex-row">
                            <h6 class="mr-auto font-weight-bold">SKU:</h6>
                            <h6 class="ml-auto">{{$orden['SKU']}}</h6>
                        </div>
                        <div class="d-flex flex-row">
                            <h6 class="mr-auto font-weight-bold">Nombre: </h6>
                            <h6 class="ml-auto">{{$orden['nombre']}}</h6>
                        </div>
                        <div class="d-flex flex-row">
                            <h6 class="mr-auto font-weight-bold">Precio:</h6>
                            <h6 class="ml-auto">${{$orden['precio']}}</h6>
                        </div>
                        <div class="d-flex flex-row">
                            <h6 class="mr-auto font-weight-bold">Cantidad:</h6>
                            <h6 class="ml-auto">{{$orden['cantidad']}} u.</h6>
                        </div>
                        <div class="d-flex flex-row">
                            <h6 class="mr-auto font-weight-bold">Precio Lote</h6>
                            <h6 class="ml-auto">${{$orden['precio_lote']}}</h6>
                        </div>
                        <hr>
                        @endforeach
                        </div>
                    </div>
                    <div class="d-flex flex-row justify-content-center">
                        <h5 class="text-center font-weight-bold">Monto: </h5>
                        <h5 class="ml-2 text-success text-center font-weight-bold">${{$pedido['monto']}}</h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer bg-dark text-white">
            <div class="row">
                <div class="col-12 mt-3 mb-2">
                    <h5 class="text-center">Si el pedido ya ha sido retirado, entonces CONFIRMA el retiro de este.</h5>
                </div>
                <div class="col-4 offset-4 mt-2 mb-3">
                    <a href="/generarBoleta/{{$pedido['numero']}}"><button class="btn btn-block btn-lg btn-gold">Confirmar Retiro</button></a>
                </div>
            </div>
        </div>
    </div>
@endforeach

</div>


<hr>
@endsection