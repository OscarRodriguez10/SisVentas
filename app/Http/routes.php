<?php

Route::get('/', function () {
   return view('auth/login');
});


Route::Auth();

Route::group(['middleware' => 'guest'], function () {

	Route::get('login', 'Auth\AuthController@getLogin');
	
});


// rutas para administrador 

Route::group(['middleware' => 'auth'], function () 
{

Route::get('/home', 'HomeController@index');

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
Route::resource('seguridad/tipousuario','TipoUsuarioController');
Route::resource('movimientos/traslados','TrasladosController');
Route::resource('administracion/sucursales','SucursalesController');
Route::resource('administracion/empleados','EmpleadosController');
Route::get('ventas/create/{id_sucursal}', 'VentaController@create');
Route::get('compras/create/{id_sucursal}', 'IngresoController@create');
Route::get('movimientos/create/{id_sucursal}', 'TrasladosController@create');
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

});

Route::group(['middleware'=> 'usuarioadmin'],function()
{
Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/articulo','ArticuloController');
Route::resource('almacen/proveedores','ProveedoresController');
Route::resource('almacen/inventarios','InventariosController'); 
Route::resource('seguridad/usuario','UsuarioController');
Route::resource('seguridad/tipousuario','TipoUsuarioController');
Route::resource('administracion/sucursales','SucursalesController');
Route::resource('administracion/empleados','EmpleadosController');



});

Route::group(['middleware'=> 'usuariocajero'], function()
{
Route::resource('almacen/categoria','CategoriaController');
Route::resource('almacen/articulo','ArticuloController');
Route::resource('almacen/proveedores','ProveedoresController');
Route::resource('almacen/inventarios','InventariosController'); 
Route::resource('seguridad/usuario','UsuarioController');
Route::resource('seguridad/tipousuario','TipoUsuarioController');
Route::resource('administracion/sucursales','SucursalesController');
Route::resource('administracion/empleados','EmpleadosController');
Route::resource('compras/ingreso','IngresoController');
});


