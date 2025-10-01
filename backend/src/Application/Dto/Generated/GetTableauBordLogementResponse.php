<?php

class GetTableauBordLogementResponse
{

  /**
   * 
   * @var tableauDeBordLogement $GetTableauBordLogementResult
   * @access public
   */
  public $GetTableauBordLogementResult = null;

  /**
   * 
   * @param tableauDeBordLogement $GetTableauBordLogementResult
   * @access public
   */
  public function __construct($GetTableauBordLogementResult)
  {
    $this->GetTableauBordLogementResult = $GetTableauBordLogementResult;
  }

}
