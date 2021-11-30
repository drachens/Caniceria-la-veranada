@extends('layout')

@section('content')
<?php
    $monto = 0;
    foreach ($ordenFinal as $key => $value) {
        $num_orden = $value['num_orden'];
        $monto = $monto + $value['precio_lote'];
        $nombre = $value['nombre_cliente'];
        $apellido = $value['apellido'];
        $telefono = $value['telefono'];
    }
?>
<div class="row mt-4 mb-4">
    <div class="col-8 col-lg-8 col-sm-12 offset-2 offset-lg-2">
        <div class="card text-white bg-dark">
            <div class="card-header text-center">
                <div class="row">
                    <div class="col-12">
                        <h3>Detalle de Orden N°{{$num_orden}}</h3>
                    </div>
                    <div class="col-6">
                        <h5>Cliente: {{$nombre}} {{$apellido}}</h5>
                    </div>
                    <div class="col-6">
                        <h5>Teléfono: {{$telefono}}</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
            @foreach($ordenFinal as $key=>$orden)
                <hr style="border-top:2px dashed white;">
                <div class="row  align-self-center justify-content-center text-center">
                    <div class="col  align-self-center justify-content-center">
                        <div class="d-flex flex-row">
                            <h5 class="mr-auto">Nombre:</h5>
                            <h5 class="ml-auto">{{ucwords($orden['nombre'])}}.</h5>
                        </div>
                        <div class="d-flex flex-row">
                            <h5 class="mr-auto">Precio:</h5>
                            <h5 class="ml-auto text-success">${{$orden['precio']}}</h5>                        
                        </div>
                        <br>
                        <div class="d-flex flex-row">
                            <h5 class="mr-auto">Cantidad:</h5>
                            <h5 class="ml-auto">{{$orden['cantidad']}} u.</h5>                        
                        </div>
                        <div class="d-flex flex-row">
                            <h5 class="mr-auto">Precio Lote:</h5>
                            <h5 class="ml-auto text-success">${{$orden['precio_lote']}}</h5>                        
                        </div>
                    </div>
                    <div class="col text-center mt-3">
                        <img src="{{ asset($orden['imagen']) }}" style="width:150px;height:150px;display:block;margin:auto " alt="">
                        <h6 class="mt-1">SKU: {{$orden['SKU']}}</h6>
                    </div>
                </div>
                <hr style="border-top:2px dashed white;">
                <br>
            @endforeach
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="text-center col-12 mt-3">
                        <div class="d-flex flex-row justify-content-center">
                            <h3>Monto: </h3>
                            <h3 class="ml-3 text-success">${{$monto}}</h3>
                        </div>
                    </div>
                    
                    <div class="col-6 mt-5">
                        <div class="row">
                            <div class="col-10">
                                <button class="btn btn-lg btn-block btn-primary" onclick="retroceder()">Atras</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mt-5">
                        <div class="row">
                            <div class="ml-auto col-12">
                                <div class="row">
                                    <div class="col-6">
                                        <a href="/confirmarPedidos/Confirmar/{{$num_orden}}"><button class="btn btn-block btn-lg btn-success">Confirmar</button></a>
                                    </div>
                                    <div class="col-6">
                                        <a href="/confirmarPedidos/Rechazar/{{$num_orden}}"><button class="btn btn-block btn-lg btn-danger">Rechazar</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<hr>



<hr>

<script type="text/javascript">
   function retroceder(){
        window.history.back();
    }
</script>
@endsection