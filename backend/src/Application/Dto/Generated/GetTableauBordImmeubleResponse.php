<?php

class GetTableauBordImmeubleResponse
{

  /**
   * 
   * @var tableauDeBordImmeuble $GetTableauBordImmeubleResult
   * @access public
   */
  public $GetTableauBordImmeubleResult = null;

  /**
   * 
   * @param tableauDeBordImmeuble $GetTableauBordImmeubleResult
   * @access public
   */
  public function __construct($GetTableauBordImmeubleResult)
  {
    $this->GetTableauBordImmeubleResult = $GetTableauBordImmeubleResult;
  }

}
