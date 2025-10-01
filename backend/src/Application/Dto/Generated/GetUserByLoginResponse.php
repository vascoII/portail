<?php

class GetUserByLoginResponse
{

  /**
   * 
   * @var user $GetUserByLoginResult
   * @access public
   */
  public $GetUserByLoginResult = null;

  /**
   * 
   * @param user $GetUserByLoginResult
   * @access public
   */
  public function __construct($GetUserByLoginResult)
  {
    $this->GetUserByLoginResult = $GetUserByLoginResult;
  }

}
