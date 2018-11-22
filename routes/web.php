<?php

// use SoapClient;

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

Route::get('/', 'TransactionController@formulario');
Route::post('/2', 'TransactionController@segVista');
Route::get('/3', 'TransactionController@reingreso');
