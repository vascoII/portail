<?php

class CreateTicketInterResponse
{

  /**
   * 
   * @var int $CreateTicketInterResult
   * @access public
   */
  public $CreateTicketInterResult = null;

  /**
   * 
   * @param int $CreateTicketInterResult
   * @access public
   */
  public function __construct($CreateTicketInterResult)
  {
    $this->CreateTicketInterResult = $CreateTicketInterResult;
  }

}
