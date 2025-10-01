<?php

class GetConsoImmeuble
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
   * @var string $type
   * @access public
   */
  public $type = null;

  /**
   * 
   * @var int $nbTop
   * @access public
   */
  public $nbTop = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param int $PkImmeuble
   * @param string $type
   * @param int $nbTop
   * @access public
   */
  public function __construct($SessionID, $PkUser, $PkImmeuble, $type, $nbTop)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->PkImmeuble = $PkImmeuble;
    $this->type = $type;
    $this->nbTop = $nbTop;
  }

}
