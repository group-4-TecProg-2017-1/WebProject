<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Course;
use App\Monitoring;
use App\Monitor;

class CoursesController extends Controller
{

    const IDSIZE  = "6"; // ID MUST contain only 6 numbers
    const ERRORIDSIZE = "Tamanho do ID deve ser 6"; // indicate the size of id when happens user's mistake
    const VARIABLE_TO_SEND = "courses";
    const NOTONLYNUMBERS = 'Deve conter apenas número no ID';
    const MINSIZENAME = "3"; // Lenght of course name must be bigger than 3;
    const ERRORNAMESIZE = "Nome do curso deve possuir mais que 2 caracteres";
    const ERROR_COURSE_EXIST = "Outro curso já está cadastrado com esse ID";
    const REDIRECTCOURSES = '/courses';
    const VIEWCOURSESEDIT = '/courses/edit';
    const ID_OF_COURSE = 'id';
    const PREVIOUS_ID_OF_COURSE = 'old_id';
    const COURSE_NAME = 'name';
    const OLD_COURSE_NAME = 'old_name';
    const ERROR_EQUAL_COURSE = "Nenhum campo foi atualizado, curso não pode ser alterado";
    const EQUAL_STRING = 0;
    const EMPTYNAME = "";
    const NAME_OF_COURSE ='name';
    const OLD_COURSE_ID ='old_id';
    const COURSEFOUND = "Existe outro curso cadastrado com esse ID"; //course have been found on database
    const URL_TO_COURSES = "/courses";
    const FOUND_COURSE = "Course has been found";
    const COURSE_NOT_FOUND = "Course hasn't been found";
    const EDIT_PAGE =  "/courses/edit";
    
    // block of log's message
    const LOG_DELETED_COURSE = "Course has been deleted on database";
    const LOG_ID_VALID = "The size of id is valid"; // log to tell the that id is validated
    const LOG_ID_INVALID = "The size of id is invalid"; // error log of id's size 
    const LOG_INDEX_REACHED  = "Course view reached (method tha called view:index).";
    const LOG_COURSE_VIEW = "View of course creation (create.blade)"; 
    const LOG_EDIT_PAGE = "Edit page reached";
    const LOG_VALID_COURSE = "All datas are validated, course can be created";
    const COURSE_SUCESSFULLY_CREATED = "Course could be created and saved on database";


    /**
     * Display a listing of the courses.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        Log::info(self::LOG_INDEX_REACHED);

        $courses = Course::orderBy('id', 'asc')->get();
        
        return view('courses.index', compact('courses'));
    }


    /**
     * Show the form for creating a new course.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCourseView()
    {
        
        Log::info(self::LOG_COURSE_VIEW);

        $create_courses_view = 'courses.create';

        return view($create_courses_view);
    }


    /**
    *  Validate the data of the request (id and course's name)
    *
    * @param \Illuminate\Http\Request  $request
    * @return boolean $valid_datas
    *
    */
    private function validateRequestDatas(Request $request , & $errors)
    {
        // get inputed ID and NAME to validate
        $id = request('id');
        $name = request('name');

        // block validate id's conditions
        $numericId = self::assertOnlyNumbers($id , $errors); 
        $sixNumbersId = self::assertSizeIdIsSix($id , $errors);

        // validate minimum size of name 
        $validSizeName = self::assertNameSize($name , $errors);

        // check if course exist on database
        $courseCanBeCreated = self::courseCanBeCreated($id , $errors);

        $allValidated = false;

        $validating_courses_data = 'Could get (all id, valid name, existence of course) validations';
        Log::info($validating_courses_data);

        if($numericId && $sixNumbersId && $validSizeName && $courseCanBeCreated){
            $allValidated = true;
        }else{
            $allValidated = false;
        }
        return $allValidated;
    }


    /**
    * Ensure datas are validated and create course in database
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function validateCourseToCreate(Request $request)
    {
    
        $errors = array(); // keep the logs of errors
        $courseCanBeCreated = self::validateRequestDatas($request , $errors);
        Log::info(self::LOG_VALID_COURSE);


        $pageSelected = null;
        if ($courseCanBeCreated){
            self::storeNewCourseOnDatabase($request);
            $pageSelected = redirect('/courses');
        }else{
            $pageSelected = view('/courses/create' , compact('errors'));
        }
        return $pageSelected;
    }


    /**
    *   Store a newly created resource in database.
    *   @param \Illuminate\Http\Request  $request
    *   @return void
    */
    private function storeNewCourseOnDatabase(Request $request){

        // get inputed ID and NAME to validate
        $id = request('id');
        $name = request('name');

        Course::create(['id' => $id,'name' => $name]);
        Log::info(self::COURSE_SUCESSFULLY_CREATED);
    }
    

    /**
    * Validate if course can be created based on search on database
    * @param int $id , id of course
    * @param array $errors , array to add errors that don't let course be created
    * @return bool $courseCanBeCreated , true if course id dont exist on database and can be created,
    *                                    false if course id exit and can't be created
    */
    public function courseCanBeCreated($id , & $errors){

        $course = self::searchCourse($id);
        $courseCanBeCreated = false;

        if ($course == null){

            $courseCanBeCreated = true;
        }else{

            array_push($errors , self::COURSEFOUND);
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
    * Funtion to delete course on database by id
    * @param int $course_id , id o course to delete
    * @return \Illuminate\Http\Response
    *
    */
    public function delete($course_id)
    {

        $foundCourse = Course::find($course_id)->get();

        if ($foundCourse != null){
            Log:info(self::FOUND_COURSE);
            Course::find($course_id)->delete();
        }else{
            Log::warning(self::COURSE_NOT_FOUND);
        }

        return redirect(self::URL_TO_COURSES);
        
    }


    /**
    *   Search the course on database by id to redirect to courses's edit page
    *   @param int $course_id
    *   @return \Illuminate\Http\Response $editCoursePage
    *
    */
    public function getCoursesdatasOnDatabase($course_id)
    {

        Log::info(self::LOG_EDIT_PAGE);

        $course= self::searchCourse($course_id);

        // set name and id of course that is going to be updated on array
        $oneCourse = array('course_id' => $course_id ,
                           'name' => $course->name);
        
        $editCoursePage = view( self::EDIT_PAGE , $oneCourse);

        return $editCoursePage;
        
    }

    /*
    *   Search the course on database by the given id
    *   @param int $course_id
    *   @return App/Course $course , if course is not found, return is null
    *
    */
    private function searchCourse($course_id)
    {
        $course = null;
        $course= Course::where('id', (integer) $course_id)->first();
        return $course;
    }


    private function assertElementsOfRequestAreValid(Request $request , & $errors){

        $courseName = request(self::NAME_OF_COURSE);;
        $isValidName = self::validateName($courseName , $errors);

        $actualCourseId = request(self::ID_OF_COURSE);
        $isValidActualId = self::validateId($actualCourseId , $errors);

        $oldCourseId = request(self::OLD_COURSE_ID);
        $isValidOldCourseId = self::validateId($oldCourseId , $errors);

        $validElementsOfRequest = false;
        if($isValidName && $isValidId && isValidOldCourseId){

            $validElementsOfRequest = true;
        }else{
            $validElementsOfRequest = false;
        }

        return $validElementsOfRequest;
    }


    /*
    *   Validate if name is valid, verify if size is more than 2 
    *   @param int $name , name of selected course
    *   @param Array $errors , contains all errors strings to store courses
    *   @return bool $validName ,return true if name is validated else return false
    */
    private function validateName($name , $errors){

        $validSizeName = self::assertNameSize($name , $errors);
        
        $validName = false;
        if($validSizeName && $name != null && $name != self::EMPTYNAME ){

            $validName = true;
        }else{

            $validName = false;
        }

        return $validName;
    }


    /*
    *   Validate if ID is valid, verify size and if contains only numbers
    *   @param int $id
    *   @param Array $errors , contains all errors strings to store courses
    *   @return bool $validId ,return true if ID id all validates else return false
    */
    private function validateId($id , $errors){

        $onlyNumbersOnId = self::assertOnlyNumbers($id , $errors);
        $sixLengthId = self::assertSizeIdIsSix($id , $errors);

        $validId = false;
        if($onlyNumbersOnId && $sixLengthId && $id != null && $id != self::EMPTYNAME){
            $validId = true;
        }else{
            $validId = false;
        }

        return $validId;
    }


    /*
    * Update the information of courses 
    * @param \Illuminate\Http\Request , is a form with name, id and old id information of course
    * @return \Illuminate\Http\Response , a view to the user
    */    
    public function validateIfCourseCanBeUpdated(Request $request)
    {   


        $actualCourseId = request(self::ID_OF_COURSE);
        $oldCourseId = request(self::PREVIOUS_ID_OF_COURSE);
        $actualCourseName = request(self::COURSE_NAME);
        $oldCourseName = request(self::OLD_COURSE_NAME);

        $nextPage = null;
        $errors = array();
        $valuesToUpdate = null;

        if($actualCourseId == $oldCourseId && $actualCourseName == $oldCourseName){
            
            $nextPage = redirect ("/courses");

        }else if ($actualCourseId == $oldCourseId && strcmp($actualCourseName, $oldCourseName) != self::EQUAL_STRING ){

            $validName = self::assertNameSize($actualCourseName , $errors);

            if($validName){

                $valuesToUpdate = [self::COURSE_NAME => $actualCourseName];
                Course::where( self::ID_OF_COURSE, $oldCourseId)->update($valuesToUpdate);
                $nextPage = redirect ("/courses");

            }else{
                $course_id = $oldCourseId;
                $name = $oldCourseName;
                $nextPage = view("/courses/edit" , compact('errors' , 'course_id' , 'name') );
            }     

        }else if($actualCourseId != $oldCourseId && strcmp($actualCourseName, $oldCourseName) == self::EQUAL_STRING){
            
            $validNumbersId = self::assertOnlyNumbers($actualCourseId , $errors);
            $validSizeId = self::assertSizeIdIsSix($actualCourseId , $errors);
            $idNotRegistered = self::assertCourseDontExist($actualCourseName , $actualCourseId,  $errors);

            if($validNumbersId && $validSizeId && $idNotRegistered ){
                $valuesToUpdate = [self::ID_OF_COURSE => $actualCourseId];
                Course::where( self::ID_OF_COURSE, $oldCourseId)->update($valuesToUpdate);
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
                $valuesToUpdate = [self::ID_OF_COURSE => $actualCourseId , 
                                   self::COURSE_NAME => $actualCourseName ];
                Course::where( self::ID_OF_COURSE, $oldCourseId)->update($valuesToUpdate);
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


        $courseExist = Course::where( self::ID_OF_COURSE, $actualCourseId)->first();
        $canCreate = false;
        if ($courseExist == null){
            $canCreate = true;
        }else{
            array_push($errors, self::ERROR_COURSE_EXIST);
            $canCreate = false;
        }
        return $canCreate;
    }
     

    /*
    * Verify if the size name is bigger than minimal size (2) and insert log of error if is not
    *  @param int $name  , name of a course
    *  @param array $errors , array of errors to create and update a course
    *  @return boolean 
    */
    private function assertNameSize($name , & $errors){

        $sizeName = strlen($name);

        $validName = false;

        if ($sizeName >= self::MINSIZENAME){
            $validName = true;
        }else{
            array_push($errors , self::ERRORNAMESIZE);
            $validName = false;
        }
        return $validName;
    }

    /*
    * Verify if id contains only numbers
    *  @param int $id  , name of a course
    *  @param array $errors , array of errors to create and update a course
    *  @return boolean 
    */
    private function assertOnlyNumbers($id , & $errors){

        if (is_numeric($id)){
            return true;
        }else{
            array_push($errors , self::NOTONLYNUMBERS );
            return false;
        }
        
    }


    /*
    * Assert the size of id id 6
    * @param int $id , id of course
    * @param array $errors , An array to add errors if they exist
    * @return boolean $validCourse , true if the size if correct , 
    *                                false if is not correct
    */
    private function assertSizeIdIsSix($id , & $errors){
        

        $idSize = strlen ($id);
        $validSize = false;

        if ($idSize == self::IDSIZE ){

            Log::info(self::LOG_ID_VALID);
            $validSize = true;
        }else{

            Log::warning(self::LOG_ID_INVALID);
            array_push($errors, self::ERRORIDSIZE);
            $validSize =false;
        }

        return $validSize;
    }


    /**
    * Filter the courses by id or by name
    * @param \Illuminate\Http\Request , is a form with name and id of course
    * @return \Illuminate\HttpzRequest , view of filtered courses
    */
    public function filter(Request $request)
    {   

        $id = request('id');
        $name = request('name');

        if ($id == null && $name == null ){

            $courses = Course::orderBy('id', 'asc')->get();
        }else{

            if (request('id') != null ){
                $courses = Course::where('id' , (integer)$id)->get();
            }else{
                // nothing to do
            }
            if (request('name') != null){
                $courses = Course::where('name' , (string) $name)->get();
            }else{
                // nothing to do
            }
        }        
            
        return view('/courses/index' , compact(self::VARIABLE_TO_SEND));
    }

    

}

