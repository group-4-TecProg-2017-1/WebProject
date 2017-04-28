<?php

namespace App;

class Course extends Model
{
    private $course_id;
    private $name;

    public function setCourseId($course_id)
    {
        $this->course_id = $course_id;
    }

    public function getCourseId()
    {
        return $this->course_id;
    }

    public function setCourseName($course_name)
    {
        $this->course_name = $course_name;
    }

    public function getCourseName()
    {
        return $this->course_name;
    }
}
