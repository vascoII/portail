<?php

class GetStatOccupantsGraphResponse
{

  /**
   * 
   * @var GraphPoint[] $GetStatOccupantsGraphResult
   * @access public
   */
  public $GetStatOccupantsGraphResult = null;

  /**
   * 
   * @param GraphPoint[] $GetStatOccupantsGraphResult
   * @access public
   */
  public function __construct($GetStatOccupantsGraphResult)
  {
    $this->GetStatOccupantsGraphResult = $GetStatOccupantsGraphResult;
  }

}
