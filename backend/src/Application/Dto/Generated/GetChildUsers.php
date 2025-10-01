<?php

class GetChildUsers
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
   * @var string $type
   * @access public
   */
  public $type = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param string $type
   * @access public
   */
  public function __construct($SessionID, $PkUser, $type)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->type = $type;
  }

}
