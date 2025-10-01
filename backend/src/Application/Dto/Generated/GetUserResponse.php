<?php

class GetUserResponse
{

  /**
   * 
   * @var user $GetUserResult
   * @access public
   */
  public $GetUserResult = null;

  /**
   * 
   * @param user $GetUserResult
   * @access public
   */
  public function __construct($GetUserResult)
  {
    $this->GetUserResult = $GetUserResult;
  }

}
