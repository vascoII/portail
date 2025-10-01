<?php

class GetInfosImmeublesResponse
{

  /**
   * 
   * @var infosImmeubles $GetInfosImmeublesResult
   * @access public
   */
  public $GetInfosImmeublesResult = null;

  /**
   * 
   * @param infosImmeubles $GetInfosImmeublesResult
   * @access public
   */
  public function __construct($GetInfosImmeublesResult)
  {
    $this->GetInfosImmeublesResult = $GetInfosImmeublesResult;
  }

}
