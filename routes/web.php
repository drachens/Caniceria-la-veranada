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

Route::get('/createProd',[ProductosController::class,'create']);
Route::post('/storageProd',[ProductosController::class,'store']);
Route::get('/productos/cat/{id}',[ProductosController::class,'index']);

Route::get('/categorias/form/crear',[CategoriasController::class,'create']);
Route::post('/crearCategoria',[CategoriasController::class,'store']);

//Registro Clientes
Route::get('/registro',[ClientesController::class,'create']);
Route::post('/registroCrearCliente',[ClientesController::class,'store']);

Route::view('/','home')->name('home');
Route::view('ofertas','ofertas')->name('ofertas');
Route::get('nav',function(){
    return view('nav',['cat'=>['ola','chao']]);
});
