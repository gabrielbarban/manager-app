<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/test-database-connection', 'App\Http\Controllers\TestController@testDatabaseConnection');
Route::get('/painel', 'App\Http\Controllers\PainelController@index');
Route::get('/receitas', 'App\Http\Controllers\ReceitasController@index');
Route::get('/despesas', 'App\Http\Controllers\DespesasController@index');
