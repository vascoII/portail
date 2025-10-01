<?php

class Logout
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
   * @param string $SessionID
   * @param int $PkUser
   * @access public
   */
  public function __construct($SessionID, $PkUser)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
  }

}
