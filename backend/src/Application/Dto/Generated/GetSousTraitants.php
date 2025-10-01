<?php

class GetSousTraitants
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
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
  }

}
