<?php

class SetImmeublesResponse
{

  /**
   * 
   * @var retour $SetImmeublesResult
   * @access public
   */
  public $SetImmeublesResult = null;

  /**
   * 
   * @param retour $SetImmeublesResult
   * @access public
   */
  public function __construct($SetImmeublesResult)
  {
    $this->SetImmeublesResult = $SetImmeublesResult;
  }

}
