<?php

class DeleteUserResponse
{

  /**
   * 
   * @var retour $DeleteUserResult
   * @access public
   */
  public $DeleteUserResult = null;

  /**
   * 
   * @param retour $DeleteUserResult
   * @access public
   */
  public function __construct($DeleteUserResult)
  {
    $this->DeleteUserResult = $DeleteUserResult;
  }

}
