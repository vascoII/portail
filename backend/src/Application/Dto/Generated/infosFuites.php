<?php

class infosFuites
{

  /**
   * 
   * @var InfosFuite[] $ListeInfosFuites
   * @access public
   */
  public $ListeInfosFuites = null;

  /**
   * 
   * @param InfosFuite[] $ListeInfosFuites
   * @access public
   */
  public function __construct($ListeInfosFuites)
  {
    $this->ListeInfosFuites = $ListeInfosFuites;
  }

}
