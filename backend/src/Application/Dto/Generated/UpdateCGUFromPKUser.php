<?php

class UpdateCGUFromPKUser
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
   * @var string $CGU
   * @access public
   */
  public $CGU = null;

  /**
   * 
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param int $PKUser
   * @param string $CGU
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $PKUser, $CGU)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->PKUser = $PKUser;
    $this->CGU = $CGU;
  }

}
