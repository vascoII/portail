<?php

class GetUsersBigDataResponse
{

  /**
   * 
   * @var usersBigData $GetUsersBigDataResult
   * @access public
   */
  public $GetUsersBigDataResult = null;

  /**
   * 
   * @param usersBigData $GetUsersBigDataResult
   * @access public
   */
  public function __construct($GetUsersBigDataResult)
  {
    $this->GetUsersBigDataResult = $GetUsersBigDataResult;
  }

}
