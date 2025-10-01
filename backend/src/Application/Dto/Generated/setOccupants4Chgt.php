<?php

class setOccupants4Chgt
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
   * @var Occupant4Chgt[] $occupants
   * @access public
   */
  public $occupants = null;

  /**
   * 
   * @var boolean $isNew
   * @access public
   */
  public $isNew = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param Occupant4Chgt[] $occupants
   * @param boolean $isNew
   * @access public
   */
  public function __construct($SessionID, $PkUser, $occupants, $isNew)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->occupants = $occupants;
    $this->isNew = $isNew;
  }

}
