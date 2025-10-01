<?php

class UpdatePasswordResponse
{

  /**
   * 
   * @var retour $UpdatePasswordResult
   * @access public
   */
  public $UpdatePasswordResult = null;

  /**
   * 
   * @param retour $UpdatePasswordResult
   * @access public
   */
  public function __construct($UpdatePasswordResult)
  {
    $this->UpdatePasswordResult = $UpdatePasswordResult;
  }

}
