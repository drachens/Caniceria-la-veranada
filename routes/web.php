<?php

use App\Http\Controllers\CategoriasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ProductosController;

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
//Categorias
Route::get('/categorias/form/crear',[CategoriasController::class,'create']);
Route::post('/crearCategoria',[CategoriasController::class,'store']);

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



Route::view('register2','auth.register');
Route::view('/','home')->name('home');
Route::view('ofertas','ofertas')->name('ofertas');
Route::get('nav',function(){
    return view('nav',['cat'=>['ola','chao']]);
});
