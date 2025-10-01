<?php

class getOccupants4ChgtResponse
{

  /**
   * 
   * @var Occupant4Chgt[] $getOccupants4ChgtResult
   * @access public
   */
  public $getOccupants4ChgtResult = null;

  /**
   * 
   * @param Occupant4Chgt[] $getOccupants4ChgtResult
   * @access public
   */
  public function __construct($getOccupants4ChgtResult)
  {
    $this->getOccupants4ChgtResult = $getOccupants4ChgtResult;
  }

}
