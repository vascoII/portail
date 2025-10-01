<?php

class GetInfosAnomaliesByImmeubleResponse
{

  /**
   * 
   * @var infosAnomalies $GetInfosAnomaliesByImmeubleResult
   * @access public
   */
  public $GetInfosAnomaliesByImmeubleResult = null;

  /**
   * 
   * @param infosAnomalies $GetInfosAnomaliesByImmeubleResult
   * @access public
   */
  public function __construct($GetInfosAnomaliesByImmeubleResult)
  {
    $this->GetInfosAnomaliesByImmeubleResult = $GetInfosAnomaliesByImmeubleResult;
  }

}
