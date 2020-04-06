<?php


use Illuminate\Support\Facades\Route;
//Metodos get

Route::get('/dasboard', 'DasboardController@index')->name('dasboard');
Route::resource('/acceso', 'AccesoController');
Route::get('/getPuestos','AccesoController@getPuestos');
Route::get('/getSucursales','AccesoController@getSucursales');



Route::resource('/configuracion', 'ConfiguracionController');
Route::resource('/asignacion', 'AsignacionController');
Route::get('/getUsuarios', 'AsignacionController@getUsuarios');

Route::get('/getEquipos', 'AsignacionController@getEquipos');

Route::resource('/equipo', 'EquipoController');

Route::get('/', 'Auth\LoginController@showLoginForm')->name('/');


//Metodos post
Route::post('/login','Auth\LoginController@login')->name('login');

Route::post('/logout','Auth\LoginController@logout')->name('logout');

