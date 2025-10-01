<?php

class UpdatePassword
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
   * @var string $Password
   * @access public
   */
  public $Password = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param int $PkUserChild
   * @param string $Password
   * @access public
   */
  public function __construct($SessionID, $PkUser, $PkUserChild, $Password)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->PkUserChild = $PkUserChild;
    $this->Password = $Password;
  }

}
