<?php

class infosDepannages
{

  /**
   * 
   * @var InfosDepannage[] $ListeInfosDepannages
   * @access public
   */
  public $ListeInfosDepannages = null;

  /**
   * 
   * @param InfosDepannage[] $ListeInfosDepannages
   * @access public
   */
  public function __construct($ListeInfosDepannages)
  {
    $this->ListeInfosDepannages = $ListeInfosDepannages;
  }

}
