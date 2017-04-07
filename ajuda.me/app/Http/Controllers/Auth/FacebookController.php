<?php
namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;

use Socialite;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;


class FacebookController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | FacebookController
    |--------------------------------------------------------------------------
    |
    | This controller handles the login when using the facebook button, it
    | creates a user if not created yet.
    |
    */

    protected $redirectTo = '/home';
    /**
     * Redirect the user to the facebook authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
     * Obtain the user information from Facebook.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('facebook')->user();

        //$checkUser = $this->user->findOrCreateSocialUser('facebook', $user->id, $user);

        // $user->token;
    }
}