<?php

class GetTicketInterInitResponse
{

  /**
   * 
   * @var ticketInterInit $GetTicketInterInitResult
   * @access public
   */
  public $GetTicketInterInitResult = null;

  /**
   * 
   * @param ticketInterInit $GetTicketInterInitResult
   * @access public
   */
  public function __construct($GetTicketInterInitResult)
  {
    $this->GetTicketInterInitResult = $GetTicketInterInitResult;
  }

}
