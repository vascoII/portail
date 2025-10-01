<?php

class CreateDirecteurResponse
{

  /**
   * 
   * @var boolean $CreateDirecteurResult
   * @access public
   */
  public $CreateDirecteurResult = null;

  /**
   * 
   * @param boolean $CreateDirecteurResult
   * @access public
   */
  public function __construct($CreateDirecteurResult)
  {
    $this->CreateDirecteurResult = $CreateDirecteurResult;
  }

}
