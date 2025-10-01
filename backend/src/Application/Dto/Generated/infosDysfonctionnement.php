<?php

class infosDysfonctionnement
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
   * @var appareil $Appareil
   * @access public
   */
  public $Appareil = null;

  /**
   * 
   * @var dysfonctionnement $Dysfonctionnement
   * @access public
   */
  public $Dysfonctionnement = null;

  /**
   * 
   * @param logement $Logement
   * @param occupant $Occupant
   * @param appareil $Appareil
   * @param dysfonctionnement $Dysfonctionnement
   * @access public
   */
  public function __construct($Logement, $Occupant, $Appareil, $Dysfonctionnement)
  {
    $this->Logement = $Logement;
    $this->Occupant = $Occupant;
    $this->Appareil = $Appareil;
    $this->Dysfonctionnement = $Dysfonctionnement;
  }

}
