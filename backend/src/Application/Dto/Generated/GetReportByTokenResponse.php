<?php

class GetReportByTokenResponse
{

  /**
   * 
   * @var base64Binary $GetReportByTokenResult
   * @access public
   */
  public $GetReportByTokenResult = null;

  /**
   * 
   * @param base64Binary $GetReportByTokenResult
   * @access public
   */
  public function __construct($GetReportByTokenResult)
  {
    $this->GetReportByTokenResult = $GetReportByTokenResult;
  }

}
