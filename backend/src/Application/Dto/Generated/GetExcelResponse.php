<?php

class GetExcelResponse
{

  /**
   * 
   * @var base64Binary $GetExcelResult
   * @access public
   */
  public $GetExcelResult = null;

  /**
   * 
   * @param base64Binary $GetExcelResult
   * @access public
   */
  public function __construct($GetExcelResult)
  {
    $this->GetExcelResult = $GetExcelResult;
  }

}
