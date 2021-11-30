@extends('layout')

@section('content')
@if(Session::get('success'))   
    <div class="mt-3 alert alert-success col-4">
        {{ Session::get('success') }}
    </div>
@endif
@if(Session::get('fail'))
    <div class="mt-3 col-4 alert alert-danger">
        {{ Session::get('fail') }}
    </div>
@endif
<?php 
    use App\Categorias;
    use App\Productos;
    if($prods){
        foreach($prods as $prod){
            $cat_aux = $prod->SKU;
            $id_cat = Productos::where('SKU',$cat_aux ?? '')->first()->id_cat;
            $cat = Categorias::where('id',$id_cat)->first()->nombre; 
        }
    }
    else{
        $cat = 0;
    }
?>
<hr>
<div class="row">

    <div class="col-12">
        <div class="row">
            <div class="col-5">
                <h1 class="mt-3 mb-4 ml-2">{{ucwords($cat ?? '')}}</h1>
            </div>
        </div>
    </div>

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
                        <h5 class="mt-4 font-weight-bold">${{$producto->precio}}</h5>
                    </div>
                    @if(Session::has('LoggedUser'))
                        @if(Session::get('type')=='admin' or Session::get('type')=='vendedor')
                        <a class="btn btn-gold mx-1" role="button" href="/productos/edit/{{$producto->SKU }}">
                        
                        <i class="fa fa-edit" aria-hidden="true"></i>
                        Editar
                        </a>
                        <a class="btn btn-danger mx-1" role="button" href="/borrarProducto/{{$producto->SKU}}">
                        
                        <i class="fa fa-trash" aria-hidden="true"></i>
                        Borrar
                        </a>
                        @else
                        <a class="card-link btn btn-gold" href="/addToCartLogin/{{ $producto->SKU }}/{{Session::get('LoggedUser')}}">
                        
                        <i class="fas fa-shopping-cart"></i>
                        Agregar al carro
                        </a>
                        @endif
                    @else
                    <a class="card-link btn btn-gold" href="/addToCart/{{ $producto->SKU }}">
                        
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