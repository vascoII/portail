<?php

class InsertReportToken
{

  /**
   * 
   * @var string $SessionID
   * @access public
   */
  public $SessionID = null;

  /**
   * 
   * @var string $reportType
   * @access public
   */
  public $reportType = null;

  /**
   * 
   * @var string $param
   * @access public
   */
  public $param = null;

  /**
   * 
   * @param string $SessionID
   * @param string $reportType
   * @param string $param
   * @access public
   */
  public function __construct($SessionID, $reportType, $param)
  {
    $this->SessionID = $SessionID;
    $this->reportType = $reportType;
    $this->param = $param;
  }

}
