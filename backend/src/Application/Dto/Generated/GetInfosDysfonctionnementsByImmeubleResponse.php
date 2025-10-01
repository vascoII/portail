<?php

class GetInfosDysfonctionnementsByImmeubleResponse
{

  /**
   * 
   * @var infosDysfonctionnements $GetInfosDysfonctionnementsByImmeubleResult
   * @access public
   */
  public $GetInfosDysfonctionnementsByImmeubleResult = null;

  /**
   * 
   * @param infosDysfonctionnements $GetInfosDysfonctionnementsByImmeubleResult
   * @access public
   */
  public function __construct($GetInfosDysfonctionnementsByImmeubleResult)
  {
    $this->GetInfosDysfonctionnementsByImmeubleResult = $GetInfosDysfonctionnementsByImmeubleResult;
  }

}
