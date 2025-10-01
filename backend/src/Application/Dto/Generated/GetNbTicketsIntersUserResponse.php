<?php

class GetNbTicketsIntersUserResponse
{

  /**
   * 
   * @var int $GetNbTicketsIntersUserResult
   * @access public
   */
  public $GetNbTicketsIntersUserResult = null;

  /**
   * 
   * @param int $GetNbTicketsIntersUserResult
   * @access public
   */
  public function __construct($GetNbTicketsIntersUserResult)
  {
    $this->GetNbTicketsIntersUserResult = $GetNbTicketsIntersUserResult;
  }

}
