<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Monitoring;

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
    public function create()
    {
        return view('monitorings.create');
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
          'contentApproached' => request('contentApproached'),
          'type' => request('type'),
          'startTime' => request('startTime'),
          'duration' => request('duration'),
          'id_location' => request('id_location'),
          'id_courses' => request('id_courses'),
        ]);

        // UserOnMonitoring::create([
        //
        // ]);

        return redirect('/monitorings')->with('status', 'Successfuly created Monitoring!');
    }

    /**
     * Show the form for editing the specified monitoring.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $monitoring = Monitoring::find($id);
        return view('monitorings.edit', compact('monitoring'));
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
