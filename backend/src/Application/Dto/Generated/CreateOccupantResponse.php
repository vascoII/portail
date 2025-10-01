<?php

class CreateOccupantResponse
{

  /**
   * 
   * @var boolean $CreateOccupantResult
   * @access public
   */
  public $CreateOccupantResult = null;

  /**
   * 
   * @param boolean $CreateOccupantResult
   * @access public
   */
  public function __construct($CreateOccupantResult)
  {
    $this->CreateOccupantResult = $CreateOccupantResult;
  }

}
