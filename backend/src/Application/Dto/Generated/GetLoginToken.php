<?php

class GetLoginToken
{

  /**
   * 
   * @var string $SuperLoginID
   * @access public
   */
  public $SuperLoginID = null;

  /**
   * 
   * @var string $SuperPassword
   * @access public
   */
  public $SuperPassword = null;

  /**
   * 
   * @var int $PkUser
   * @access public
   */
  public $PkUser = null;

  /**
   * 
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param int $PkUser
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $PkUser)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->PkUser = $PkUser;
  }

}
