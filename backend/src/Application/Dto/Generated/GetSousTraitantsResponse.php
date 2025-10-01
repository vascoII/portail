<?php

class GetSousTraitantsResponse
{

  /**
   * 
   * @var SousTraitant[] $GetSousTraitantsResult
   * @access public
   */
  public $GetSousTraitantsResult = null;

  /**
   * 
   * @param SousTraitant[] $GetSousTraitantsResult
   * @access public
   */
  public function __construct($GetSousTraitantsResult)
  {
    $this->GetSousTraitantsResult = $GetSousTraitantsResult;
  }

}
