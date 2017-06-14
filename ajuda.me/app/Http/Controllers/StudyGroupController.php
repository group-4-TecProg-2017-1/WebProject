<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Location;
use App\StudyGroup;
use App\User;
use App\Course;
use Illuminate\Support\Facades\Auth;
use \Datetime;

class StudyGroupController extends Controller
{
    CONST MAX_LENGHT_CONTENT_APPROACHED = 255;
    CONST MIN_LENGHT_CONTENT_APPROACHED = 3;
    CONST LENGTH_DURATION_TIME_STRING = 5;
    CONST LOWER_ACEPTED_HOUR = 00;
    CONST HIGHER_ACEPTED_HOUR = 23;
    CONST FIRST_INDEX = 0;
    CONST SECOND_INDEX = 1;
    CONST THIRD_INDEX = 2;
    CONST FOURTH_INDEX = 3;
    CONST SIXTH_INDEX = 5;
    CONST SEVENTH_INDEX = 6;
    CONST NINTH_INDEX = 8;
    CONST TENTH_INDEX = 9;



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

        // get the necessary informations to show on study groups index page (locations and study groups)
        $rooms = self::get_idLocation_room();
        $buildings = self::get_idLocation_building();

        $study_groups = StudyGroup::orderBy('id' , 'asc')->get();
        self::correct_time_format($study_groups); 

        // select the page to redirect as study group index
        $page_to_redirect = null;
        $page_to_redirect = view('study_group.index', compact('rooms' , 'buildings' , 'study_groups' ));
        
        return $page_to_redirect;
    }

    /*
    *   Insert location id and romms of a locations on an array
    *   @param void
    *   @return Array $locations_id_and_rooms
    */
    private function get_idLocation_room(){
        Log::info("On get get_idLocation_room");
        $locations = Location::orderBy('id', 'asc')->get();
        

        $locations_id_and_rooms  = [];
        foreach ($locations as $location) {
            $locations_id_and_rooms[$location->id] = $location->room;
        }
        Log::info($locations_id_and_rooms);

        return $locations_id_and_rooms;
    }


    /*
    *   Insert location id and building of a location on an array
    *   @param void
    *   @return Array $locations_id_and_buildings
    */
    private function get_idLocation_building(){
        Log::info("On get get_idLocation_building");
        $locations = Location::orderBy('id' , 'asc')->get();

        $locations_id_and_buildings  = [];
        foreach ($locations as $location) {
            $locations_id_and_buildings[$location->id] = $location->building;
        }
        Log::info($locations_id_and_buildings);

        return $locations_id_and_buildings;
    }

    /*
    * Correct the format time to brazilian ex: dd/mm/aaaa-hh/mm
    *   @param datetime $start_time
    *   @return void
    */
    private function correct_time_format(& $study_groups){
        Log::info('entrou no formatador');

        $number_of_study_groups = count($study_groups);
        
        $collection_of_start_time = null;
        if($number_of_study_groups != 0){
            foreach ($study_groups as $study_group ) {
                try {
                    $date = null;
                    $date = new DateTime($study_group->start_time);
                    Log::info($date->format('d-m-Y H:i'));
                    $study_group->startTime = $date->format('d-m-Y H:i');
                }catch (Exception $e) {
                    echo $e->getMessage();
                    exit(1);
                }
            }
        }else{
            // nothing to do
        }
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

        $duration = request('fieldOfDuration');
        $valid_duration = self::validate_duration($duration);

        if($valid_content_aproached && $valid_duration){
            Log::info("duration is valid");
        }else{
             Log::info("duration is not valid");
        }

    }

    /*
    * check if duration is validated with all required conditions
    * @param string duration
    * @return boolean valid_duration
    */
    private function validate_duration($duration){
        $lenght_validated = false;
        $lenght_validated = self::validate_lenght_of_duration($duration);

        $limit_hours_validated = self::validate_limit_of_hours($duration);

        if($duration != null && $lenght_validated){
            Log::info("duration is all validated");
        }else{
            Log::info("duration has not been validated");
        }


    }


    /* validate hour of a duration is in the limits of the day (> 0 && < 23)
    * @param $duration
    * @return $valid_limits_hour
    */
    private function validate_limit_of_hours($duration){

        assert($duration != null);

        try{
            $hour_int = (int) $duration;
        }catch(CastException $ex){
            ex.getTraceAsString();
        }

        Log::info($hour_int);

        $valid_limits_hour = false;
        if($hour_int >= self::LOWER_ACEPTED_HOUR && $hour_int <= self::HIGHER_ACEPTED_HOUR){
            $valid_limits_hour = true;
        }else{
            //nothing to do
        }

        return $valid_limits_hour;
    }

   
    /* 
    * validate lenght of duration of a study group
    * @param string $duration
    * @return boolean valid_length
    */
    private function validate_lenght_of_duration($duration){
        $valid_length = false;

        if(strlen($duration) == self::LENGTH_DURATION_TIME_STRING){
            $valid_length = true;
        }else{
            //nothing to do 
        }

        return $valid_length;
    }



    /*
    * validate if content aproach is valid
    * @param string content_aproached
    * @return boolean $content_aproached_is_validated
    */
    private function validate_content_aproached($content_aproached){

        $is_null = true;
        $is_null = self::validate_if_content_aproached_is_null($content_aproached);

        $valid_length = false;
        $valid_length = self::validate_lenght_of_content_aproached($content_aproached);

        $content_aproached_is_validated = false;
        if($is_null == false && $valid_length == true){
            $content_aproached_is_validated = true;
            Log::info("content_aproached is valid");
        }else{
            $content_aproached_is_validated = false;
            Log::info("content_aproached is NOT valid");
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
    * @return boolean $valid_lenght
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