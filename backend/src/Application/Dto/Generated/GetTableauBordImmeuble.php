<?php

class GetTableauBordImmeuble
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
   * @var int $PkImmeuble
   * @access public
   */
  public $PkImmeuble = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param int $PkImmeuble
   * @access public
   */
  public function __construct($SessionID, $PkUser, $PkImmeuble)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->PkImmeuble = $PkImmeuble;
  }

}
