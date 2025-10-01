<?php

class getCaseResponse
{

  /**
   * 
   * @var caseSF $getCaseResult
   * @access public
   */
  public $getCaseResult = null;

  /**
   * 
   * @param caseSF $getCaseResult
   * @access public
   */
  public function __construct($getCaseResult)
  {
    $this->getCaseResult = $getCaseResult;
  }

}
