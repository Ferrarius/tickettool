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

Route::get('/', 'TicketController@index');

Auth::routes();

Route::get('/home', 'TicketController@index');
Route::get('/tickets/{id}', 'TicketController@show');
Route::post('/tickets/store', 'TicketController@store');
Route::post('/tickets/{id}/update', 'TicketController@update');
Route::post('/tickets/{id}/new-action', 'TicketActionController@store');