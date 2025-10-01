<?php

class SetSeuilConsoResponse
{

  /**
   * 
   * @var retour $SetSeuilConsoResult
   * @access public
   */
  public $SetSeuilConsoResult = null;

  /**
   * 
   * @param retour $SetSeuilConsoResult
   * @access public
   */
  public function __construct($SetSeuilConsoResult)
  {
    $this->SetSeuilConsoResult = $SetSeuilConsoResult;
  }

}
