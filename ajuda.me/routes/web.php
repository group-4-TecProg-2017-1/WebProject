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
Route::get('/monitorings', 'MonitoringsController@index')
    ->middleware('auth');
Route::get('/monitorings/create', 'MonitoringsController@create')
    ->middleware('auth');
Route::get('/monitors', 'MonitorsController@create')
    ->middleware('auth');
//Route::patch('/courses/{course_id}', 'CoursesController@update')
//    ->middleware('auth');
//Route::delete('/courses/{course_id}', 'CoursesController@destroy')
//    ->middleware('auth');
Route::get('login/facebook', 'auth\FacebookController@redirectToProvider')->name('facebook.login');

Route::get('auth/facebook/callback', 'auth\FacebookController@handleProviderCallback');


Auth::routes();

Route::get('/home', 'HomeController@index');
