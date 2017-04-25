<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Course;
use App\Monitoring;
use App\Monitor;

class CoursesController extends Controller
{
    /**
     * Display a listing of the courses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('id', 'asc')->get();

        return view('courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Course::create([
            'id' => request('id'),
            'name' => request('name')
        ]);

        return redirect('/courses');
    }

    /**
     * Display the specified course.
     *
     * @param  int  $course_id
     * @return \Illuminate\Http\Response
     */
    public function show($course_id)
    {
        $course = Course::where('id', (integer) $course_id)
            ->first();
        $monitoring = Monitoring::where('course_id', (integer) $course_id)
            ->first();
        $monitors = Monitor::where('course_id', (integer) $course_id)
            ->get();

        return view('courses.show', compact('course', 'monitoring', 'monitors'));
    }

    /**
     * Show the form for editing the specified course.
     *
     * @param  int  $course_id
     * @return \Illuminate\Http\Response
     */
    public function edit($course_id)
    {
        //
    }

    /**
     * Update the specified course in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $course_id
     * @return \Illuminate\Http\Response
    public function update(Request $request, $id)
    {
        //
    }
     */

    /**
     * Remove the specified course from database.
     *
     * @param  int  $course_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($course_id)
    {
        //
    }

    public function delete($course_id)
    {
    
        Course::find($course_id)->delete();
        return redirect('/courses');
        
    }
/*
    public function search($course_id)
    {
        $course = DB::table('courses')->where('id', course_id)->first();

        echo $user->name;

    }
    */
    public function editCourse($course_id)
    {
        $course= Course::where('id', (integer) $course_id)->first();
        $oneCourse = array('course_id' => $course_id ,
                           'name' => $course->name);
        
        return view('/courses/edit' , $oneCourse );
        
    }

    public function update(Request $request)
    {
        Course::where('id', (integer) request('old_id'))->update(['name' => request('name') , 
                                                                    'id' => request('id')]);
        return redirect('/courses');
    }


    public function filter(Request $request)
    {
        if (request('id') == null && request('name') == null ){

            $courses = Course::orderBy('id', 'asc')->get();
        }else{

            if (request('id') != null ){
                $courses = Course::where('id' , (integer) request('id'))->get();
            }
            if (request('name') != null){
                $courses = Course::where('name' , (string) request('name'))->get();
            } 
        }        
            

        return view('/courses/index' , compact('courses'));

    }
}
