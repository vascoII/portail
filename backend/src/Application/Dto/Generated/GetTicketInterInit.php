<?php

class GetTicketInterInit
{

  /**
   * 
   * @var string $SessionID
   * @access public
   */
  public $SessionID = null;

  /**
   * 
   * @var int $PkUser
   * @access public
   */
  public $PkUser = null;

  /**
   * 
   * @var int $PkLogement
   * @access public
   */
  public $PkLogement = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param int $PkLogement
   * @access public
   */
  public function __construct($SessionID, $PkUser, $PkLogement)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->PkLogement = $PkLogement;
  }

}
