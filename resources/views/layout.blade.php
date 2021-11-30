<?php
session();
use App\Categorias;
use App\Clientes;
use App\Usuarios;
use Illuminate\Support\Facades\DB;
$categorias = Categorias::all();
if(Session::get('LoggedUser')){
    if(Session::get('type') == 'client'){
        $userInfo = DB::table('clientes')->where('id',Session::get('LoggedUser'))->first();
    }
    else{
        $userInfo = DB::table('usuarios')->where('id',Session::get('LoggedUser'))->first();
    }
}
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
                                <div class="dropdown-divider"></div>
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item"><a class="nav-link text-white" href="#">Ofertas</a></li>
                    <li class="nav-item"><a class=" text-white nav-link" href="#">Sobre nosotros</a></li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    @if(!Session::has('LoggedUser'))
                        <li class="nav-item"><a class="nav-link text-white" href="{{url('ingreso')}}">Ingresa</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ url('register') }}">Registrate</a></li> 
                        <a href="#" class="btn btn-danger" type="button"><i class=" mt-1 fas fa-shopping-cart"></i></a>                               
                    @endif
                    @if(Session::has('LoggedUser'))
                        @if(Session::get('type')=='admin' or Session::get('type')=='vendedor')
                        <!--- PEDIDOS --->
                        <li class="nav-item dropdown">
                            <button class="btn btn-success mr-2 my-sm-0" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pedidos</button>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="/confirmarPedidos">Confirmación de pedidos</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/retiroPedidos">Pedidos por retirar</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="/verBoletas">Historial ventas</a>
                            </div>                        
                        </li>
                        <!--- ADMINISTRAR --->
                        <li class="nav-item dropdown">
                        <button class="btn btn-success my-2 my-sm-0" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Administrar</button> 
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ url('/createProd') }}">Crear producto</a>
                                <!---<div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Crear oferta</a>
                                <a class="dropdown-item" href="#">Eliminar oferta</a>
                                <a class="dropdown-item" href="#">Editar oferta</a>--->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ url('/categorias/form/crear') }}">Crear categoria</a>
                               <!---<a class="dropdown-item" href="#">Eliminar categoria</a>--->
                                <a class="dropdown-item" href="/editCategoria">Editar categoria</a>
                            @if(Session::get('type')=='admin')
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('ingresoAdmin') }}">Crear usuarios</a>
                                <a class="dropdown-item" href="/eliminarUsuariosIndex">Eliminar usuarios</a>
                            </div>
                            @endif
                        </li> 
                        @endif
                        <!--- HELLO USER --->
                        <li class="nav-item dropdown">
                            <button class="btn btn-gold ml-2 mr-2" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo "Hola, ".ucwords($userInfo->nombre); ?>
                            <i class="ml-2 fa fa-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown2">
                                <a class="dropdown-item" href="/miperfil/<?php if(Session::get('type')=='admin' or Session::get('type')=='vendedor'){echo "updateAd";}else if(Session::get('type')=='client'){echo "update";} ?>/{{ Session::get('LoggedUser') }}">Ver Perfil <i class=" ml-2 fa fa-user-circle"></i> </a>
                                
                                @if(Session::get('type')=='client')
                                <a class="dropdown-item" href="/miperfil/mispedidos/{{Session::get('LoggedUser')}}">Ver pedidos <i class="ml-2 fas fa-clipboard"></i></a>
                                @endif
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}">Cerrar Sesión <i class="ml-2 fa fa-arrow-right" aria-hidden="true"></i> </a>
                            </div>
                        </li>
                    
                        @if(Session::get('type')=='client')

                        <a href="/showCarritoLogin/{{Session::get('LoggedUser')}}" class="btn btn-danger" type="button"><i class=" mt-1 fas fa-shopping-cart"></i></a>
                        
                        @endif
                        
                    @endif
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