@extends('layout')

@section('content')
<hr>
<div class="row">

@foreach($pedidosFinal as $key=>$pedido)

    <div class="col-6 mb-4 mt-2">
        <div class="card">
            <div class="card-header bg-dark text-white text-center">
                <h3>Orden N° {{$pedido['numero']}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-7 align-self-center">
                        <div class="d-flex flex-row">
                            <h5 class="mr-auto font-weight-bold">Nombre: </h5>
                            <h5 class="ml-auto">{{$pedido['nombre']}} {{$pedido['apellido']}}</h5>
                        </div>
                        <div class="d-flex flex-row mt-2">
                            <h5 class="mr-auto font-weight-bold">Rut: </h5>
                            <h5 class="ml-auto">{{$pedido['rut_cliente']}}</h5>
                        </div>
                        <div class="d-flex flex-row mt-2">
                            <h5 class="mr-auto font-weight-bold">Teléfono: </h5>
                            <h5 class="ml-auto">{{$pedido['telefono']}}</h5>
                        </div>
                        <div class="d-flex flex-row mt-2">
                            <h5 class="mr-auto font-weight-bold">Correo: </h5>
                            <h5 class="ml-auto">{{$pedido['correo']}}</h5>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="d-flex flex-row">
                            <h5 class="mr-auto font-weight-bold">Monto total: </h5>
                            <h5 class="ml-auto text-success">${{$pedido['monto']}}</h5>
                        </div>
                        <div class="d-flex flex-row">
                            <h5 class="mr-auto font-weight-bold">Estado orden: </h5>
                            <h5 class="ml-auto bg-dark text-warning">{{$pedido['estado']}}</h5>
                        </div>
                        <br>
                        <div class="d-flex flex-row">
                            <h5 class="mr-auto font-weight-bold">fecha de orden: </h5>
                            <h5 class="ml-auto">{{$pedido['fecha_orden']}}</h5>
                        </div>
                        <br>
                        <div class="d-flex flex-row">
                            <h5 class="mr-auto font-weight-bold">fecha confirmación: </h5>
                            <h5 class="ml-auto">{{$pedido['fecha_confirm']}}</h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-dark text-white">
                <div class="row">
                    <div class="col">
                        <div class="row">
                            <div class="col-9">
                                <button class="mr-auto btn btn-lg btn-block btn-secondary">Atras</button>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="ml-auto col-10">
                                <a href="/detallePedidoAdmin/{{$pedido['numero']}}"><button class="ml-auto btn btn-lg btn-block btn-gold">Ver detalle</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endforeach
</div>


<hr>
@endsection