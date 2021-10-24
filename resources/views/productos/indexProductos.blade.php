@extends('layout')

@section('content')
<hr>
<div class="row">
    @foreach($prods as $producto)
    <div class="col-12 col-sm-8 col-md-6 col-lg-4 mb-4 mt-1">
        <div class="card text-white bg-dark text-center">
            <img class="card-img-top mt-3" src="{{ asset($producto->path) }}" style="width:300px;height:300px;display:block;margin:auto " alt="">
            <div class="card-img-overlay d-flex justify-content-end mr-2 mt-2" style="height:20px;width:95%">
                <a class="card-link text-danger like mb-auto" href="#">
                    <i class="fas fa-heart"></i>
                </a>
            </div>
            <div class="card-body text-left">
                <h4 class="card-title">{{ ucfirst($producto->nombre) }}</h4>
                <h6 class="card-subtitle mb-2 text-muted">SKU: {{ $producto->SKU }}</h6>
                <p class="card-text">
                <?php
                    if ($producto->peso) {
                        if (intval($producto->peso)>=1000) {
                            $peso = round(intval($producto->peso)/1000,1);
                            echo "Peso: ".$peso." Kg";
                        }
                        else{
                            echo "Peso: ".$producto->peso." g";
                        }
                    } 
                    else{
                        if (intval($producto->cantidad) == 1) {
                            echo "Cantidad: ".$producto->cantidad." unidad";
                        }
                        else{
                            echo "Cantidad: ".$producto->cantidad." unidades";
                        }
                    } ?>
                </p>
                <p class="card-text">{{ $producto->descri }}</p>
                <hr style="height:1px;border-width:1px;color:red;background-color:grey">
                <div class="buy d-flex align-items-center">
                    <div class="price text-success flex-item" style="margin-right:auto">
                        <h5 class="mt-4">${{$producto->precio}}</h5>
                    </div>
                    @if(Session::has('LoggedUser'))
                        @if(Session::get('type')=='admin' or Session::get('type')=='vendedor')
                        <a class="btn btn-success mx-1" role="button" href="/productos/edit/{{$producto->SKU }}">
                        
                        <i class="fa fa-edit" aria-hidden="true"></i>
                        Editar
                        </a>
                        <a class="btn btn-danger mx-1" role="button" href="#">
                        
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        Borrar
                        </a>
                        @else
                        <a class="card-link btn btn-danger" href="#">
                        
                        <i class="fas fa-shopping-cart"></i>
                        Agregar al carro
                        </a>
                        @endif
                    @else
                    <a class="card-link btn btn-danger" href="#">
                        
                            <i class="fas fa-shopping-cart"></i>
                            Agregar al carro
                    </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<hr>
@endsection