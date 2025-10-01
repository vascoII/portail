<?php

class Login
{

  /**
   * 
   * @var string $LoginID
   * @access public
   */
  public $LoginID = null;

  /**
   * 
   * @var string $Password
   * @access public
   */
  public $Password = null;

  /**
   * 
   * @param string $LoginID
   * @param string $Password
   * @access public
   */
  public function __construct($LoginID, $Password)
  {
    $this->LoginID = $LoginID;
    $this->Password = $Password;
  }

}
