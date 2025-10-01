<?php

class GetImmeublesByPKUserResponse
{

  /**
   * 
   * @var immeubles $GetImmeublesByPKUserResult
   * @access public
   */
  public $GetImmeublesByPKUserResult = null;

  /**
   * 
   * @param immeubles $GetImmeublesByPKUserResult
   * @access public
   */
  public function __construct($GetImmeublesByPKUserResult)
  {
    $this->GetImmeublesByPKUserResult = $GetImmeublesByPKUserResult;
  }

}
