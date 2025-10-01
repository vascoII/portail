<?php

class infosAnomalie
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
   * @var anomalie $Anomalie
   * @access public
   */
  public $Anomalie = null;

  /**
   * 
   * @param logement $Logement
   * @param occupant $Occupant
   * @param appareil $Appareil
   * @param anomalie $Anomalie
   * @access public
   */
  public function __construct($Logement, $Occupant, $Appareil, $Anomalie)
  {
    $this->Logement = $Logement;
    $this->Occupant = $Occupant;
    $this->Appareil = $Appareil;
    $this->Anomalie = $Anomalie;
  }

}
