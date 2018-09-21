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
 Route::get('/impresionprueba', 'productosController@prueba');
Route::group( ['middleware' => ['auth']],
function()
{
       
        //productos*******************************************

        Route::get('/productos', 'productosController@index')->name('productos');
        Route::get('/productos/get', 'productosController@getProductos');
        Route::get('/productos/get/{id}', 'productosController@get');
        Route::post('/productos/nuevo', 'productosController@nuevo');
        Route::post('/productos/editar', 'productosController@editar');
        Route::post('/productos/cambioEstatus', 'productosController@cambioEstatus');
        Route::get('/productos/layout', 'productosController@crearDescargarLayoutExcelCargaMasiva');
        Route::post('/productos/cargaMasiva', 'productosController@masiveUpload');



        //productos*******************************************

        //---------------------------------------------------MODULO DE Cajas INICIO---------------------------------------------------------------------------------------------------------------------

        Route::get('/cajas', 'cajaController@index')->name('cajas');
        Route::get('/cajas/historial', 'cajaController@historial');
        Route::post('/cajas/cambioStatus', 'cajaController@cambioEstadoCaja');

        //---------------------------------------------------MODULO DE Cajas FIN---------------------------------------------------------------------------------------------------------------------


        //---------------------------------------------------MODULO DE Inventario INICIO---------------------------------------------------------------------------------------------------------------------


        Route::get('/inventario/manual', 'inventarioController@indexManual');
        Route::post('/inventario/manual', 'inventarioController@manual');
        //---------------------------------------------------MODULO DE Inventario INICIO---------------------------------------------------------------------------------------------------------------------



        //---------------------------------------------------MODULO DE CLIENTES INICIO---------------------------------------------------------------------------------------------------------------------
        Route::get('/AltaClientes', 'altaclientesController@index')->name('AltaClientes');
        Route::post('/AltaCliente/nuevo', 'altaclientesController@nuevo');
        //---------------------------------------------------MODULO DE CLIENTES FIN---------------------------------------------------------------------------------------------------------------------

        //---------------------------------------------------MODULO DE SUCURSALES INICIO---------------------------------------------------------------------------------------------------------------------
        Route::get('/sucursales', 'sucursalesController@index')->name('Sucurslaes');
        Route::get('/sucursales/get', 'sucursalesController@getSucursales');

        Route::post('/sucursales/nuevo', 'sucursalesController@nueva');

        

        //---------------------------------------------------MODULO DE SUCURSALES FIN---------------------------------------------------------------------------------------------------------------------
        //---------------------------------------------------MODULO DE DASHBOARD---------------------------------------------------------------------------------------------------------------------
        Route::get('/Dashboard', 'DashboardController@index')->name('Dashboard');
        //---------------------------------------------------MODULO DE DASHBOARD FIN---------------------------------------------------------------------------------------------------------------------

        //punto de venta

        Route::get('/venta', 'ventaController@index')->name('venta');
    Route::get('/venta/historial', 'ventaController@historial')->name('ventaHistorial');
        Route::post('/venta', 'ventaController@realizarVenta');

        //punto de venta

        //ciudades
        Route::get('/estados', 'ciudadesController@estados');
        Route::get('/municipios/{idEstado}', 'ciudadesController@municipiosEstado');
        //ciudades

        //----------------------------------------------------alta de vendedores ------------------------------------------------------------------------------------------------------------------------
        Route::get('register', 'vendedoresController@showRegistrationForm')->name('register');
        Route::post('register', 'vendedoresController@register1');

    }
);
