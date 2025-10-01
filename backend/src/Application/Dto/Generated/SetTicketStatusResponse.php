<?php

class SetTicketStatusResponse
{

  /**
   * 
   * @var boolean $SetTicketStatusResult
   * @access public
   */
  public $SetTicketStatusResult = null;

  /**
   * 
   * @param boolean $SetTicketStatusResult
   * @access public
   */
  public function __construct($SetTicketStatusResult)
  {
    $this->SetTicketStatusResult = $SetTicketStatusResult;
  }

}
