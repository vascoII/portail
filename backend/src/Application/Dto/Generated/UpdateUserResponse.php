<?php

class UpdateUserResponse
{

  /**
   * 
   * @var retour $UpdateUserResult
   * @access public
   */
  public $UpdateUserResult = null;

  /**
   * 
   * @param retour $UpdateUserResult
   * @access public
   */
  public function __construct($UpdateUserResult)
  {
    $this->UpdateUserResult = $UpdateUserResult;
  }

}
