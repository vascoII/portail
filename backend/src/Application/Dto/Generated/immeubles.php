<?php

class immeubles
{

  /**
   * 
   * @var Immeuble[] $ListeImmeubles
   * @access public
   */
  public $ListeImmeubles = null;

  /**
   * 
   * @param Immeuble[] $ListeImmeubles
   * @access public
   */
  public function __construct($ListeImmeubles)
  {
    $this->ListeImmeubles = $ListeImmeubles;
  }

}
