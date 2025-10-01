<?php

class infosDysfonctionnements
{

  /**
   * 
   * @var InfosDysfonctionnement[] $ListeInfosDysfonctionnements
   * @access public
   */
  public $ListeInfosDysfonctionnements = null;

  /**
   * 
   * @param InfosDysfonctionnement[] $ListeInfosDysfonctionnements
   * @access public
   */
  public function __construct($ListeInfosDysfonctionnements)
  {
    $this->ListeInfosDysfonctionnements = $ListeInfosDysfonctionnements;
  }

}
