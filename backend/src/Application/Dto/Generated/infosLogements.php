<?php

class infosLogements
{

  /**
   * 
   * @var InfosLogement[] $ListeInfosLogements
   * @access public
   */
  public $ListeInfosLogements = null;

  /**
   * 
   * @param InfosLogement[] $ListeInfosLogements
   * @access public
   */
  public function __construct($ListeInfosLogements)
  {
    $this->ListeInfosLogements = $ListeInfosLogements;
  }

}
