<?php

class ResetPasswordFromEmail2Response
{

  /**
   * 
   * @var user $ResetPasswordFromEmail2Result
   * @access public
   */
  public $ResetPasswordFromEmail2Result = null;

  /**
   * 
   * @param user $ResetPasswordFromEmail2Result
   * @access public
   */
  public function __construct($ResetPasswordFromEmail2Result)
  {
    $this->ResetPasswordFromEmail2Result = $ResetPasswordFromEmail2Result;
  }

}
