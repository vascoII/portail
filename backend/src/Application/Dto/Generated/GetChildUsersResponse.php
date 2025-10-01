<?php

class GetChildUsersResponse
{

  /**
   * 
   * @var users $GetChildUsersResult
   * @access public
   */
  public $GetChildUsersResult = null;

  /**
   * 
   * @param users $GetChildUsersResult
   * @access public
   */
  public function __construct($GetChildUsersResult)
  {
    $this->GetChildUsersResult = $GetChildUsersResult;
  }

}
