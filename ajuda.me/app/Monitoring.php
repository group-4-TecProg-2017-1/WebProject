<?php

/**
* Class Monitoring
*
* This Class is responsible to answer the data requests from the monitorings
* view by retrieving the monitoring information from the MySQL database and
* retrieving the related data from the locations and courses classes.
*
*/

namespace App;

class Monitoring extends Model
{
    private $monitoring_id;
    private $contentApproached;
    private $type;
    private $startTime;
    private $duration;
    private $id_location;


    public function setMonitoringID($monitoring_id)
    {
      $this->monitoring_id = $monitoring_id;
    }
    public function getMonitoringID()
    {
      return $this->monitoring_id;
    }
    public function setContentApproached($contentApproached)
    {
      $this->contentApproached = $contentApproached;
    }
    public function getContentApproached()
    {
      return $this->contentApproached;
    }
    public function setType($type)
    {
      $this->type = $type;
    }
    public function getType()
    {
      return $this->type;
    }
    public function setStartTime($startTime)
    {
      $this->startTime = $startTime;
    }
    public function getStartTime()
    {
      return $this->startTime;
    }
    public function setDuration($duration)
    {
      $this->duration = $duration;
    }
    public function getDuration()
    {
      return $this->duration;
    }
    public function setIdLocation($id_location)
    {
      $this->id_location = $id_location;
    }
    public function getIdLocation()
    {
      return $this->id_location;
    }

    public function course()
    {
       return $this->hasMany('App\Course', 'id','courses_id');
    }

    public function monitors()
    {
      return $this->belongsToMany('App\User', 'user_monitoring',
      'id_monitoring' ,'id_user')
      -> withTimestamps();
    }
}
