<?php

class GetLoginTokenResponse
{

  /**
   * 
   * @var string $GetLoginTokenResult
   * @access public
   */
  public $GetLoginTokenResult = null;

  /**
   * 
   * @param string $GetLoginTokenResult
   * @access public
   */
  public function __construct($GetLoginTokenResult)
  {
    $this->GetLoginTokenResult = $GetLoginTokenResult;
  }

}
