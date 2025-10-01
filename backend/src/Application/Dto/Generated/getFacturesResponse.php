<?php

class getFacturesResponse
{

  /**
   * 
   * @var factures $getFacturesResult
   * @access public
   */
  public $getFacturesResult = null;

  /**
   * 
   * @param factures $getFacturesResult
   * @access public
   */
  public function __construct($getFacturesResult)
  {
    $this->getFacturesResult = $getFacturesResult;
  }

}
