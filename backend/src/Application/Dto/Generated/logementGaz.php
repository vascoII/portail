<?php

class logementGaz
{

  /**
   * 
   * @var InfosAppareilGaz[] $ListeInfosAppareils
   * @access public
   */
  public $ListeInfosAppareils = null;

  /**
   * 
   * @param InfosAppareilGaz[] $ListeInfosAppareils
   * @access public
   */
  public function __construct($ListeInfosAppareils)
  {
    $this->ListeInfosAppareils = $ListeInfosAppareils;
  }

}
