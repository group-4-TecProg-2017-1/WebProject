<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Location;
use App\StudyGroup;
use App\User;
use App\Course;
use Illuminate\Support\Facades\Auth;

class StudyGroupController extends Controller
{
    CONST MAX_LENGHT_CONTENT_APPROACHED = 255;
    CONST MIN_LENGHT_CONTENT_APPROACHED = 3;

    CONST LOG_MESSAGE = 'Study group view reached (index).';
    CONST LOG_FUNCTION_CREATE_PAGE = 'Function to redirect to study group create page has been reached';
    CONST LOG_ELSE_CREATE_STUDY_GROUP_PAGE = 'Else condition of create study group page.';
    CONST LOG_CREATED_STUDY_GROUP = 'The study group has been created succesfully';
    CONST LOG_USER_NOT_CREATED = 'The study group HAS NOT been created';
   
	/**
    * Display a listing study groups.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        Log::info(self::LOG_MESSAGE);
        $locations = null;
        $locations = Location::orderBy('id', 'asc')->get();
        $study_groups = StudyGroup::orderBy('id' , 'asc')->get();
                
        return view('study_group.index', compact('locations' , 'study_groups'));
    }

    /**
    * Redirect to the page where user can create a study group
    * @return \Illuminate\Http\Response
    */
    public function create_study_group_page()
    {
        Log::info(self::LOG_FUNCTION_CREATE_PAGE);

        $locations = Location::orderBy('id', 'asc')->get();
        $study_groups = StudyGroup::orderBy('id' , 'asc')->get();

        if (count($locations) != 0){
            
            $selectedLocation = User::first()->location_id;
            $monitors = User::where('role', 'monitor')->get();
            $selectedMonitors = User::first()->user_id;
            $page_to_redirect = view('study_group.create' , compact('locations' , 'selectedLocation'  
                                  , 'monitors' , 'selectedMonitors'));
        }else{
            Log::info(self::LOG_ELSE_CREATE_STUDY_GROUP_PAGE);
            $page_to_redirect = view('study_group.index' , compact('study_groups'));
        }

        return $page_to_redirect;
    }

    /**
    * Creates StudyGroup object 
    * @return StudyGroup $study_group
    */
    private function createStudyGroup(){
        $study_group = null;
        $study_group = new StudyGroup();

        if($study_group != null){
            Log::info(self::LOG_CREATED_STUDY_GROUP);
        }else{
            Log::info(self::LOG_USER_NOT_CREATED);
        }

        return $study_group;
    }


    /**
    * Validates inputed data of study group to verify if is possible to store on database
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Request 
    */
    public function validatesStudyGroupData(Request $request){

        $study_group = null;
        $study_group = self::createStudyGroup();

        if($study_group != null){ 

            $check_validation = self::validatesRequestedData($request);
            
            $study_group = self::completeAtributesOfStudyGroup($study_group , $request);
            Log::info($study_group);

        }else{
           # study group is null and cannot store on database
        }
    }

    /*
    * validates request data to fill in study group object 
    *   @param \Illuminate\Http\Request  $request
    *   @return boolean check_validation  return true if all data are validated, else return false
    */
    private function validatesRequestedData(Request $request){

        $content_aproached = request('fieldOfContentAproached');
        $valid_content_aproached = self::validate_content_aproached($content_aproached);

        if($valid_content_aproached){
            Log::info("content_aproached is valid");
        }else{
             Log::info("content_aproached is NOT valid");
        }

    }

    /*
    * validate if content aproach is valid
    * @param String content_aproached
    * @return boolean validContent 
    */
    private function validate_content_aproached($content_aproached){

        $is_null = true;
        $is_null = self::validate_if_content_aproached_is_null($content_aproached);

        $valid_length = false;
        $valid_length = self::validate_lenght_of_content_aproached($content_aproached);

        $content_aproached_is_validated = false;
        if($is_null == false && $valid_length == true){
            $content_aproached_is_validated = true;
        }else{
            $content_aproached_is_validated = false;
        }

        return $content_aproached_is_validated;
    }

    /*
    * validate if content aproached is null
    * @param $content_aproached
    * @return boolean $is_null
    */
    private function validate_if_content_aproached_is_null($content_aproached){

        $is_null = true;

        if($content_aproached != null){
            $is_null = false;
        }else{
            // nothing to do
        }

        return $is_null;
    }


    /*
    * validate the min and max size of content approached
    * @param string $content_aproached
    * @return boolean valid_size
    */
    private function validate_lenght_of_content_aproached($content_aproached){

        $valid_lenght = false;

        $lenght_of_content_aproached = strlen($content_aproached);
        if ($lenght_of_content_aproached < self::MAX_LENGHT_CONTENT_APPROACHED && 
            $lenght_of_content_aproached >= self::MIN_LENGHT_CONTENT_APPROACHED ){
            $valid_lenght = true;
        }else{
            // nothing to do
        }

        return $valid_lenght;
    }


    /*
    * Fill atributes of study group with request data
    * @param \Illuminate\Http\Request $request
    * @param StudyGroup $study_group
    * @return StudyGroup $study_group
    */
    private function completeAtributesOfStudyGroup(StudyGroup $study_group , Request $request){

        // get the current object User
        $user =  Auth::user();

        //sets the email of user on study group
        $study_group->email_user_creator =$user->email;

        // get inputed informations to fill in study group object
        $study_group->content_approached = request('fieldOfContentAproached');
        $study_group->start_time = request('fieldOfStartTime');
        $study_group->duration = request('fieldOfDuration');
        $study_group->id_location = request('location_id');

        return $study_group;
    }



}