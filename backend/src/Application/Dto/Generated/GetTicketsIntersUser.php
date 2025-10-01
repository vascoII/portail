<?php

class GetTicketsIntersUser
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
   * @var string $ParamsFiltres
   * @access public
   */
  public $ParamsFiltres = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param string $ParamsFiltres
   * @access public
   */
  public function __construct($SessionID, $PkUser, $ParamsFiltres)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->ParamsFiltres = $ParamsFiltres;
  }

}
