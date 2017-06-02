<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\UserMonitoring;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Facades\Log;

class UsersController extends Controller
{   

    CONST LOG_DESTROY = 'Method destroy on UsersController has been reached.';
    CONST LOG_DESTROY_USER_MONITORING = "The method destroUserMonitoringById has been reached.";
    CONST LOG_USER_MONITORING_DELETED = "The user_monitoring row has been deleted.";

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
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        Log::info(self::LOG_DESTROY);

        #self::destroy_user_monitoring_by_id($id);


        $user = User::find($id);
        $user->delete();

        return redirect('/users')->with('status', 'Sucessfuly deleted user!');
    }

    /**
    * Delete user_monitoring by id
    * @param int $id
    */
    private function destroy_user_monitoring_by_id($id)
    {
        Log::info(self::LOG_DESTROY_USER_MONITORING);
        $user_monitoring = UserMonitoring::find($id);
        $user_monitoring->delete();
        Log::info(self::LOG_USER_MONITORING_DELETED);
    }


}
