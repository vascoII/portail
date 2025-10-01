<?php

class UpdateEmailFromPKUserResponse
{

  /**
   * 
   * @var user $UpdateEmailFromPKUserResult
   * @access public
   */
  public $UpdateEmailFromPKUserResult = null;

  /**
   * 
   * @param user $UpdateEmailFromPKUserResult
   * @access public
   */
  public function __construct($UpdateEmailFromPKUserResult)
  {
    $this->UpdateEmailFromPKUserResult = $UpdateEmailFromPKUserResult;
  }

}
