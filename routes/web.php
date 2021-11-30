<?php

use App\Http\Controllers\CategoriasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProductosController;
use App\Http\Controllers\ProcarritosController;
use App\Http\Controllers\CarritosController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\OrdenCompraController;
use App\Http\Controllers\Compra;
use App\Http\Controllers\DetalleOrdenController;
use App\Http\Controllers\BoletaController;
use App\Http\Controllers\UsuariosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Productos
Route::get('/createProd',[ProductosController::class,'create']);
Route::post('/storageProd',[ProductosController::class,'store']);
Route::get('/productos/cat/{id}',[ProductosController::class,'index']);
Route::get('/productos/edit/{id}',[ProductosController::class,'editar']);
Route::post('/updateProd',[ProductosController::class,'update']);
Route::get('/borrarProducto/{SKU}',[ProductosController::class,'destroy']);
//Carrito
Route::get('/addToCart/{id}',[ProductosController::class,'addCart']);

Route::get('/addToCartLogin/{idProd}/{user}',[ProcarritosController::class,'store']);
Route::get('/showCarritoLogin/{user}',[CarritosController::class,'index']);
Route::post('updateCarritoLogin',[ProcarritosController::class,'update']);
Route::post('deleteCarritoLogin',[ProcarritosController::class,'delete']);
//Compra
Route::post('crearOrden',[Compra::class,'create']);

//Orden_Compra


//Categorias
Route::get('/categorias/form/crear',[CategoriasController::class,'create']);
Route::post('/crearCategoria',[CategoriasController::class,'store']);
Route::get('/editCategoria',[CategoriasController::class,'indexEditCat']);
Route::post('editCat',[CategoriasController::class,'editCat']);
//------------CLIENTES-----------------//
//Registro Clientes
Route::get('register',[ClientesController::class,'create']);
Route::post('registroCrearCliente','ClientesController@store')->name('registroCrearCliente');
Route::get('/miperfil/update/{id}',[ClientesController::class,'editar']);
Route::post('updateCliente',[ClientesController::class,'update']);
//Login Clientes
Route::get('ingreso','ClientesController@index')->name('ingreso');
Route::post('login','Auth\LoginController@login')->name('login');
Route::get('logout','Auth\LoginController@logout')->name('logout');
//Registro Usuarios(admin y vendedor)
Route::get('ingresoAdmin','UsuariosController@create')->name('ingresoAdmin');
Route::post('registroAdmin','UsuariosController@store')->name('registroAdmin');
//Pedidos clientes
Route::get('/miperfil/mispedidos/{id}',[OrdenCompraController::class, 'indexMisPedidos']);
Route::get('/confirmarPedidos',[OrdenCompraController::class,'indexPedidosConfirmacion']);
Route::get('/retiroPedidos',[OrdenCompraController::class,'indexRetiroPedidos']);
Route::get('/confirmarPedidos/Confirmar/{numero}',[OrdenCompraController::class,'confirmarPedido']);
Route::get('/confirmarPedidos/Rechazar/{numero}',[OrdenCompraController::class,'rechazarPedido']);
//Detalle pedido cliente
Route::get('/mispedidos/detalle/{numero}',[DetalleOrdenController::class,'indexDetalleOrden']);
Route::get('/detallePedidoAdmin/{numero}',[DetalleOrdenController::class,'indexDetalleOrdenAdmin']);
//Boleta
Route::get('/generarBoleta/{numero}',[BoletaController::class,'crearBoleta']);
Route::get('/verBoletas',[BoletaController::class,'indexBoletas']);
//MODO ADMIN
Route::get('/eliminarUsuariosIndex',[UsuariosController::class,'usuariosIndex']);
Route::post('deleteUser',[UsuariosController::class,'eliminarUser']);
Route::view('register2','auth.register');
Route::view('/','home')->name('home');
Route::view('ofertas','ofertas')->name('ofertas');
Route::get('nav',function(){
    return view('nav',['cat'=>['ola','chao']]);
});
