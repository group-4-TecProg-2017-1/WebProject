<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use Illuminate\Support\Facades\Auth;
use App\StudyGroup;
use Illuminate\Support\Facades\Log;

class LocationsController extends Controller
{
    /**
     * Display a listing of the locations.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::orderBy('id', 'asc')->get();
        $user = Auth::user()->role;

        return view('locations.index', compact('locations', 'user'));
    }

    /**
     * Show the form for creating a new location.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('locations.create');
    }

    /**
     * Store a newly created location in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Location::create([
            'id' => request('id'),
            'description' => request('description'),
            'building' => request('building'),
            'room' => request('room'),
        ]);

        return redirect('/locations')->with('status', 'Successfuly created location!');
    }

    /**
     * Show the form for editing the specified location.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $location = Location::find($id);
        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified location in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $location = Location::find($id);
        $location->description = request('description');
        $location->building = request('building');
        $location->room = request('room');
        $location->save();

        return redirect('/locations')->with('status', 'Successfuly updated location!');
    }

    /**
     * Remove the specified location from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::find($id);

        self::delete_all_related_study_groups($id);
        $location->delete();
        return redirect('/locations')->with('status', 'Sucessfuly deleted locations!');
    }

    /*
    *   Delete all the study groups related to an location
    *   @param int $id_location
    *   @return void
    */
    private function delete_all_related_study_groups($id_location){
        Log::info('on delete related StudyGroup with location');
        $study_groups = StudyGroup::where('id_location', $id_location)->get();

        Log::info('number os study groups');
        Log:info(count($study_groups));
        foreach ($study_groups as $study_group) {
            $study_group->delete();
        }
        Log::info('number os study groups');
        Log::info(count($study_groups));
    }
}
