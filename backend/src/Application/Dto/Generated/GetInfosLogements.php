<?php

class GetInfosLogements
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
   * @var string $ParamsInfos
   * @access public
   */
  public $ParamsInfos = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param string $ParamsFiltres
   * @param string $ParamsInfos
   * @access public
   */
  public function __construct($SessionID, $PkUser, $ParamsFiltres, $ParamsInfos)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->ParamsFiltres = $ParamsFiltres;
    $this->ParamsInfos = $ParamsInfos;
  }

}
