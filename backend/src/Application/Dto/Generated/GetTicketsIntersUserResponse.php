<?php

class GetTicketsIntersUserResponse
{

  /**
   * 
   * @var ticketsInter $GetTicketsIntersUserResult
   * @access public
   */
  public $GetTicketsIntersUserResult = null;

  /**
   * 
   * @param ticketsInter $GetTicketsIntersUserResult
   * @access public
   */
  public function __construct($GetTicketsIntersUserResult)
  {
    $this->GetTicketsIntersUserResult = $GetTicketsIntersUserResult;
  }

}
