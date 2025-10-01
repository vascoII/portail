<?php

class GetInfosAppareilsByLogementElect
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
   * @var string $ParamsInfos
   * @access public
   */
  public $ParamsInfos = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param int $PkLogement
   * @param string $ParamsInfos
   * @access public
   */
  public function __construct($SessionID, $PkUser, $PkLogement, $ParamsInfos)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->PkLogement = $PkLogement;
    $this->ParamsInfos = $ParamsInfos;
  }

}
