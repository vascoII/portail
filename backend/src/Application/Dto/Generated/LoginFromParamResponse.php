<?php

class LoginFromParamResponse
{

  /**
   * 
   * @var session $LoginFromParamResult
   * @access public
   */
  public $LoginFromParamResult = null;

  /**
   * 
   * @param session $LoginFromParamResult
   * @access public
   */
  public function __construct($LoginFromParamResult)
  {
    $this->LoginFromParamResult = $LoginFromParamResult;
  }

}
