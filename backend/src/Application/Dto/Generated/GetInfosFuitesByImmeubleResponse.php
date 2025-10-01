<?php

class GetInfosFuitesByImmeubleResponse
{

  /**
   * 
   * @var infosFuites $GetInfosFuitesByImmeubleResult
   * @access public
   */
  public $GetInfosFuitesByImmeubleResult = null;

  /**
   * 
   * @param infosFuites $GetInfosFuitesByImmeubleResult
   * @access public
   */
  public function __construct($GetInfosFuitesByImmeubleResult)
  {
    $this->GetInfosFuitesByImmeubleResult = $GetInfosFuitesByImmeubleResult;
  }

}
