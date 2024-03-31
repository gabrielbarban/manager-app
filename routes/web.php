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


Route::get('/login', 'App\Http\Controllers\AuthController@index');
Route::get('/logout', 'App\Http\Controllers\AuthController@logout');
Route::post('/authentication', 'App\Http\Controllers\AuthController@login');
Route::get('/painel', 'App\Http\Controllers\PainelController@index');
Route::get('/receitas', 'App\Http\Controllers\ReceitasController@index');
Route::get('/despesas', 'App\Http\Controllers\DespesasController@index');

Route::get('/usuarios', 'App\Http\Controllers\UsuarioController@index');
Route::get('/usuario/novo', 'App\Http\Controllers\UsuarioController@novo');
Route::get('/usuario/{id}', 'App\Http\Controllers\UsuarioController@get');
Route::post('/usuario/save', 'App\Http\Controllers\UsuarioController@save');

Route::get('/empresas', 'App\Http\Controllers\EmpresaController@index');
Route::get('/empresa/novo', 'App\Http\Controllers\EmpresaController@novo');
Route::get('/empresa/{id}', 'App\Http\Controllers\EmpresaController@get');
Route::post('/empresa/save', 'App\Http\Controllers\EmpresaController@save');

Route::get('/categorias', 'App\Http\Controllers\CategoriaController@index');
Route::get('/categoria/novo', 'App\Http\Controllers\CategoriaController@novo');
Route::get('/categoria/{id}', 'App\Http\Controllers\CategoriaController@get');
Route::post('/categoria/save', 'App\Http\Controllers\CategoriaController@save');