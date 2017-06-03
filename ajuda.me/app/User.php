<?php
namespace App;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
class User extends Authenticatable
{
    use Notifiable;
    private $name;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role',
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function getUserName()
    {
        return $this->name;
    }
    public function setUserName($name)
    {
        $this->name = $name;
    }
    public function setUserID($user_id)
    {
      $this->user_id = $user_id;
    }
    public function getUserID()
    {
      return $this->user_id;
    }
     public function courses()
    {
      return $this->belongsToMany('App\User', 'user_course', 
      'course_id' ,'id_user')
      -> withTimestamps();
    }
}