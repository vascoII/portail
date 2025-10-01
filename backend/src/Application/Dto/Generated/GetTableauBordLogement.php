<?php

class GetTableauBordLogement
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
   * @var int $PkOccupant
   * @access public
   */
  public $PkOccupant = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param int $PkLogement
   * @param int $PkOccupant
   * @access public
   */
  public function __construct($SessionID, $PkUser, $PkLogement, $PkOccupant)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->PkLogement = $PkLogement;
    $this->PkOccupant = $PkOccupant;
  }

}
