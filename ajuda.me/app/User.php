<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','avatar_url', 'first_name', 'last_name', 'status', 'account_type', 'sns_acc_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function findOrCreateSocialUser($type, $id, $userObj) {

        $user = $this->model
            ->where('account_type', $type)
            ->where('sns_acc_id', $id)
            ->first();

        if($user){
            return $user;
        }

        if($type == 'facebook') {
            $user = $this->createFacebookUser($userObj);
        }        
    }

    private function createFacebookUser($userObj){
        $userData = [
        'name' => isset($userObj->name) ? $userObj->name : '',
        'email' => isset($userObj->email) ? $userObj->email : '',
        'avatar_url' => isset($userObj->avatar_original) ? $userObj->avatar_original : '',
        'snc_acc_id' => $userObj->id,
        ];

        return $this->create($userData, '');
    }
}
