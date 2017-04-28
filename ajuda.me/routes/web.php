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

//Route::patch('/courses/{course_id}', 'CoursesController@update')
//    ->middleware('auth');
//Route::delete('/courses/{course_id}', 'CoursesController@destroy')
//    ->middleware('auth');

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


//Route::patch('/courses/{course_id}', 'CoursesController@update')
//    ->middleware('auth');
//Route::delete('/courses/{course_id}', 'CoursesController@destroy')
//    ->middleware('auth');

 Route::get('/tags', 'SubjectController@index')
    ->middleware('auth');
Route::get('/tags/create', 'SubjectController@create')
    ->middleware('auth'); 
Route::post('/tags', 'SubjectController@store')
    ->middleware('auth');     

Route::get('/users', 'UsersController@index')
    ->middleware('auth');

Route::get('/users/create/', 'UsersController@create')
    ->middleware('auth');

Route::post('/users', 'UsersController@store')
    ->middleware('auth');

Route::get('/users/{id}/edit', 'UsersController@edit')
    ->middleware('auth');

Route::put('/users/{id}', 'UsersController@update')
    ->middleware('auth');

Route::get('/users/{id}/delete', 'UsersController@destroy')
    ->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index');
