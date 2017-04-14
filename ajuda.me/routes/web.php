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

Route::get('/users', 'UsersController@index')
    ->middleware('auth');

Route::get('/users/create/', 'UsersController@create')
    ->middleware('auth');

Route::post('/users', 'UsersController@store')
    ->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index');
