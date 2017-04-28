<?php

namespace App;

class Monitoring extends Model
{
    private $monitoring_id;
    private $place;
    private $subject;
    private $starting_time;
    private $duration;
    private $course_id;
    private $monitor_id;

    public function setMonitoringId($monitoring_id)
    {
        $this->monitoring_id = $monitoring_id;
    }

    public function getMonitoringId()
    {
        return $this->monitoring_id;
    }

    public function setMonitoringPlace($place)
    {
        $this->place = $place;
    }

    public function getMonitoringPlace()
    {
        return $this->place;
    }

    public function setMonitoringSubject($subject)
    {
        $this->subject = $subject;
    }

    public function getMonitoringSubject()
    {
        return $this->subject;
    }

    public function setMonitoringStartingTime($starting_time)
    {
        $this->starting_time = $starting_time;
    }

    public function getMonitoringStartingTime()
    {
        return $this->starting_time;
    }

    public function setMonitoringDuration($duration)
    {
        $this->duration = $duration;
    }

    public function getMonitoringDuration()
    {
        return $this->duration;
    }

    public function setMonitoringCourseId($course_id)
    {
        $this->course_id = $course_id;
    }

    public function getMonitoringCourseId()
    {
        return $this->course_id;
    }

    public function setMonitoringMonitorId($monitor_id)
    {
        $this->monitor_id = $monitor_id;
    }

    public function getMonitoringMonitorId()
    {
        return $this->monitor_id;
    }
}
