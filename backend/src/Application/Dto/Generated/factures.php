<?php

class factures
{

  /**
   * 
   * @var Facture[] $ListeFactures
   * @access public
   */
  public $ListeFactures = null;

  /**
   * 
   * @param Facture[] $ListeFactures
   * @access public
   */
  public function __construct($ListeFactures)
  {
    $this->ListeFactures = $ListeFactures;
  }

}
