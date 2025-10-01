<?php

class ResetPasswordResponse
{

  /**
   * 
   * @var retour $ResetPasswordResult
   * @access public
   */
  public $ResetPasswordResult = null;

  /**
   * 
   * @param retour $ResetPasswordResult
   * @access public
   */
  public function __construct($ResetPasswordResult)
  {
    $this->ResetPasswordResult = $ResetPasswordResult;
  }

}
