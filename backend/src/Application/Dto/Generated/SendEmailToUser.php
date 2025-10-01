<?php

class SendEmailToUser
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
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param int $PKUser
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $PKUser)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->PKUser = $PKUser;
  }

}
