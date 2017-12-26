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

Route::group(['prefix' => 'admin'], function()
{
	Route::get('/', 'AdminController@index')->middleware('auth');
	Route::get('/categoria', 'AdminController@categoria')->middleware('auth');
	Route::get('/asignarCategoria', 'AdminController@asignarCategoria')->middleware('auth');
	Route::get('/calificarCategoria', 'AdminController@calificarCategoria')->middleware('auth');

	Route::get('/mostrarTablaCategoria', 'AdminController@mostrarTablaCategoria')->middleware('auth');
	Route::get('/mostrarActualizarCategoria', 'AdminController@mostrarActualizarCategoria')->middleware('auth');
	Route::get('/mostrarTablaUsuarios', 'AdminController@mostrarTablaUsuarios')->middleware('auth');
	Route::get('/mostrarTablaUsuariosCalificar', 'AdminController@mostrarTablaUsuariosCalificar')->middleware('auth');

	Route::post('/crearCategoria', 'AdminController@crearCategoria')->middleware('auth');
	Route::post('/actualizarCategoria', 'AdminController@actualizarCategoria')->middleware('auth');
	Route::post('/eliminarCategoria', 'AdminController@eliminarCategoria')->middleware('auth');
	Route::post('/asignarUsuario', 'AdminController@asignarUsuario')->middleware('auth');
	Route::post('/desasignarUsuario', 'AdminController@desasignarUsuario')->middleware('auth');
	Route::post('/calificar', 'AdminController@calificar')->middleware('auth');

	Route::post('/idCategoria', 'AdminController@idCategoria');
});

Route::group(['prefix' => 'user'], function()
{
	Route::get('/', 'UserController@index')->middleware('auth');
	Route::get('/calificacion', 'UserController@calificacion')->middleware('auth');

	Route::get('/mostrarTablaCalificacion', 'UserController@mostrarTablaCalificacion')->middleware('auth');
});
