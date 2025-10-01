<?php

class GetNbTicketsInterByLogement
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
   * @var int $PkLogement
   * @access public
   */
  public $PkLogement = null;

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
   * @param int $PkLogement
   * @param string $ParamsFiltres
   * @access public
   */
  public function __construct($SessionID, $PkUser, $PkLogement, $ParamsFiltres)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->PkLogement = $PkLogement;
    $this->ParamsFiltres = $ParamsFiltres;
  }

}
