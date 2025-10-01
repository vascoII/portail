<?php

class session
{

  /**
   * 
   * @var boolean $Connected
   * @access public
   */
  public $Connected = null;

  /**
   * 
   * @var string $SessionID
   * @access public
   */
  public $SessionID = null;

  /**
   * 
   * @var user $User
   * @access public
   */
  public $User = null;

  /**
   * 
   * @param boolean $Connected
   * @param string $SessionID
   * @param user $User
   * @access public
   */
  public function __construct($Connected, $SessionID, $User)
  {
    $this->Connected = $Connected;
    $this->SessionID = $SessionID;
    $this->User = $User;
  }

}
