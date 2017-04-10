<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MonitorsController extends Controller
{
    /**
     * Display a listing of the monitors.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $monitors = Monitor::orderBy('id', 'asc')->get();

        return view('monitors.index', compact('monitors'));
    }

    /**
     * Show the form for creating a new monitor.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('monitors.create');
    }

    /**
     * Store a newly created monitor in database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Monitor::create([
          'id' => Auth::id();

        ]);

        return redirect('/monitors');
    }

    /**
     * Display the specified monitor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($monitorId)
    {
        $monitor = Monitor::where('id', (integer) $monitorId)
            ->first();

        return view('monitors.show', compact('monitor'));
    }

    /**
     * Show the form for editing the specified monitor.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified monitor in database.
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
     * Remove the specified monitor from database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
