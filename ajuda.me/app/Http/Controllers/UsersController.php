<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

/**
 * This class receives requests from views, retrieves requested information
 * from database and redirect to views.
 *
 */
class UsersController extends Controller
{
    public $log;
    public function __construct()
    {
        $this->log = new Logger('my_app');
        $this->log->pushHandler(new StreamHandler(__DIR__.'/my_app.log', Logger::DEBUG));
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('id', 'asc')->get();
        $this->log->info('Got users successfully');
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'role' => 'in:admin,monitor,student',
        ]);

        User::create([
          'name' => request('name'),
          'email' => request('email'),
          'password' => bcrypt('123456'),
          'role' => request('role'),
        ]);

        return redirect('/users')->with('status', 'Successful created user!');
    }

    /**
     * Display the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->name = request('name');
        $user->email = request('email');
        $user->role = request('role');
        $user->save();

        return redirect('/users')->with('status', 'Successfuly updated user!');
    }

    /**
     * Remove the specified user from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('status', 'Sucessfuly deleted user!');
    }
}
