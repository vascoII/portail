<?php

class GetTableauBordClientResponse
{

  /**
   * 
   * @var tableauDeBordClient $GetTableauBordClientResult
   * @access public
   */
  public $GetTableauBordClientResult = null;

  /**
   * 
   * @param tableauDeBordClient $GetTableauBordClientResult
   * @access public
   */
  public function __construct($GetTableauBordClientResult)
  {
    $this->GetTableauBordClientResult = $GetTableauBordClientResult;
  }

}
