<?php

class GetUsersResponse
{

  /**
   * 
   * @var users $GetUsersResult
   * @access public
   */
  public $GetUsersResult = null;

  /**
   * 
   * @param users $GetUsersResult
   * @access public
   */
  public function __construct($GetUsersResult)
  {
    $this->GetUsersResult = $GetUsersResult;
  }

}
