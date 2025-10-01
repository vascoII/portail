<?php

class ResetPasswordFromEmail
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
   * @var string $Email
   * @access public
   */
  public $Email = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param string $Email
   * @access public
   */
  public function __construct($SessionID, $PkUser, $Email)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->Email = $Email;
  }

}
