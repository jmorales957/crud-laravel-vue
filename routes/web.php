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

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('prospectos', 'ProspectosController');

Route::resource('llamadas', 'LlamadasController');
Route::get('llamadas/registro/{id}','LlamadasController@registro');

Route::get('reuniones/registro/{id}','ReunionesController@registro');
Route::resource('reuniones', 'ReunionesController');



