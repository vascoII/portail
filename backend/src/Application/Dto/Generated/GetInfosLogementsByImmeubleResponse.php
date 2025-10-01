<?php

class GetInfosLogementsByImmeubleResponse
{

  /**
   * 
   * @var infosLogements $GetInfosLogementsByImmeubleResult
   * @access public
   */
  public $GetInfosLogementsByImmeubleResult = null;

  /**
   * 
   * @param infosLogements $GetInfosLogementsByImmeubleResult
   * @access public
   */
  public function __construct($GetInfosLogementsByImmeubleResult)
  {
    $this->GetInfosLogementsByImmeubleResult = $GetInfosLogementsByImmeubleResult;
  }

}
