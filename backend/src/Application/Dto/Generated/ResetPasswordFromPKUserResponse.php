<?php

class ResetPasswordFromPKUserResponse
{

  /**
   * 
   * @var user $ResetPasswordFromPKUserResult
   * @access public
   */
  public $ResetPasswordFromPKUserResult = null;

  /**
   * 
   * @param user $ResetPasswordFromPKUserResult
   * @access public
   */
  public function __construct($ResetPasswordFromPKUserResult)
  {
    $this->ResetPasswordFromPKUserResult = $ResetPasswordFromPKUserResult;
  }

}
