@extends('layout')

<?php
    use App\Categorias;
    use App\Productos;
    use App\Imagenes;
    use Illuminate\Support\Facades\DB;
    $productos = Productos::all();

?>

@section('content')
@if(Session::get('success'))   
    <div class="mt-3 alert alert-success col-4">
        {{ Session::get('success') }}
    </div>
@endif
<hr>
<div class="row">
    <div class="col-12">
        <div class="row">
            <div class="col-4">
                <h1 class="">Todos los Productos</h1>
            </div>
        </div>
    </div>
    @foreach($productos as $producto)
    <?php
        $imagen = Imagenes::where('id_prod',$producto->SKU)->first();
        $path = $imagen->path;

        $categoria = Categorias::where('id',$producto->id_cat)->first()->nombre;
    ?>
    <div class="col-12 col-sm-8 col-md-6 col-lg-4 mb-4 mt-1">
        <div class="card text-white bg-dark text-center">
            <img class="card-img-top mt-3" src="{{ asset($path) }}" style="width:300px;height:300px;display:block;margin:auto " alt="">
            <div class="card-img-overlay d-flex justify-content-end mr-2 mt-2" style="height:20px;width:95%">
                <a class="card-link text-danger like mb-auto" href="#">
                    <i class="fas fa-heart"></i>
                </a>
            </div>
            <div class="card-body text-left">
                <h4 class="card-title text-white font-weight-bold">{{ ucfirst($producto->nombre) }}</h4>
                <h6 class="card-subtitle mb-2 text-gold text-muted">SKU: {{ $producto->SKU }}</h6>
                <h6 class="card-subtitle mt-2 mb-3 text-muted">Categoria: {{ucwords($categoria)}}</h6>
                <p class="card-text text-white">
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
                <p class="card-text"></p>
                <hr style="height:1px;border-width:1px;color:red;background-color:grey">
                <div class="buy d-flex align-items-center">
                    <div class="price text-success flex-item" style="margin-right:auto">
                        <h5 class="mt-4 font-weight-bold">${{$producto->precio}}</h5>
                    </div>
                    @if(Session::has('LoggedUser'))
                    <a class="card-link btn btn-gold" href="/addToCartLogin/{{ $producto->SKU }}/{{Session::get('LoggedUser')}}">
                        
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