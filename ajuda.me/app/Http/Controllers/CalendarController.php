<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Monitoring;
use App\Course;
use App\User;


class CalendarController extends Controller
{
    /**
     * Display a listing of the monitors.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monitorings = Monitoring::orderBy('id', 'asc')->get();
        $user_id = Auth::user()->id;
        $courses = Course::orderBy('id', 'asc')->get();


        foreach ($courses as $course){
            foreach($monitorings as $key =>$monitoring){

                if ($course->id == $monitoring->id_courses){
                    $user_within = $course->students()->where('id', $user_id)->first();

                    if(!$user_within){
                         unset($monitorings[$key]);
                    }
                }
                else {
                  //Nothing to do (Course is not related to the monitoring)
                }
            }
        }
        


        return view('calendar.index',  compact('monitorings'));
    }

    /**
     * Show the form for creating a new monitor.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created monitor in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
}
