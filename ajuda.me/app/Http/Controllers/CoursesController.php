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
        $errors = array();

        $numericId = self::assertOnlyNumbers($id , $errors); 
    
        $sixNumbersId = self::assertSizeIdIsSix($id , $errors); 

        $name = request('name');
        $validSizeName = self::assertNameSize($name , $errors);

        $courseCanBeCreated = self::courseCanBeCreated($id , $errors);
        
        $pageSelected = null;
        if ($numericId && $sixNumbersId && $id != null && $validSizeName 
            && $name != null && $courseCanBeCreated){

            Course::create(['id' => request('id'),'name' => request('name')]);
            $pageSelected = redirect('/courses');
        }else{
            $pageSelected = view('/courses/create' , compact('errors'));
        }
        return $pageSelected;

    }


    public function courseCanBeCreated($id , & $errors){
        define('COURSEFOUND' , "Existe outro curso cadastrado com esse ID");

        $course = self::searchCourse($id);
        $courseCanBeCreated = false;
        if ($course == null){

            $courseCanBeCreated = true;
        }else{
            array_push($errors , COURSEFOUND);
            $courseCanBeCreated = false;
        }

        return $courseCanBeCreated;
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
        $errors = array();
        $numericId = self::assertOnlyNumbers($id, $errors); 
        $sixNumbersId = self::assertSizeIdIsSix($id, $errors);

        $name = request('name');
        $validSizeName = self::assertNameSize($name, $errors);

        $courseCanBeCreated = self::courseCanBeCreated($id, $errors);

        define('REDIRECTCOURSES' , '/courses');
        define('VIEWCOURSESEDIT' , '/courses/edit');
        $nextPage = null;

        if ($numericId && $sixNumbersId && $id != null && $validSizeName
             && $name != null && $courseCanBeCreated ){
            
            $old_id = request('old_id');
            $valuesToUpdate = null;

            if($old_id == $id){
                $valuesToUpdate = ['name' => $name];
            }else{
                $valuesToUpdate = ['name' => $name, 'id' => $id];
            }
            Course::where('id', (integer) request('old_id'))->update($valuesToUpdate);
            $nextPage = REDIRECTCOURSES;
        }else{
            // course will no be updated
            $nextPage = VIEWCOURSESEDIT;
        }

        return redirect($nextPage);
    }

    public function assertNameSize($name , & $errors){
        define("MINSIZENAME" , "3"); // Lenght of course name must be bigger than 3;
        define("ERRORNAMESIZE" , "Nome do curso deve possuir mais que 2 caracteres");
        $sizeName = strlen($name);

        if ($sizeName >= MINSIZENAME){
            return true;
        }else{
            array_push($errors , ERRORNAMESIZE);
            return false;
        }
    }

    public function assertOnlyNumbers($id , & $errors){
        define('NOTONLYNUMBERS' , 'Deve conter apenas número no ID');

        if (is_numeric($id)){
            return true;
        }else{
            array_push($errors , NOTONLYNUMBERS );
            return false;
        }
        
    }


    public function assertSizeIdIsSix($id , & $errors){
        define("IDSIZE" , "6"); // ID MUST contain only 6 numbers
        define("ERRORIDSIZE" , "Tamanho do ID deve ser 6");

        $idSize = strlen ($id);

        if ($idSize == IDSIZE ){
            return true;
        }else{
            array_push($errors, ERRORIDSIZE);
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

