<?php

class infosAppareilsElect
{

  /**
   * 
   * @var InfosAppareilElect[] $ListeInfosAppareils
   * @access public
   */
  public $ListeInfosAppareils = null;

  /**
   * 
   * @param InfosAppareilElect[] $ListeInfosAppareils
   * @access public
   */
  public function __construct($ListeInfosAppareils)
  {
    $this->ListeInfosAppareils = $ListeInfosAppareils;
  }

}
