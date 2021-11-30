@extends('layout')

@section('content')
<hr>

<div class="row">
    @foreach($boletasFinal as $key=>$boleta)
        <div class="card col-10 offset-1 mt-3 mb-3">
            <div class="card-header text-center bg-dark text-white">
                <div class="d-flex flex-row justify-content-center">
                    <h2>Boleta N°</h2>
                    <h2>{{$boleta['numero']}}</h2>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h3 class="text-center mb-3">---- Detalles Cliente ----</h3>
                        <div class="row">
                            <div class="col-10 offset-1">
                                <div class="d-flex flex-row">
                                <h5 class="mr-auto font-weight-bold">Nombre cliente: </h5>
                                <h5 class="ml-auto">{{$boleta['nombre']}} {{$boleta['apellido']}}</h5>
                                </div>
                                <div class="d-flex flex-row">
                                    <h5 class="mr-auto font-weight-bold">Rut cliente: </h5>
                                    <h5 class="ml-auto">{{$boleta['rut']}}</h5>
                                </div>
                                <div class="d-flex flex-row">
                                    <h5 class="mr-auto font-weight-bold">N° de Orden: </h5>
                                    <h5 class="ml-auto">{{$boleta['num_orden']}}</h5>
                                </div>
                                <div class="d-flex flex-row">
                                    <h5 class="mr-auto font-weight-bold">Fecha emisión: </h5>
                                    <h5 class="ml-auto">{{$boleta['fecha']}}</h5>
                                </div>
                            </div>
                        </div>
                       
                    </div>
                    <div class="col-6">
                        <h3 class="text-center mb-3">---- Detalles Venta ----</h3>
                        <div class="row">
                            <div class="col-8 offset-2">
                                @foreach($boleta['detalleProd'] as $key2=>$detalle)

                                <div class="d-flex flex-row">
                                    <h5 class="mr-auto font-weight-bold">SKU: </h5>
                                    <h5 class="ml-auto">{{$detalle['SKU']}}</h5>
                                </div>
                                <div class="d-flex flex-row">
                                    <h5 class="mr-auto font-weight-bold">Nombre: </h5>
                                    <h5 class="ml-auto">{{$detalle['nombre']}}</h5>
                                </div>
                                <div class="d-flex flex-row">
                                    <h5 class="mr-auto font-weight-bold">Precio: </h5>
                                    <h5 class="ml-auto">${{$detalle['precio']}}</h5>
                                </div>
                                <div class="d-flex flex-row">
                                    <h5 class="mr-auto font-weight-bold">Cantidad: </h5>
                                    <h5 class="ml-auto">{{$detalle['cantidad']}} u.</h5>
                                </div>
                                <div class="d-flex flex-row">
                                    <h5 class="mr-auto font-weight-bold">IVA lote: </h5>
                                    <h5 class="ml-auto">${{$detalle['lote_iva']}}</h5>
                                </div>
                                <div class="d-flex flex-row">
                                    <h5 class="mr-auto font-weight-bold">Lote Neto: </h5>
                                    <h5 class="ml-auto">${{$detalle['lote_sin_iva']}}</h5>
                                </div>
                                <div class="d-flex flex-row">
                                    <h5 class="mr-auto font-weight-bold">Lote Bruto: </h5>
                                    <h5 class="ml-auto">${{$detalle['lote']}}</h5>
                                </div>
                                <hr>
                                @endforeach
                                <div class="d-flex flex-row justify-content-end">
                                    <h5 class="mr-3 font-weight-bold">Monto IVA: </h5>
                                    <h5 class="">${{$boleta['iva']}}</h5>
                                </div>
                                <div class="d-flex flex-row justify-content-end">
                                    <h5 class="mr-3 font-weight-bold">Monto Neto: </h5>
                                    <h5 class="">${{$boleta['monto_sin_iva']}}</h5>
                                </div>
                                <hr>
                                <div class="d-flex flex-row justify-content-end">
                                    <h5 class="mr-3 font-weight-bold">Monto Bruto: </h5>
                                    <h5 class="">${{$boleta['monto']}}</h5>
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