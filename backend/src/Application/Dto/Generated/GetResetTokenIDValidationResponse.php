<?php

class GetResetTokenIDValidationResponse
{

  /**
   * 
   * @var retour $GetResetTokenIDValidationResult
   * @access public
   */
  public $GetResetTokenIDValidationResult = null;

  /**
   * 
   * @param retour $GetResetTokenIDValidationResult
   * @access public
   */
  public function __construct($GetResetTokenIDValidationResult)
  {
    $this->GetResetTokenIDValidationResult = $GetResetTokenIDValidationResult;
  }

}
