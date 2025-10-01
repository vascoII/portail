<?php

class GetInfosLogementsResponse
{

  /**
   * 
   * @var infosLogements $GetInfosLogementsResult
   * @access public
   */
  public $GetInfosLogementsResult = null;

  /**
   * 
   * @param infosLogements $GetInfosLogementsResult
   * @access public
   */
  public function __construct($GetInfosLogementsResult)
  {
    $this->GetInfosLogementsResult = $GetInfosLogementsResult;
  }

}
