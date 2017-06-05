<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use App\Location;
use App\StudyGroup;
use App\User;
use App\Course;

class StudyGroupController extends Controller
{

    CONST LOG_MESSAGE = 'Study group view reached (index).';
    CONST LOG_FUNCTION_CREATE_PAGE = 'Function to redirect to study group create page has been reached';
    CONST LOG_ELSE_CREATE_STUDY_GROUP_PAGE = 'Else condition of create study group page.';
      
   
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

        if (count($locations) != 0){
            
            $selectedLocation = User::first()->location_id;
            $monitors = User::where('role', 'monitor')->get();
            $selectedMonitors = User::first()->user_id;
            $study_groups = StudyGroup::orderBy('id' , 'asc')->get();
            $page_to_redirect = view('study_group.create' , compact('locations' , 'selectedLocation'  
                                  , 'monitors' , 'selectedMonitors'));
        }else{
            Log::info(self::LOG_ELSE_CREATE_STUDY_GROUP_PAGE);
            $page_to_redirect = view('study_group.index');
        }

        return $page_to_redirect;
    }


}