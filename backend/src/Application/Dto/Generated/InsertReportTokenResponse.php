<?php

class InsertReportTokenResponse
{

  /**
   * 
   * @var string $InsertReportTokenResult
   * @access public
   */
  public $InsertReportTokenResult = null;

  /**
   * 
   * @param string $InsertReportTokenResult
   * @access public
   */
  public function __construct($InsertReportTokenResult)
  {
    $this->InsertReportTokenResult = $InsertReportTokenResult;
  }

}
