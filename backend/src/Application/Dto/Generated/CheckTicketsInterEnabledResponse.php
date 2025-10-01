<?php

class CheckTicketsInterEnabledResponse
{

  /**
   * 
   * @var boolean $CheckTicketsInterEnabledResult
   * @access public
   */
  public $CheckTicketsInterEnabledResult = null;

  /**
   * 
   * @param boolean $CheckTicketsInterEnabledResult
   * @access public
   */
  public function __construct($CheckTicketsInterEnabledResult)
  {
    $this->CheckTicketsInterEnabledResult = $CheckTicketsInterEnabledResult;
  }

}
