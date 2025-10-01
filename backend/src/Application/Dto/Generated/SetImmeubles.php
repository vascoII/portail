<?php

class SetImmeubles
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
   * @var string $ListImmeubles
   * @access public
   */
  public $ListImmeubles = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param int $PkUserChild
   * @param string $ListImmeubles
   * @access public
   */
  public function __construct($SessionID, $PkUser, $PkUserChild, $ListImmeubles)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->PkUserChild = $PkUserChild;
    $this->ListImmeubles = $ListImmeubles;
  }

}
