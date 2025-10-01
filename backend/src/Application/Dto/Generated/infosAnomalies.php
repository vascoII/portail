<?php

class infosAnomalies
{

  /**
   * 
   * @var InfosAnomalie[] $ListeInfosAnomalies
   * @access public
   */
  public $ListeInfosAnomalies = null;

  /**
   * 
   * @param InfosAnomalie[] $ListeInfosAnomalies
   * @access public
   */
  public function __construct($ListeInfosAnomalies)
  {
    $this->ListeInfosAnomalies = $ListeInfosAnomalies;
  }

}
