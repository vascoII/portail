<?php

class GetStatOccupants2Response
{

  /**
   * 
   * @var UserLog[] $GetStatOccupants2Result
   * @access public
   */
  public $GetStatOccupants2Result = null;

  /**
   * 
   * @param UserLog[] $GetStatOccupants2Result
   * @access public
   */
  public function __construct($GetStatOccupants2Result)
  {
    $this->GetStatOccupants2Result = $GetStatOccupants2Result;
  }

}
