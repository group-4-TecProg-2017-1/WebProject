<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
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
        $id = request('id');
        $numericId = self::assertOnlyNumbers($id); 
        $sixNumbersId = self::assertSizeIdIsSix($id); 

        $name = request('name');
        $validSizeName = self::assertNameSize($name);

        $courseExist = self::searchCourseOnDatabase($id);


        if ($numericId && $sixNumbersId && $id != null && $validSizeName && $name != null && !$courseExist){

            Course::create(['id' => request('id'),'name' => request('name')]);
            return redirect('/courses');
        }else{
            return view('/courses/create');
        }

    }


    public function searchCourseOnDatabase($id){
        $course = self::searchCourse($id);
        $foundCourse = false;
        if ($course != null){
            $foundCourse = true;
        }else{
            $foundCourse = false;
        }

        return $foundCourse;
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
        $course= self::searchCourse($course_id);

        $oneCourse = array('course_id' => $course_id ,
                           'name' => $course->name);
        
        return view('/courses/edit' , $oneCourse );
        
    }

    public function searchCourse($course_id)
    {
        $course = null;
        $course= Course::where('id', (integer) $course_id)->first();
        return $course;
    }

    public function update(Request $request)
    {   
        $id = request('id');
        $numericId = self::assertOnlyNumbers($id); 
        $sixNumbersId = self::assertSizeIdIsSix($id);

        $name = request('name');
        $validSizeName = self::assertNameSize($name);

        if ($numericId && $sixNumbersId && $id != null && $validSizeName && $name != null){
            
            Course::where('id', (integer) request('old_id'))->update(['name' => request('name') , 
                                                                        'id' => request('id')]);
        }

        return redirect('/courses');
    }

    public function assertNameSize($name){
        define("MINSIZENAME" , "3"); // Lenght of course name must be bigger than 3;
        $sizeName = strlen($name);
        if ($sizeName >= MINSIZENAME){
            return true;
        }else{
            return false;
        }
    }

    public function assertOnlyNumbers($id){

        if (is_numeric($id)){
            return true;
        }else{
            return false;
        }
        
    }


    public function assertSizeIdIsSix($id){
        define("IDSIZE" , "6"); // ID MUST contain only 6 numbers
        $idSize = strlen ($id);

        if ($idSize == IDSIZE ){
            return true;
        }else{
            return false;
        }
    }


    public function filter(Request $request)
    {   
        $id = request('id');
        $numericId = self::assertOnlyNumbers($id); 
        $sixNumbersId = self::assertSizeIdIsSix($id);  

        if ($numericId && $sixNumbersId && $id != null){
            echo "xuxuzinho";
        }
        

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

