<?php

class GetExcel
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
   * @var string $ReportType
   * @access public
   */
  public $ReportType = null;

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
   * @param string $ReportType
   * @param string $ParamsFiltres
   * @access public
   */
  public function __construct($SessionID, $PkUser, $ReportType, $ParamsFiltres)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->ReportType = $ReportType;
    $this->ParamsFiltres = $ParamsFiltres;
  }

}
