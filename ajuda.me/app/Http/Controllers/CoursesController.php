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

    private function assertElementsOfRequestAreValid(Request $request , & $errors){
        define('NAME_OF_COURSE' , 'name');
        define('OLD_COURSE_ID' , 'old_id');

        $courseName = request(NAME_OF_COURSE);;
        $isValidName = self::validateName($courseName , $errors);

        $actualCourseId = request(ID_OF_COURSE);
        $isValidActualId = self::validateId($actualCourseId , $errors);

        $oldCourseId = request(OLD_COURSE_ID);
        $isValidOldCourseId = self::validateId($oldCourseId , $errors);

        $validElementsOfRequest = false;
        if($isValidName && $isValidId && isValidOldCourseId){

            $validElementsOfRequest = true;
        }else{
            $validElementsOfRequest = false;
        }

        return $validElementsOfRequest;
    }


    /**
    *   Validate if name is valid, verify if size is more than 2 
    *   @param int $name , name of selected course
    *   @param Array $errors , contains all errors strings to store courses
    *   @return bool $validName ,return true if name is validated else return false
    */
    private function validateName($name , $errors){
        define('NULLNAME' , null);
        define('EMPTYNAME' , "");

        $validSizeName = self::assertNameSize($name , $errors);
        
        $validName = false;
        if($validSizeName && $name != NULLNAME && $name != EMPTYNAME ){

            $validName = true;
        }else{

            $validName = false;
        }

        return $validName;
    }


    /**
    *   Validate if ID is valid, verify size and if contains only numbers
    *   @param int $id
    *   @param Array $errors , contains all errors strings to store courses
    *   @return bool $validId ,return true if ID id all validates else return false
    */
    private function validateId($id , $errors){

        $onlyNumbersOnId = self::assertOnlyNumbers($id , $errors);
        $sixLengthId = self::assertSizeIdIsSix($id , $errors);

        $validId = false;
        if($onlyNumbersOnId && $sixLengthId && $id != null && $id != EMPTYNAME){
            $validId = true;
        }else{
            $validId = false;
        }

        return $validId;
    }


    /**
    * Update the information of courses 
    * @param \Illuminate\Http\Request , is a form with name, id and old id information of course
    * @return \Illuminate\Http\Response , a view to the user
    */

    
    public function validateIfCourseCanBeUpdated(Request $request)
    {   
        define('REDIRECTCOURSES' , '/courses');
        define('VIEWCOURSESEDIT' , '/courses/edit');
        define('ID_OF_COURSE' , 'id');
        define('PREVIOUS_ID_OF_COURSE' , 'old_id');
        define('COURSE_NAME' , 'name');
        define('OLD_COURSE_NAME' , 'old_name');
        define('ERROR_EQUAL_COURSE' , "Nenhum campo foi atualizado, curso não pode ser alterado");
        define('EQUAL_STRING' , 0);

        $actualCourseId = request(ID_OF_COURSE);
        $oldCourseId = request(PREVIOUS_ID_OF_COURSE);
        $actualCourseName = request(COURSE_NAME);
        $oldCourseName = request(OLD_COURSE_NAME);

        $nextPage = null;
        $errors = array();
        $valuesToUpdate = null;

        if($actualCourseId == $oldCourseId && $actualCourseName == $oldCourseName){
            
            $nextPage = redirect ("/courses");

        }else if ($actualCourseId == $oldCourseId && strcmp($actualCourseName, $oldCourseName) != EQUAL_STRING ){

            $validName = self::assertNameSize($actualCourseName , $errors);

            if($validName){

                $valuesToUpdate = [COURSE_NAME => $actualCourseName];
                Course::where( ID_OF_COURSE, $oldCourseId)->update($valuesToUpdate);
                $nextPage = redirect ("/courses");

            }else{
                $course_id = $oldCourseId;
                $name = $oldCourseName;
                $nextPage = view("/courses/edit" , compact('errors' , 'course_id' , 'name') );
            }     

        }else if($actualCourseId != $oldCourseId && strcmp($actualCourseName, $oldCourseName) == EQUAL_STRING){
            
            $validNumbersId = self::assertOnlyNumbers($actualCourseId , $errors);
            $validSizeId = self::assertSizeIdIsSix($actualCourseId , $errors);
            $idNotRegistered = self::assertCourseDontExist($actualCourseName , $actualCourseId,  $errors);

            if($validNumbersId && $validSizeId && $idNotRegistered ){
                $valuesToUpdate = [ID_OF_COURSE => $actualCourseId];
                Course::where( ID_OF_COURSE, $oldCourseId)->update($valuesToUpdate);
                $nextPage = redirect ("/courses");
            }else{
                $course_id = $oldCourseId;
                $name = $oldCourseName;
                $nextPage = view("/courses/edit" , compact('errors' , 'course_id' , 'name') );
            }

        }else{
            
            $validName = self::assertNameSize($actualCourseName , $errors);
            $validNumbersId = self::assertOnlyNumbers($actualCourseId , $errors);
            $validSizeId = self::assertSizeIdIsSix($actualCourseId , $errors);
            $idNotRegistered = self::assertCourseDontExist($actualCourseName , $actualCourseId,  $errors);

            if ($validName && $validNumbersId && $validSizeId && $idNotRegistered){
                $valuesToUpdate = [ID_OF_COURSE => $actualCourseId , 
                                   COURSE_NAME => $actualCourseName ];
                Course::where( ID_OF_COURSE, $oldCourseId)->update($valuesToUpdate);
                $nextPage = redirect ("/courses");
                
            }else{
                $course_id = $oldCourseId;
                $name = $oldCourseName;
                $nextPage = view("/courses/edit" , compact('errors' , 'course_id' , 'name') );
            }


        }

        return $nextPage;
    }

    private function assertCourseDontExist($actualCourseName , $actualCourseId , & $errors){

        define("ERROR_COURSE_EXIST" , "Outro curso já está cadastrado com esse ID");

        $courseExist = Course::where( ID_OF_COURSE, $actualCourseId)->first();
        $canCreate = false;
        if ($courseExist == null){
            $canCreate = true;
        }else{
            array_push($errors, ERROR_COURSE_EXIST);
            $canCreate = false;
        }
        return $canCreate;
    }
     

    /** 
    * Verify if the size name is bigger than minimal size (2) and insert log of error if is not
    *  @param int $name  , name of a course
    *  @param array $errors , array of errors to create and update a course
    *  @return boolean 
    */
    public function assertNameSize($name , & $errors){
        define("MINSIZENAME" , "3"); // Lenght of course name must be bigger than 3;
        define("ERRORNAMESIZE" , "Nome do curso deve possuir mais que 2 caracteres");
        $sizeName = strlen($name);

        $validName = false;

        if ($sizeName >= MINSIZENAME){
            $validName = true;
        }else{
            array_push($errors , ERRORNAMESIZE);
            $validName = false;
        }
        return $validName;
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
        $name = request('name');

        if ($id == null && $name == null ){

            $courses = Course::orderBy('id', 'asc')->get();
        }else{

            if (request('id') != null ){
                $courses = Course::where('id' , (integer)$id)->get();
            }
            if (request('name') != null){
                $courses = Course::where('name' , (string) $name)->get();
            } 
        }        
            

        return view('/courses/index' , compact('courses'));

    }

    

}

