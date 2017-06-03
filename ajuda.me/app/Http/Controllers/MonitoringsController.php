<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monitoring;
use App\Location;
use App\User;
use App\Course;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Log;
use Illuminate\Support\Facades\Auth;

class MonitoringsController extends Controller
{
    public $log;
    public function __construct()
    {
        $this->log = new Logger('monitorings');
        $this->log->pushHandler(new StreamHandler(__DIR__.'/monitorings.log', Logger::DEBUG));
    }

    /**
     * Display a listing of monitorings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monitorings = Monitoring::orderBy('id', 'asc')->get();
        $locations = Location::orderBy('id', 'asc')->get();
        $courses = Course::orderBy('id', 'asc')->get();
        $selectedCourse = User::first()->course_id;
        $user = Auth::user()->role;
        $user_id = Auth::user()->id;


        if($user == "student"){

            foreach ($courses as $course){
                foreach($monitorings as $key =>$monitoring){
                                
                    if ($course->id == $monitoring->id_courses){
                        $user_within = $course->students()->where('id', $user_id)->first();

                        if(!$user_within){
                             unset($monitorings[$key]);
                        }
                    }
                    
                }    
            }
        }
        
     
        return view('monitorings.index', compact('monitorings', 'courses', 'locations', 'selectedCourse', 'user'));
    }

    /**
     * Show the form for creating a new monitoring.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $locations = Location::orderBy('id', 'asc')->get();
        $selectedLocation = User::first()->location_id;

        $courses = Course::orderBy('id', 'asc')->get();
        $selectedCourse = User::first()->course_id;

        $monitors = User::where('role', 'monitor')->get();
        $selectedMonitors = User::first()->user_id;


        return view('monitorings.create', compact('locations', 'selectedLocation','courses',
            'selectedCourse','monitors','selectedMonitors'));
    }

    /**
     * Store a newly created monitoring in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $monitoring = new Monitoring;

        $monitoring->id = request('id');
        $monitoring->contentApproached = request('contentApproached');
        $monitoring->type = request('type');
        $monitoring->startTime = request('startTime');
        $monitoring->duration = request('duration');
        $monitoring->id_location = request('location_id');
        $monitoring->id_courses = request('course_id');
        $monitoring->save();


        foreach (request('monitors') as $monitor) {
            $monitoring -> monitors() -> attach($monitor);
        }


        return redirect('/monitorings')->with('status', 'Successfuly created Monitoring!');
    }

    /**
     * Show the form for editing the specified monitoring.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $locations = Location::orderBy('id', 'asc')->get();
      $selectedLocation = User::first()->location_id;

      $courses = Course::orderBy('id', 'asc')->get();
      $selectedCourse = User::first()->course_id;

      $monitors = User::where('role', 'monitor')->get();
      $selectedMonitors = User::first()->user_id;

      $monitoring = Monitoring::find($id);

        return view('monitorings.edit', compact('monitoring', 'locations', 'selectedLocation','courses',
            'selectedCourse','monitors','selectedMonitors'));
    }

    /**
     * Update the specified monitoring in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $monitoring = Monitoring::find($id);
        $monitoring->id = request('id');
        $monitoring->contentApproached = request('contentApproached');
        $monitoring->type = request('type');
        $monitoring->startTime = request('startTime');
        $monitoring->duration = request('duration');
        $monitoring->id_location = request('location_id');
        $monitoring->id_courses = request('course_id');
        $monitoring->save();

        return redirect('/monitorings')->with('status', 'Successfuly updated monitoring!');
    }

    /**
     * Remove the specified monitoring from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $monitoring = Monitoring::find($id);

      $monitoring->delete();



      return redirect('monitorings')->with('status', 'Sucessfuly deleted Monitorings!');
    }
}
