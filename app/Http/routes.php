<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('auth/login');
});


Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/articulo','ArticuloController');
Route::resource('almacen/proveedores','ProveedoresController');
Route::resource('almacen/inventarios','InventariosController');
Route::resource('ventas/cliente','ClienteController');
Route::resource('compras/ingreso','IngresoController');
Route::resource('ventas/venta','VentaController');
Route::resource('consulta/local','ConsultaLocalController');
Route::resource('consulta/sucursales','ConsultaSucursalesController');
Route::resource('seguridad/usuario','UsuarioController');
Route::resource('movimientos/traslados','TrasladosController');
Route::resource('administracion/sucursales','SucursalesController');
Route::resource('administracion/empleados','EmpleadosController');


Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('ventas/create/{id_sucursal}', 'VentaController@create');
Route::get('compras/create/{id_sucursal}', 'IngresoController@create');
Route::get('movimientos/create/{id_sucursal}', 'TrasladosController@create');

//Reportes
Route::get('reportecategorias', 'CategoriaController@reporte');
Route::get('reportesucursales', 'SucursalesController@reporte');
Route::get('reportearticulos', 'ArticuloController@reporte');
Route::get('reporteclientes', 'ClienteController@reporte');
Route::get('reporteproveedores', 'ProveedoresController@reporte');
Route::get('reporteventas', 'VentaController@reporte');
Route::get('reporteventa/{id}', 'VentaController@reportec');
Route::get('reporteingresos', 'IngresoController@reporte'); 
Route::get('reporteingreso/{id}', 'IngresoController@reportec'); 
Route::get('reporteTraslados/{id}', 'TrasladosController@reportec'); 

Route::get('/{slug?}', 'HomeController@index');
