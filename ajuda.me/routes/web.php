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

Route::get('/monitorings', 'MonitoringsController@index')
    ->middleware('auth');
Route::get('/monitorings/create', 'MonitoringsController@create')
    ->middleware('auth');
Route::post('/monitorings', 'MonitoringsController@store')
    ->middleware('auth');
Route::get('/monitorings/{monitoring_id}', 'MonitoringsController@show')
    ->middleware('auth');
//Route::edit('/monitorings/{monitoring_id}', 'MonitoringsController@edit')
//    ->middleware('auth');
//Route::update('/monitorings/{monitoring_id}', 'MonitoringsController@update')
//    ->middleware('auth');
//Route::delete('/monitorings/{monitoring_id}', 'MonitoringsController@destroy')
//    ->middleware('auth');

Route::get('/monitors', 'MonitorsController@index')
    ->middleware('auth');
Route::get('/monitors/{MonitorId}', 'MonitorsController@show')
    ->middleware('auth');


Auth::routes();

Route::get('/home', 'HomeController@index');
