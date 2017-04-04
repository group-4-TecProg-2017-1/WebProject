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
    $courses = App\Course::orderBy('id', 'asc')->get();
    return view('courses.index', compact('courses'));
})->middleware('auth');

Route::get('/showcourse/{course_id}', function ($course_id) {
    $course = App\Course::where('id', (integer) $course_id)
        ->first();
    $monitor = App\Monitor::where('course_id', (integer) $course_id)
        ->first();
    $monitoring = App\Monitoring::where('course_id', (integer) $course_id)
        ->first();
    return view('courses.show', compact('course', 'monitor', 'monitoring'));
})->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index');
