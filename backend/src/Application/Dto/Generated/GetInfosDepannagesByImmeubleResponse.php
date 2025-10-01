<?php

class GetInfosDepannagesByImmeubleResponse
{

  /**
   * 
   * @var infosDepannages $GetInfosDepannagesByImmeubleResult
   * @access public
   */
  public $GetInfosDepannagesByImmeubleResult = null;

  /**
   * 
   * @param infosDepannages $GetInfosDepannagesByImmeubleResult
   * @access public
   */
  public function __construct($GetInfosDepannagesByImmeubleResult)
  {
    $this->GetInfosDepannagesByImmeubleResult = $GetInfosDepannagesByImmeubleResult;
  }

}
