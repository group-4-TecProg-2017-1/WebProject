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
})->middleware('auth');

Route::get('/courses', function () {
    $courses = DB::table('courses')->orderBy('id', 'asc')->get();
    return view('courses.index', compact('courses'));
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index');
