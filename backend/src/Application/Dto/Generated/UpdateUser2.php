<?php

class UpdateUser2
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
   * @var string $UserName
   * @access public
   */
  public $UserName = null;

  /**
   * 
   * @var string $FirstName
   * @access public
   */
  public $FirstName = null;

  /**
   * 
   * @var string $PhoneNumber
   * @access public
   */
  public $PhoneNumber = null;

  /**
   * 
   * @var string $Email
   * @access public
   */
  public $Email = null;

  /**
   * 
   * @var string $UserRole
   * @access public
   */
  public $UserRole = null;

  /**
   * 
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param int $PkUser
   * @param string $UserName
   * @param string $FirstName
   * @param string $PhoneNumber
   * @param string $Email
   * @param string $UserRole
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $PkUser, $UserName, $FirstName, $PhoneNumber, $Email, $UserRole)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->PkUser = $PkUser;
    $this->UserName = $UserName;
    $this->FirstName = $FirstName;
    $this->PhoneNumber = $PhoneNumber;
    $this->Email = $Email;
    $this->UserRole = $UserRole;
  }

}
