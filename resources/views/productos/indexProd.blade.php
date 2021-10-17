@extends('layout')

@section('content')
    <div class="d-inline-flex text-center col-12 my-4">
        <div class="d-flex justify-content-center align-items-start flex-wrap col-12">
            @foreach($prods as $producto)
            <div class="flex-item col-3 border rounded mr-3 mb-3">
                <div class="py-4">
                    <img class="img-producto" src="{{ asset($producto->path) }}" alt="">
                    <div class="text-center mt-3">
                        <div class="col-12">
                            <h4>{{ ucfirst($producto->nombre) }}</h4>
                            <h4>
                            <?php
                            if ($producto->peso) {
                                if (intval($producto->peso)>=1000) {
                                    $peso = round(intval($producto->peso)/1000,1);
                                    echo $peso." Kg";
                                }
                                else{
                                    echo $producto->peso." g";
                                }
                            } 
                            else{
                                if (intval($producto->cantidad) == 1) {
                                    echo $producto->cantidad." unidad";
                                }
                                else{
                                    echo $producto->cantidad." unidades";
                                }
                            } ?>
                            </h4>
                            
                        </div>
                        <div class="col-12">
                            <h5>${{$producto->precio}}</h5>
                        </div>
                        <div class="col-12">
                            SKU:{{ $producto->SKU }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>

@endsection