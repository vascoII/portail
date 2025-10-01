<?php

class CreateOccupants
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
   * @var int $fk
   * @access public
   */
  public $fk = null;

  /**
   * 
   * @var string $type
   * @access public
   */
  public $type = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param int $fk
   * @param string $type
   * @access public
   */
  public function __construct($SessionID, $PkUser, $fk, $type)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->fk = $fk;
    $this->type = $type;
  }

}
