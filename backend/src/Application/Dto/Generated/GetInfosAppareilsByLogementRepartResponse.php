<?php

class GetInfosAppareilsByLogementRepartResponse
{

  /**
   * 
   * @var infosAppareilsRepart $GetInfosAppareilsByLogementRepartResult
   * @access public
   */
  public $GetInfosAppareilsByLogementRepartResult = null;

  /**
   * 
   * @param infosAppareilsRepart $GetInfosAppareilsByLogementRepartResult
   * @access public
   */
  public function __construct($GetInfosAppareilsByLogementRepartResult)
  {
    $this->GetInfosAppareilsByLogementRepartResult = $GetInfosAppareilsByLogementRepartResult;
  }

}
