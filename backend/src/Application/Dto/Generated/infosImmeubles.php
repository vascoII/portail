<?php

class infosImmeubles
{

  /**
   * 
   * @var InfosImmeuble[] $ListeInfosImmeubles
   * @access public
   */
  public $ListeInfosImmeubles = null;

  /**
   * 
   * @param InfosImmeuble[] $ListeInfosImmeubles
   * @access public
   */
  public function __construct($ListeInfosImmeubles)
  {
    $this->ListeInfosImmeubles = $ListeInfosImmeubles;
  }

}
