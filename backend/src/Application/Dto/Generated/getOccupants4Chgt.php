<?php

class getOccupants4Chgt
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
   * @var int $PkImmeuble
   * @access public
   */
  public $PkImmeuble = null;

  /**
   * 
   * @var int $PkOccupant
   * @access public
   */
  public $PkOccupant = null;

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
   * @param int $PkImmeuble
   * @param int $PkOccupant
   * @param boolean $isNew
   * @access public
   */
  public function __construct($SessionID, $PkUser, $PkImmeuble, $PkOccupant, $isNew)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->PkImmeuble = $PkImmeuble;
    $this->PkOccupant = $PkOccupant;
    $this->isNew = $isNew;
  }

}
