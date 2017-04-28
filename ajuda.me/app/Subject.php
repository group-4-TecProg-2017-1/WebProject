<?php

namespace App;

class Subject extends Model
{
    private $subject_id;
    private $subject_name;

    public function setSubjectId($subject_id)
    {
        $this->subject_id = $subject_id;
    }
    public function getSubjectId()
    {
        return $this->subject_id;
    }

    public function setSubjectName($subject_name)
    {
        $this->subject_name = $subject_name;
    }

    public function getSubjectName()
    {
        return $this->subject_name;
    }
}
