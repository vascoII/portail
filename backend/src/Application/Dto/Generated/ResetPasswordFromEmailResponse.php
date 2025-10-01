<?php

class ResetPasswordFromEmailResponse
{

  /**
   * 
   * @var user $ResetPasswordFromEmailResult
   * @access public
   */
  public $ResetPasswordFromEmailResult = null;

  /**
   * 
   * @param user $ResetPasswordFromEmailResult
   * @access public
   */
  public function __construct($ResetPasswordFromEmailResult)
  {
    $this->ResetPasswordFromEmailResult = $ResetPasswordFromEmailResult;
  }

}
