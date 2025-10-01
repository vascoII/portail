<?php

class retour
{

  /**
   * 
   * @var string $Erreur
   * @access public
   */
  public $Erreur = null;

  /**
   * 
   * @var string $Info
   * @access public
   */
  public $Info = null;

  /**
   * 
   * @param string $Erreur
   * @param string $Info
   * @access public
   */
  public function __construct($Erreur, $Info)
  {
    $this->Erreur = $Erreur;
    $this->Info = $Info;
  }

}
