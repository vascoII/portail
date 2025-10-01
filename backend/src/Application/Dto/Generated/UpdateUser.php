<?php

class UpdateUser
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
   * @param string $SessionID
   * @param int $PkUser
   * @param int $PkUserChild
   * @param string $UserName
   * @param string $FirstName
   * @param string $PhoneNumber
   * @param string $Email
   * @param string $UserRole
   * @access public
   */
  public function __construct($SessionID, $PkUser, $PkUserChild, $UserName, $FirstName, $PhoneNumber, $Email, $UserRole)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->PkUserChild = $PkUserChild;
    $this->UserName = $UserName;
    $this->FirstName = $FirstName;
    $this->PhoneNumber = $PhoneNumber;
    $this->Email = $Email;
    $this->UserRole = $UserRole;
  }

}
