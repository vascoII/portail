<?php

class CreateGestionnaireResponse
{

  /**
   * 
   * @var boolean $CreateGestionnaireResult
   * @access public
   */
  public $CreateGestionnaireResult = null;

  /**
   * 
   * @param boolean $CreateGestionnaireResult
   * @access public
   */
  public function __construct($CreateGestionnaireResult)
  {
    $this->CreateGestionnaireResult = $CreateGestionnaireResult;
  }

}
