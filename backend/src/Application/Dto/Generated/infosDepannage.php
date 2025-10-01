<?php

class infosDepannage
{

  /**
   * 
   * @var logement $Logement
   * @access public
   */
  public $Logement = null;

  /**
   * 
   * @var occupant $Occupant
   * @access public
   */
  public $Occupant = null;

  /**
   * 
   * @var depannage $Depannage
   * @access public
   */
  public $Depannage = null;

  /**
   * 
   * @param logement $Logement
   * @param occupant $Occupant
   * @param depannage $Depannage
   * @access public
   */
  public function __construct($Logement, $Occupant, $Depannage)
  {
    $this->Logement = $Logement;
    $this->Occupant = $Occupant;
    $this->Depannage = $Depannage;
  }

}
