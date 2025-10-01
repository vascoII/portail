<?php

class infosLogement
{

  /**
   * 
   * @var immeuble $Immeuble
   * @access public
   */
  public $Immeuble = null;

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
   * @var int $NbAppareils
   * @access public
   */
  public $NbAppareils = null;

  /**
   * 
   * @var int $NbCompteursEC
   * @access public
   */
  public $NbCompteursEC = null;

  /**
   * 
   * @var int $NbCompteursEF
   * @access public
   */
  public $NbCompteursEF = null;

  /**
   * 
   * @var int $NbCompteursRepart
   * @access public
   */
  public $NbCompteursRepart = null;

  /**
   * 
   * @var int $NbCompteursCET
   * @access public
   */
  public $NbCompteursCET = null;

  /**
   * 
   * @var int $NbCompteursCapteur
   * @access public
   */
  public $NbCompteursCapteur = null;

  /**
   * 
   * @var int $NbCompteursElect
   * @access public
   */
  public $NbCompteursElect = null;

  /**
   * 
   * @var int $NbCompteursGaz
   * @access public
   */
  public $NbCompteursGaz = null;

  /**
   * 
   * @var int $NbFuites
   * @access public
   */
  public $NbFuites = null;

  /**
   * 
   * @var int $NbDepannages
   * @access public
   */
  public $NbDepannages = null;

  /**
   * 
   * @var int $NbDysfonctionnements
   * @access public
   */
  public $NbDysfonctionnements = null;

  /**
   * 
   * @var int $NbAnomalies
   * @access public
   */
  public $NbAnomalies = null;

  /**
   * 
   * @var int $NbTicketsInter
   * @access public
   */
  public $NbTicketsInter = null;

  /**
   * 
   * @var boolean $TicketsInterEnabled
   * @access public
   */
  public $TicketsInterEnabled = null;

  /**
   * 
   * @var Appareil[] $ListeAppareils
   * @access public
   */
  public $ListeAppareils = null;

  /**
   * 
   * @param immeuble $Immeuble
   * @param logement $Logement
   * @param occupant $Occupant
   * @param int $NbAppareils
   * @param int $NbCompteursEC
   * @param int $NbCompteursEF
   * @param int $NbCompteursRepart
   * @param int $NbCompteursCET
   * @param int $NbCompteursCapteur
   * @param int $NbCompteursElect
   * @param int $NbCompteursGaz
   * @param int $NbFuites
   * @param int $NbDepannages
   * @param int $NbDysfonctionnements
   * @param int $NbAnomalies
   * @param int $NbTicketsInter
   * @param boolean $TicketsInterEnabled
   * @param Appareil[] $ListeAppareils
   * @access public
   */
  public function __construct($Immeuble, $Logement, $Occupant, $NbAppareils, $NbCompteursEC, $NbCompteursEF, $NbCompteursRepart, $NbCompteursCET, $NbCompteursCapteur, $NbCompteursElect, $NbCompteursGaz, $NbFuites, $NbDepannages, $NbDysfonctionnements, $NbAnomalies, $NbTicketsInter, $TicketsInterEnabled, $ListeAppareils)
  {
    $this->Immeuble = $Immeuble;
    $this->Logement = $Logement;
    $this->Occupant = $Occupant;
    $this->NbAppareils = $NbAppareils;
    $this->NbCompteursEC = $NbCompteursEC;
    $this->NbCompteursEF = $NbCompteursEF;
    $this->NbCompteursRepart = $NbCompteursRepart;
    $this->NbCompteursCET = $NbCompteursCET;
    $this->NbCompteursCapteur = $NbCompteursCapteur;
    $this->NbCompteursElect = $NbCompteursElect;
    $this->NbCompteursGaz = $NbCompteursGaz;
    $this->NbFuites = $NbFuites;
    $this->NbDepannages = $NbDepannages;
    $this->NbDysfonctionnements = $NbDysfonctionnements;
    $this->NbAnomalies = $NbAnomalies;
    $this->NbTicketsInter = $NbTicketsInter;
    $this->TicketsInterEnabled = $TicketsInterEnabled;
    $this->ListeAppareils = $ListeAppareils;
  }

}
