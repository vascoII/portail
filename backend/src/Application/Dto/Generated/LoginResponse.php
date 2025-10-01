<?php

class LoginResponse
{

  /**
   * 
   * @var session $LoginResult
   * @access public
   */
  public $LoginResult = null;

  /**
   * 
   * @param session $LoginResult
   * @access public
   */
  public function __construct($LoginResult)
  {
    $this->LoginResult = $LoginResult;
  }

}
