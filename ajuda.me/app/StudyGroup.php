<?php
namespace App;

class StudyGroup extends Model
{
    private $study_group_id = null;
    private $email_user_creator = null;
    private $content_approached = null;
    private $start_time = null;
    private $duration = null;
    private $id_location = null;

    
    public function set_email_user_creator($email_user_creator){
      $this->email_user_creator = $email_user_creator;
    }

    public function get_email_user_creator(){
      return $this->email_user_creator;
    }

    public function set_study_group_id($study_group_id){
      $this->study_group_id = $study_group_id;
    }

    public function get_study_group_id(){
      return $this->study_group_id;
    }

    public function set_content_approached($content_approached){
      $this->content_approached = $content_approached;
    }

    public function get_content_approached(){
      return $this->content_approached;
    }

    public function set_start_time($start_time){
      $this->start_time = $start_time;
    }

    public function get_start_time(){
      return $this->start_time;
    }

    public function set_duration($duration){
      $this->duration = $duration;
    }

    public function get_duration(){
      return $this->duration;
    }

    public function set_id_location($id_location){
      $this->id_location = $id_location;
    }

     public function get_id_location(){
      return $this->id_location;
    }
}
