<?php
use App\Categorias;
$categorias = Categorias::all()
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset(mix('css/app.css')) }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css?v=').time()}}">

    
    <title>Document</title>
</head>
<body>
    <div id="app" class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-dark">
            <a class="navbar-brand" href="{{ url('/') }}">
                <img class="logo" src="{{asset('imagenes/logo.jpg')}}" alt="logo" id="logo">
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto text-white">
                    <li class="nav-item dropdown"> 
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categorias
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            @foreach($categorias as $categoria)
                                <a class="dropdown-item" href="/productos/cat/{{$categoria->id}}">{{ucfirst($categoria->nombre)}}</a>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Ofertas</a></li>
                    <li class="nav-item"><a class=" text-white nav-link" href="#">Sobre nosotros</a></li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                    <button class="btn btn-outline-success my-2 my-sm-0" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administrar</button> 
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('/createProd') }}">Crear producto</a>
                            <a class="dropdown-item" href="#">Eliminar producto</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Crear oferta</a>
                            <a class="dropdown-item" href="#">Eliminar oferta</a>
                            <a class="dropdown-item" href="#">Editar oferta</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ url('/categorias/form/crear') }}">Crear categoria</a>
                            <a class="dropdown-item" href="#">Eliminar categoria</a>
                            <a class="dropdown-item" href="#">Editar categoria</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#">Crear usuarios</a>
                            <a class="dropdown-item" href="#">Eliminar usuarios</a>
                        </div>
                    </li> 
                    <li class="nav-item"><a class="nav-link text-white" href="#">Ingresa</a></li>
                    <li class="nav-item"><a class="nav-link text-white" href="{{ url('/registro') }}">Registrate</a></li>                                
                </ul>
            </div>
        </nav>
    </div>
<div class="container">
    @yield('content')

</div>
<footer class="bg-dark text-center text-white">
        <div class="container p-4">
            <section class="mb-4">
                <a href="btn btn-circle.btn-sm btn-floating m-1" href="#" role="button">
                    <i class="fab fa-facebook-square"></i>
                </a>
                <a href="btn btn-outline-light btn-floating mx-4" href="#" role="button">
                    <i class="fab fa-google"></i>
                </a>
                <a href="btn btn-outline-light btn-floating m-1" href="#" role="button">
                    <i class="fab fa-instagram-square"></i>
                </a>
            </section>
        </div>
    </footer>
</body>
<script type="text/javascript" src="{{asset(mix('js/app.js'))}}"></script>
</html>