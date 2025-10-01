<?php

class DeleteUser
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
   * @var int $PkUserChild
   * @access public
   */
  public $PkUserChild = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param int $PkUserChild
   * @access public
   */
  public function __construct($SessionID, $PkUser, $PkUserChild)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->PkUserChild = $PkUserChild;
  }

}
