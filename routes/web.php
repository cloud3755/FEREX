<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

//productos*******************************************

Route::get('/productos', 'productosController@index')->name('productos');
Route::get('/productos/get', 'productosController@getProductos');
Route::get('/productos/get/{id}', 'productosController@get');
Route::post('/productos/nuevo', 'productosController@nuevo');
Route::post('/productos/editar', 'productosController@editar');
Route::post('/productos/cambioEstatus', 'productosController@cambioEstatus');

//productos*******************************************

//---------------------------------------------------MODULO DE CLIENTES INICIO---------------------------------------------------------------------------------------------------------------------
Route::get('/AltaClientes', 'altaclientesController@index')->name('AltaClientes');
Route::post('/AltaCliente/nuevo', 'altaclientesController@nuevo');
//---------------------------------------------------MODULO DE CLIENTES FIN---------------------------------------------------------------------------------------------------------------------
