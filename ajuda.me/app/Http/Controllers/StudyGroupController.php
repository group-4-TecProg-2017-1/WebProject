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

/**
* Control all the needs about study group, like create, delete, search, show and all
* methods to validate the informations related
*/
class StudyGroupController extends Controller
{
    CONST MAX_LENGHT_CONTENT_APPROACHED = 255;
    CONST MIN_LENGHT_CONTENT_APPROACHED = 3;
    CONST LENGTH_DURATION_TIME_STRING = 5;
    CONST LOWER_ACEPTED_HOUR = 00;
    CONST HIGHER_ACEPTED_HOUR = 23;
    CONST EMAIL_DATABASE_ATRIBUTE = 'email_user_creator';
    CONST CONTENT_APPROACHED_DATABASE_ATRIBUTE = 'contentApproached';
    CONST START_TIME_DATABASE_ATRIBUTE = 'startTime';
    CONST DURATION_DATABASE_ATRIBUTE = 'duration';
    CONST ID_LOCATION_DATABASE_ATRIBUTE = 'id_location';
    CONST SIZE_OF_CORRECT_DATE_TIME = 16;
    CONST INITIAL_INDEX = 0;
    CONST END_OF_DAY_INDEX = 10;
    CONST TIME_SYMBOL = 'T';
    CONST INITIAL_TIME_INDEX = 11;
    CONST END_OF_TIME_INDEX = 5;
    CONST NULL_CONTENT_APROACHED = "O conteúdo abordado não pode ser nulo, deve existir alguma informação.";
    CONST ERROR_LENGTH_CONTENT_APROACHED = "O conteúdo abordado deve estar entre 3 e 255 caracteres.";
    CONST ERROR_INVALID_LENGTH = "Duração inválida. (HH:MM)";
    CONST ERROR_START_TIME = "Tempo de início inválido. (DD/MM/AAAA HH:MM)";


    
    CONST LOG_MESSAGE = 'Study group view reached (index).';
    CONST LOG_FUNCTION_CREATE_PAGE = 'Function to redirect to study group create page has been reached';
    CONST LOG_ELSE_CREATE_STUDY_GROUP_PAGE = 'Else condition of create study group page.';
    CONST LOG_CREATED_STUDY_GROUP = 'The study group has been created succesfully';
    CONST LOG_USER_NOT_CREATED = 'The study group HAS NOT been created';

    // variable of class to store informations about errors to create study group
    public $errors = array(); // the errors start empty
   
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

        // get the email of the current user to see what study groups this user can edit
        $user_email = Auth::user()->email;

        // select the page to redirect as study group index
        $page_to_redirect = null;
        $page_to_redirect = view('study_group.index', compact('rooms' , 'buildings' , 
                                                              'study_groups',  'user_email' ));
        
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
                    $date = new DateTime($study_group->startTime);
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
            Log::info("imprimindo o array de erros");
            Log::info($this->errors);

            $page_to_redirect = view('study_group.create' , compact('locations' , 'selectedLocation'  
                                  , 'monitors' , 'selectedMonitors' ))->with(['errors'=>$this->errors]);
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
    * Store study group on database if all inputed fields are validated
    * @param \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Request $page_to_redirect
    */
    public function check_validation_to_store_study_group(Request $request){

        $study_group = null;
        $study_group = self::createStudyGroup();
        $page_to_redirect = null;

        if($study_group != null){ 

            $check_validation = self::validatesRequestedData($request );

            if($check_validation == true){
                Log::info('all data were inserted correctlly');
                $study_group = self::completeAtributesOfStudyGroup($study_group , $request);
        
                self::store_study_group($study_group);

                $page_to_redirect = redirect('/study_group' );
            }else{
                Log::info('you have inserted incorrect data');

                $page_to_redirect = self::create_study_group_page();
            }
        }else{
           # study group is null and could no be stored on database
        }
        return $page_to_redirect;
    }

    /*
    * Store object study_group on database
    *   @param $study_group
    *   @return void
    */
    private function store_study_group($study_group){
        Log::info('its inside the method store study group on database');
        StudyGroup::create([self::EMAIL_DATABASE_ATRIBUTE => $study_group->email_user_creator, 
                            self::CONTENT_APPROACHED_DATABASE_ATRIBUTE => $study_group->content_approached, 
                            self::START_TIME_DATABASE_ATRIBUTE => $study_group->startTime , 
                            self::DURATION_DATABASE_ATRIBUTE =>$study_group->duration , 
                            self::ID_LOCATION_DATABASE_ATRIBUTE => $study_group->id_location ]);

        Log::info('study_group has been stored on database');
    }

    /*
    * validates request data to fill in study group object 
    *   @param \Illuminate\Http\Request  $request
    *   @return boolean $check_validation  return true if all data are validated, else return false
    */
    private function validatesRequestedData(Request $request ){

        $content_aproached = request('fieldOfContentAproached');
        $valid_content_aproached = self::validate_content_aproached($content_aproached);

        $startTime = request('fieldOfStartTime');
        $valid_start_time = self::validate_start_time($startTime);

        $duration = request('fieldOfDuration');
        $valid_duration = self::validate_duration($duration);

        $check_validation = false;
        if($valid_content_aproached && $valid_duration && $valid_start_time){
            Log::info("all requested data are valid");
            $check_validation = true;
        }else{
             Log::info("requested datas ARE INVALID");
        }
        return $check_validation;
    }

    /*
    * validates the start time inputed.(minimum, maximum limits)
    *   @param DateTime $start_time
    *   @return boolean $valid_start_time
    */
    private function validate_start_time($start_time){

        Log::info("inside the validate start time method");
       
        # check if start time has the correct valid lenght expected
        $valid_length = self::correct_length_start_time($start_time);

        $valid_start_time = false;
        if ($start_time != null && $valid_length){

            # format start time to brazilian to show on screen to user
            $formated_start_time = self::format_date_time_to_brazilian($start_time);
            $valid_start_time = true;
        }else{
            array_push($this->errors , self::ERROR_START_TIME);
            Log::info('start time inputed is null');
            # nothing to do in here
        }

        return  $valid_start_time;

    }

    /*
    * Validates if the lenght of start time is correct
    * @param DateTime $formated_start_time
    * @return boolean $valid_lenght , return true if lenght if equals to 16, (dd-mm-aaaa hh:mm)
    *                                 return false if is different to 16
    */
    private function correct_length_start_time($formated_start_time){
        assert($formated_start_time != null);

        $valid_length = false;
        $size_of_date_time = strlen($formated_start_time);
        if ($size_of_date_time == self::SIZE_OF_CORRECT_DATE_TIME){
            $valid_length = true;
        }else{
            # nothing to do
        }
        return $valid_length;
    }

    /*
    *   format DateTime to brazilian format (d-m-Y H:i) d=dia m=mes Y=ano H=hora i=minuto
    *   @param DateTime #startTime
    *   @return DateTime $formated_date_time
    */
    private function format_date_time_to_brazilian($start_time){
        $formated_start_time  = null;

        try {
            $unformated_start_time = null;
            $unformated_start_time = new DateTime($start_time);
            $formated_start_time = $unformated_start_time->format('d-m-Y H:i');
        }catch (Exception $e) {
            echo $e->getMessage();
            exit(1);
        }

        return $formated_start_time;
    }


    /*
    * check if duration is validated with all required conditions
    * @param string duration
    * @return boolean valid_duration
    */
    private function validate_duration($duration){
        $lenght_validated = false;
        $lenght_validated = self::validate_lenght_of_duration($duration);

        $valid_duration = false;
        if($duration != null && $lenght_validated ){
            $valid_duration = true;
            Log::info("duration is all validated");
        }else{
            array_push($this->errors , self::ERROR_INVALID_LENGTH);
            Log::info("duration has not been validated");
        }

        return $valid_duration;


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
            array_push($this->errors , self::NULL_CONTENT_APROACHED);
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
            array_push($this->errors , self::ERROR_LENGTH_CONTENT_APROACHED);
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

        // get inputed informations
        $content_aproached_inputed = request('fieldOfContentAproached');
        $start_time_inputed = request('fieldOfStartTime');
        $duration_inputed = request('fieldOfDuration');
        $id_location_inputed = request('location_id');

        // fill study group object
        $study_group->content_approached = $content_aproached_inputed;
        $study_group->startTime = $start_time_inputed;
        $study_group->duration = $duration_inputed;
        $study_group->id_location = $id_location_inputed;
        
        return $study_group;
    }

    /**
    * delete study group selected by id
    * @param int $id_study_group
    * @return \Illuminate\Http\Response
    */
    public function deleteStudyGroup($id_study_group){
        assert($id != null , 'id não pode ser nulo');

        Log::info("here inside the delete study_group function");
        $page_to_redirect = null;
        
        $study_group = null;
        $study_group = StudyGroup::find($id_study_group);

        if($study_group != null){
            $study_group->delete();
        }else{
            Log::info("could not delete study group because this id does not exist on database");
        }
        $page_to_redirect = self::index();
        return $page_to_redirect;
    }

    /**
    * redirects to edit page of study group
    * @param int $id_study_group
    * @return \Illuminate\Http\Response
    */
    public function edit_study_group($id_study_group){
        Log::info("inside the function that redirects to edit study_group page");

        $page_to_redirect = null;

        $study_group = StudyGroup::find($id_study_group);
        $selected_location = Location::find($study_group->id_location);
        $locations = Location::orderBy('id', 'asc')->get();

        $start_time = substr($study_group->startTime, self::INITIAL_INDEX, self::END_OF_DAY_INDEX) . self::TIME_SYMBOL . substr($study_group->startTime, self::INITIAL_TIME_INDEX, self::END_OF_TIME_INDEX) ;
        
    
        $page_to_redirect = view('study_group.edit', compact( 'study_group' , 'locations' , 
                                                                'selected_location' , 'start_time'));
        Log::info("redirecting to edit study group page");
        return $page_to_redirect;
    }

}