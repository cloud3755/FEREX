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
Route::get('/productos/layout', 'productosController@crearDescargarLayoutExcelCargaMasiva');



//productos*******************************************

//---------------------------------------------------MODULO DE CLIENTES INICIO---------------------------------------------------------------------------------------------------------------------
Route::get('/AltaClientes', 'altaclientesController@index')->name('AltaClientes');
Route::post('/AltaCliente/nuevo', 'altaclientesController@nuevo');
//---------------------------------------------------MODULO DE CLIENTES FIN---------------------------------------------------------------------------------------------------------------------

//---------------------------------------------------MODULO DE SUCURSALES INICIO---------------------------------------------------------------------------------------------------------------------
Route::get('/sucursales', 'sucursalesController@index')->name('Sucurslaes');
Route::get('/sucursales/get', 'sucursalesController@getSucursales');
Route::post('/AltaCliente/nuevo', 'altaclientesController@nuevo');
//---------------------------------------------------MODULO DE SUCURSALES FIN---------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------MODULO DE DASHBOARD---------------------------------------------------------------------------------------------------------------------
Route::get('/Dashboard', 'DashboardController@index')->name('Dashboard');
//---------------------------------------------------MODULO DE DASHBOARD FIN---------------------------------------------------------------------------------------------------------------------

//punto de venta

Route::get('/venta', 'ventaController@index')->name('venta');
Route::post('/venta', 'ventaController@realizarVenta');
