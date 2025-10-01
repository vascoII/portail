<?php

class GetInfosDysfonctionnementsByImmeuble
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
   * @var string $ParamsFiltres
   * @access public
   */
  public $ParamsFiltres = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param int $PkImmeuble
   * @param string $ParamsFiltres
   * @access public
   */
  public function __construct($SessionID, $PkUser, $PkImmeuble, $ParamsFiltres)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->PkImmeuble = $PkImmeuble;
    $this->ParamsFiltres = $ParamsFiltres;
  }

}
