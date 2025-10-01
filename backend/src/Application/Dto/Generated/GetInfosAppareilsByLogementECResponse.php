<?php

class GetInfosAppareilsByLogementECResponse
{

  /**
   * 
   * @var infosAppareilsEAU $GetInfosAppareilsByLogementECResult
   * @access public
   */
  public $GetInfosAppareilsByLogementECResult = null;

  /**
   * 
   * @param infosAppareilsEAU $GetInfosAppareilsByLogementECResult
   * @access public
   */
  public function __construct($GetInfosAppareilsByLogementECResult)
  {
    $this->GetInfosAppareilsByLogementECResult = $GetInfosAppareilsByLogementECResult;
  }

}
