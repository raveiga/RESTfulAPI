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
// Las rutas edit se utilizan para mostrar un formulario de edición.
// Las rutas de create se utilizan para mostrar un formulario de creación de datos.

// Añadimos un prefijo a la api: /api/v1.1/...
Route::group(array('prefix'=>'api/v1.1'),function()
{
	Route::resource('vehiculos','VehiculoController',['only'=>['index','show']]);
	Route::resource('fabricantes','FabricanteController',['except'=>['edit','create']]);
	Route::resource('fabricantes.vehiculos','FabricanteVehiculoController',['except'=>['show','edit','create']]);
});


// Mensaje para rutas inexistentes con una expresión regular.
// Patrón para la definición de ruta.
Route::pattern('inexistentes','.*');

Route::any('/{inexistentes}',function()
{
	// Código 400 de petición incorrecta.
	return response()->json(['mensaje'=>'Ruta o metodos inexistentes.','codigo'=>400],400);
});
