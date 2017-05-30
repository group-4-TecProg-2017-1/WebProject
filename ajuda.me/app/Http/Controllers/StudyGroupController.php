<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

class StudyGroupController extends Controller
{

    const LOG_MESSAGE = 'Study group view reached (index).';
      
   
	/**
    * Display a listing study groups.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        Log::info(self::LOG_MESSAGE);
        
        return view('study_group.index', compact('courses'));
    }

    
}