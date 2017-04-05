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

Route::get('/courses', 'CoursesController@index')
    ->middleware('auth');
Route::get('/courses/create', 'CoursesController@create')
    ->middleware('auth');
Route::post('/courses', 'CoursesController@store')
    ->middleware('auth');
Route::get('/courses/{course_id}', 'CoursesController@show')
    ->middleware('auth');
Route::get('/courses/{course_id}/edit', 'CoursesController@edit')
    ->middleware('auth');
//Route::patch('/courses/{course_id}', 'CoursesController@update')
//    ->middleware('auth');
//Route::delete('/courses/{course_id}', 'CoursesController@destroy')
//    ->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index');
