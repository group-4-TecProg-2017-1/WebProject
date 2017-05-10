<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monitoring;
use App\Monitor;

class MonitoringsController extends Controller
{
    /**
     * Display a listing of monitorings.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monitorings = Monitoring::orderBy('id', 'asc')->get();

        return view('monitorings.index', compact('monitorings'));
    }

    /**
     * Show the form for creating a new monitoring.
     *
     * @return \Illuminate\Http\Response
     */
    public function createOptionView() 
    {
        define("VIEW_TO_REDIRECT" , "/monitorings/create");
        define("OPTION_ONE" , "option1");
        
        $value_one =  OPTION_ONE;
        
        return view(VIEW_TO_REDIRECT , compact('value_one'));
    }

    /**
     * Store a newly created monitoring in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Monitoring::create([
          'id' => request('id'),
          'place' => request('place'),
          'contentApproached' => request('contentApproached'),
          'durationTime' => request('durationTime'),
          'startTime' => request('startTime')
        ]);

        return redirect('/monitorings');
    }

    /**
     * Display the specified monitoring.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($monitoring_id)
    {
        //
    }

    /**
     * Show the form for editing the specified monitoring.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified monitoring in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified monitoring from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
