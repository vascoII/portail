<?php

class infosFuite
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
   * @var fuite $Fuite
   * @access public
   */
  public $Fuite = null;

  /**
   * 
   * @param logement $Logement
   * @param occupant $Occupant
   * @param appareil $Appareil
   * @param fuite $Fuite
   * @access public
   */
  public function __construct($Logement, $Occupant, $Appareil, $Fuite)
  {
    $this->Logement = $Logement;
    $this->Occupant = $Occupant;
    $this->Appareil = $Appareil;
    $this->Fuite = $Fuite;
  }

}
