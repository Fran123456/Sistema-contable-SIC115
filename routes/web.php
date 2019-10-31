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
Route::resource('Registro','Registro\RegistroController');
Route::get('registros_fecha','Registro\RegistroController@registros_fecha' )->name('registros_fecha');

Route::resource('Cuenta','Cuenta\CuentaController');