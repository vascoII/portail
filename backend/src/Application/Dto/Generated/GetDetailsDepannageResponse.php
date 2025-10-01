<?php

class GetDetailsDepannageResponse
{

  /**
   * 
   * @var detailsDepannage $GetDetailsDepannageResult
   * @access public
   */
  public $GetDetailsDepannageResult = null;

  /**
   * 
   * @param detailsDepannage $GetDetailsDepannageResult
   * @access public
   */
  public function __construct($GetDetailsDepannageResult)
  {
    $this->GetDetailsDepannageResult = $GetDetailsDepannageResult;
  }

}
