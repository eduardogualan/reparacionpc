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

Route::get('/', 'Admin@login');
Route::resource('login', 'LoginController');
Route::resource('salir', 'LoginController@salir');
Route::get('/home', 'Admin@PaginaPrincipal');
Route::resource('marca', 'MarcaController');
Route::post('buscarmarca', 'MarcaController@Buscar');
Route::resource('equipo', 'EquipoController');
Route::post('buscarequipo', 'EquipoController@Buscar');
Route::resource('modelo', 'ModeloController');
Route::post('buscarmodelo', 'ModeloController@Buscar');
Route::resource('servicio','ServicioController');
Route::post('buscarservicio', 'ServicioController@Buscar');
Route::resource('usuario','UserController');
Route::post('buscarusuario', 'UserController@Buscar');
Route::resource('cliente','PersonaController');
Route::post('buscarcliente', 'PersonaController@Buscar');
Route::post('cargarcliente', 'PersonaController@CargarCliente');
Route::post('buscarcedula', 'PersonaController@Buscarcedula');
Route::post('cargarmodeloplan', 'PersonaController@ObtenerModeloXMarca');
Route::post('numerodemaquinastecnicos', 'PersonaController@NumerodeMaquinasTecnicos');
Route::resource('orden','OrdenController');
Route::post('buscarorden', 'OrdenController@Buscar');

