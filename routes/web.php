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
    //return view('welcome');
    return redirect()->route('login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('Registro','Registro\RegistroController');
Route::get('registros_fecha','Registro\RegistroController@registros_fecha' )->name('registros_fecha');

Route::resource('Cuenta','Cuenta\CuentaController');

Route::get('Finalizar-mes', 'Registro\RegistroController@finalizar_mes')->name('RegistroFinalizar');
Route::get('finalizarMesContable/{id}', 'Registro\RegistroController@finalizarMesContable')->name('finalizarMesContable');


Route::get('balance-Comprobacion/{id}', 'Balance\BalanceController@balance_comprobacion')->name('balanceComprobacion');
Route::get('cuenta_otro_balance_comp', 'Balance\BalanceController@cuenta_otro_balance_comp')->name('cuenta_otro_balance_comp');

Route::resource('Usuarios','User\UserController');
Route::get('ajax-obtener-cuentas', 'Registro\RegistroController@ajax_obtener_cuentas')->name('ajax_obtener_cuentas');

//Route::get('ajax-obtener-cuentas', 'Balance\BalanceController@seleccion_cuentas_view')->name('ajax_obtener_cuentas');

