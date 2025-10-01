<?php

class UpdateEmailFromPKUser
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
   * @var int $PKUser
   * @access public
   */
  public $PKUser = null;

  /**
   * 
   * @var string $Email
   * @access public
   */
  public $Email = null;

  /**
   * 
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param int $PKUser
   * @param string $Email
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $PKUser, $Email)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->PKUser = $PKUser;
    $this->Email = $Email;
  }

}
