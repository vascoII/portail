<?php

class CreateOccupant
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
   * @var string $LoginID
   * @access public
   */
  public $LoginID = null;

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
   * @var int $fk
   * @access public
   */
  public $fk = null;

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
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param string $LoginID
   * @param string $UserName
   * @param string $FirstName
   * @param int $fk
   * @param string $PhoneNumber
   * @param string $Email
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $LoginID, $UserName, $FirstName, $fk, $PhoneNumber, $Email)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->LoginID = $LoginID;
    $this->UserName = $UserName;
    $this->FirstName = $FirstName;
    $this->fk = $fk;
    $this->PhoneNumber = $PhoneNumber;
    $this->Email = $Email;
  }

}
