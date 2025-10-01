<?php

class GetStatOccupantsResponse
{

  /**
   * 
   * @var UserLog[] $GetStatOccupantsResult
   * @access public
   */
  public $GetStatOccupantsResult = null;

  /**
   * 
   * @param UserLog[] $GetStatOccupantsResult
   * @access public
   */
  public function __construct($GetStatOccupantsResult)
  {
    $this->GetStatOccupantsResult = $GetStatOccupantsResult;
  }

}
