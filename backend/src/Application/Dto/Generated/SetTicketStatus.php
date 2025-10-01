<?php

class SetTicketStatus
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
   * @var string $CaseId
   * @access public
   */
  public $CaseId = null;

  /**
   * 
   * @var string $statut
   * @access public
   */
  public $statut = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param string $CaseId
   * @param string $statut
   * @access public
   */
  public function __construct($SessionID, $PkUser, $CaseId, $statut)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->CaseId = $CaseId;
    $this->statut = $statut;
  }

}
