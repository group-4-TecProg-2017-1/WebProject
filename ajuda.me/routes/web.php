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
    return view('home');
})->middleware('auth');

Route::get('/locations', 'LocationsController@index')
    ->middleware('auth');

Route::get('/locations/create', 'LocationsController@create')
    ->middleware('auth');

Route::post('/locations', 'LocationsController@store')
    ->middleware('auth');

Route::get('/locations/{location_id}', 'LocationsController@show')
    ->middleware('auth');

Route::get('/locations/{location_id}/edit', 'LocationsController@edit')
    ->middleware('auth');

Route::put('/locations/{location_id}', 'LocationsController@update')
    ->middleware('auth');

Route::get('/locations/{locations_id}/delete', 'LocationsController@destroy')
    ->middleware('auth');

Route::get('/monitorings/create', 'MonitoringsController@createOptionView')
    ->middleware('auth');

Route::post('/monitorings', 'MonitoringsController@store')
    ->middleware('auth');

Route::get('/monitorings/{id}/delete', 'MonitoringsController@destroy')
    ->middleware('auth');

Route::get('/monitorings/{id}/edit', 'MonitoringsController@edit')
    ->middleware('auth');

Route::put('/monitorings/{id}', 'MonitoringsController@update')
    ->middleware('auth');

Route::get('/monitorings/{id}/details', 'MonitoringsController@details')
    ->middleware('auth');

Route::get('/courses', 'CoursesController@index')
    ->middleware('auth');

Route::get('/courses/create', 'CoursesController@createCourseView')
    ->middleware('auth');

Route::post('/courses', 'CoursesController@storeCourseOnDatabase')
    ->middleware('auth');

Route::get('/courses/{course_id}', 'CoursesController@show')
    ->middleware('auth');

Route::get('/courses/{course_id}/edit', 'CoursesController@edit')
    ->middleware('auth');

Route::get('/course/{course_id}','CoursesController@delete');

Route::get('/courses/edit/{course_id}','CoursesController@editCourse');

Route::get('/courses/subscribe/{course_id}','CoursesController@subscribe');

Route::get('/courses/unsubscribe/{course_id}','CoursesController@unsubscribe');

Route::post('/courses/edit', 'CoursesController@validateIfCourseCanBeUpdated');

Route::post('/courses/filter', 'CoursesController@filter');

Route::get('/monitors', 'MonitorsController@index')
    ->middleware('auth');

Route::get('/monitors/{MonitorId}', 'MonitorsController@show')
    ->middleware('auth');

Route::get('/tags', 'SubjectController@index')
    ->middleware('auth');

Route::get('/tags/create', 'SubjectController@create')
    ->middleware('auth');

Route::post('/tags', 'SubjectController@store')
    ->middleware('auth');

Route::get('/users/{User}', 'UsersController@index')
    ->middleware('auth');

Route::get('/users/create/', 'CoursesController@index')
    ->middleware('auth');

Route::post('/users', 'UsersController@store')
    ->middleware('auth');

Route::get('/users/{id}/edit', 'UsersController@edit')
    ->middleware('auth');

Route::put('/users/{id}', 'UsersController@update')
    ->middleware('auth');

Route::get('/users/{id}/delete', 'UsersController@destroy')
    ->middleware('auth');

Route::get('/monitorings', 'MonitoringsController@index')
    ->middleware('auth'); 

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/study_group' , 'StudyGroupController@index');

Route::get('/study_group/create' , 'StudyGroupController@create_study_group_page')->middleware('auth');

Route::post('study_group/store' , 'StudyGroupController@validatesStudyGroupData')->middleware('auth');
