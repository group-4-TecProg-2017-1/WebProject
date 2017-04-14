<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\StudyGroup;
use Illuminate\Support\Facades\Auth;

class StudyGroupController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $studygroups = StudyGroup::orderBy('id', 'asc')->get();

        return view('studygroups.index', compact('studygroups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('studygroups.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        if (Auth::user())
            {
                StudyGroup::create([
                    'description' => request('description'),
                    'place' => request('place'),
                    'subjects' => request('subjects'),
                    'user_id' => Auth::user()->id,
                ]);
            }

        return redirect('/groups');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

}