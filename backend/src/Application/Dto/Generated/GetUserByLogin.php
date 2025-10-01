<?php

class GetUserByLogin
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
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param string $LoginID
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $LoginID)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->LoginID = $LoginID;
  }

}
