<?php

class GetConsoImmeubleResponse
{

  /**
   * 
   * @var topConsos $GetConsoImmeubleResult
   * @access public
   */
  public $GetConsoImmeubleResult = null;

  /**
   * 
   * @param topConsos $GetConsoImmeubleResult
   * @access public
   */
  public function __construct($GetConsoImmeubleResult)
  {
    $this->GetConsoImmeubleResult = $GetConsoImmeubleResult;
  }

}
