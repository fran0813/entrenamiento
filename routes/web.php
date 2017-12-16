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

	Route::get('/mostrarTablaCategoria', 'AdminController@mostrarTablaCategoria');
	Route::get('/mostrarActualizarCategoria', 'AdminController@mostrarActualizarCategoria');
	Route::get('/mostrarTablaUsuarios', 'AdminController@mostrarTablaUsuarios');

	Route::post('/crearCategoria', 'AdminController@crearCategoria');
	Route::post('/actualizarCategoria', 'AdminController@actualizarCategoria');
	Route::post('/eliminarCategoria', 'AdminController@eliminarCategoria');
	Route::post('/asignarUsuario', 'AdminController@asignarUsuario');
	Route::post('/desasignarUsuario', 'AdminController@desasignarUsuario');

	Route::post('/idCategoria', 'AdminController@idCategoria');
});

Route::group(['prefix' => '/user'], function()
{
	Route::get('/', 'UserController@index');
});
