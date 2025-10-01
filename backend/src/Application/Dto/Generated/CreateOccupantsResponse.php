<?php

class CreateOccupantsResponse
{

  /**
   * 
   * @var users $CreateOccupantsResult
   * @access public
   */
  public $CreateOccupantsResult = null;

  /**
   * 
   * @param users $CreateOccupantsResult
   * @access public
   */
  public function __construct($CreateOccupantsResult)
  {
    $this->CreateOccupantsResult = $CreateOccupantsResult;
  }

}
