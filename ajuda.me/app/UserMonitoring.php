<?php

namespace App;

class UserMonitoring extends Model
{
    private $user_id;
    private $monitoring_id;

     public function setUserId($userId)
    {
        $this->user_id = $userId;
    }
    public function getUserId()
    {
        return $this->$user_id;
    }

    public function setMonitoring_id($monitoring_id)
    {
        $this->monitoring_id = $monitoring_id;
    }

    public function getmonitoring_id()
    {
        return $this->monitoring_id;
    }

   
}