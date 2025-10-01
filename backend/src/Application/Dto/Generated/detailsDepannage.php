<?php

class detailsDepannage
{

  /**
   * 
   * @var infosDepannage $InfosDepannage
   * @access public
   */
  public $InfosDepannage = null;

  /**
   * 
   * @var Depannage[] $ListeDepannagesOccupant
   * @access public
   */
  public $ListeDepannagesOccupant = null;

  /**
   * 
   * @param infosDepannage $InfosDepannage
   * @param Depannage[] $ListeDepannagesOccupant
   * @access public
   */
  public function __construct($InfosDepannage, $ListeDepannagesOccupant)
  {
    $this->InfosDepannage = $InfosDepannage;
    $this->ListeDepannagesOccupant = $ListeDepannagesOccupant;
  }

}
