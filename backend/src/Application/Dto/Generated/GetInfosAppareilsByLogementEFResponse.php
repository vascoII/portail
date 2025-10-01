<?php

class GetInfosAppareilsByLogementEFResponse
{

  /**
   * 
   * @var infosAppareilsEAU $GetInfosAppareilsByLogementEFResult
   * @access public
   */
  public $GetInfosAppareilsByLogementEFResult = null;

  /**
   * 
   * @param infosAppareilsEAU $GetInfosAppareilsByLogementEFResult
   * @access public
   */
  public function __construct($GetInfosAppareilsByLogementEFResult)
  {
    $this->GetInfosAppareilsByLogementEFResult = $GetInfosAppareilsByLogementEFResult;
  }

}
