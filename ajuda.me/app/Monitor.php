<?php

namespace App;

class Monitor extends Model
{
    private $monitor_id;
    private $monitor_name;
    private $course_id;

    public function setMonitorId($monitor_id)
    {
        $this->monitor_id = $monitor_id;
    }

    public function getMonitorId()
    {
        return $this->monitor_id;
    }

    public function setMonitorName($monitor_name)
    {
        $this->monitor_name = $monitor_name;
    }

    public function getMonitorName()
    {
        return $this->monitor_name;
    }

    public function setMonitorCourseId($course_id)
    {
        $this->course_id = $course_id;
    }

    public function getMonitorCourseId()
    {
        return $this->course_id;
    }
}
