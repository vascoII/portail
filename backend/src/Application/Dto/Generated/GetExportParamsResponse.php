<?php

class GetExportParamsResponse
{

  /**
   * 
   * @var userExportParams $GetExportParamsResult
   * @access public
   */
  public $GetExportParamsResult = null;

  /**
   * 
   * @param userExportParams $GetExportParamsResult
   * @access public
   */
  public function __construct($GetExportParamsResult)
  {
    $this->GetExportParamsResult = $GetExportParamsResult;
  }

}
