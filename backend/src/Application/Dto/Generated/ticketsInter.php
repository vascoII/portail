<?php

class ticketsInter
{

  /**
   * 
   * @var TicketInter[] $ListeTicketsInter
   * @access public
   */
  public $ListeTicketsInter = null;

  /**
   * 
   * @param TicketInter[] $ListeTicketsInter
   * @access public
   */
  public function __construct($ListeTicketsInter)
  {
    $this->ListeTicketsInter = $ListeTicketsInter;
  }

}
