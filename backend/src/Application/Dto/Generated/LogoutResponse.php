<?php

class LogoutResponse
{

  /**
   * 
   * @var boolean $LogoutResult
   * @access public
   */
  public $LogoutResult = null;

  /**
   * 
   * @param boolean $LogoutResult
   * @access public
   */
  public function __construct($LogoutResult)
  {
    $this->LogoutResult = $LogoutResult;
  }

}
