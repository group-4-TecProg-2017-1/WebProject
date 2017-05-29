<?php
namespace App;

class Monitoring extends Model
{
    private $monitoring_id;
    private $contentApproached;
    private $type;
    private $startTime;
    private $duration;
    private $id_location;
    private $id_courses;


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
    public function setIdCourses($id_courses)
    {
      $this->id_location = $id_location;
    }
    public function getIdCourses($id_courses)
    {
      return $this->id_courses;
    }

    public function monitors()
    {
      return $this->belongsToMany('App\User', 'user_monitoring', 
      'id_monitoring' ,'id_user')
      -> withTimestamps();
    }
}
