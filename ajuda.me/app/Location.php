<?php
namespace App;

class Location extends model
{
    private $description;
    private $building;
    private $room;

    public function setLocationDescription()
    {
      $this->description = $description;
    }
    public function getLocationDescription()
    {
      return $this->description;
    }
    public function setLocationBuilding()
    {
      $this->building = $building;
    }
    public function getLocationBuilding()
    {
      return $this->building;
    }
    public function setLocationRoom()
    {
      $this->room = $romm;
    }
    public function getLocationRoom()
    {
      return $this->room;
    }
}
