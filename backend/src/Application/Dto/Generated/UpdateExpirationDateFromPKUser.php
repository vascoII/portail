<?php

class UpdateExpirationDateFromPKUser
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
   * @var dateTime $date
   * @access public
   */
  public $date = null;

  /**
   * 
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param int $PKUser
   * @param dateTime $date
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $PKUser, $date)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->PKUser = $PKUser;
    $this->date = $date;
  }

}
