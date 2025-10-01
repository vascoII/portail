<?php

class GetReportResponse
{

  /**
   * 
   * @var base64Binary $GetReportResult
   * @access public
   */
  public $GetReportResult = null;

  /**
   * 
   * @param base64Binary $GetReportResult
   * @access public
   */
  public function __construct($GetReportResult)
  {
    $this->GetReportResult = $GetReportResult;
  }

}
