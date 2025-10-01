<?php

class GetStatClientResponse
{

  /**
   * 
   * @var UserLog[] $GetStatClientResult
   * @access public
   */
  public $GetStatClientResult = null;

  /**
   * 
   * @param UserLog[] $GetStatClientResult
   * @access public
   */
  public function __construct($GetStatClientResult)
  {
    $this->GetStatClientResult = $GetStatClientResult;
  }

}
