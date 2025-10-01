<?php

class GetHelloResponse
{

  /**
   * 
   * @var string $GetHelloResult
   * @access public
   */
  public $GetHelloResult = null;

  /**
   * 
   * @param string $GetHelloResult
   * @access public
   */
  public function __construct($GetHelloResult)
  {
    $this->GetHelloResult = $GetHelloResult;
  }

}
