<?php

class getCase
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
   * @var string $Id
   * @access public
   */
  public $Id = null;

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
   * @param string $Id
   * @param string $Email
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $Id, $Email)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->Id = $Id;
    $this->Email = $Email;
  }

}
