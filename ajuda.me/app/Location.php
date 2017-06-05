<?php

/**
* Class Location
*
* This Class is responsible to answer the data requests from the locations
* view by retrieving the information from the MySQL database.
*
*/
namespace App;

class Location extends Model
{
    private $location_id;
    private $description;
    private $building;
    private $room;


    public function setLocationID($location_id)
    {
      $this->location_id = $location_id;
    }
    public function getLocationID()
    {
      return $this->location_id;
    }
    public function setLocationDescription($description)
    {
      $this->description = $description;
    }
    public function getLocationDescription()
    {
      return $this->description;
    }
    public function setLocationBuilding($building)
    {
      $this->building = $building;
    }
    public function getLocationBuilding()
    {
      return $this->building;
    }
    public function setLocationRoom($room)
    {
      $this->room = $room;
    }
    public function getLocationRoom()
    {
      return $this->room;
    }
}
