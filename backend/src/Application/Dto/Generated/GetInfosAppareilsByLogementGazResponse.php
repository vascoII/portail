<?php

class GetInfosAppareilsByLogementGazResponse
{

  /**
   * 
   * @var infosAppareilsGaz $GetInfosAppareilsByLogementGazResult
   * @access public
   */
  public $GetInfosAppareilsByLogementGazResult = null;

  /**
   * 
   * @param infosAppareilsGaz $GetInfosAppareilsByLogementGazResult
   * @access public
   */
  public function __construct($GetInfosAppareilsByLogementGazResult)
  {
    $this->GetInfosAppareilsByLogementGazResult = $GetInfosAppareilsByLogementGazResult;
  }

}
