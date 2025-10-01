<?php

class tableauDeBordLogement
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
   * @var int $NbDepannages
   * @access public
   */
  public $NbDepannages = null;

  /**
   * 
   * @var int $NbDepannagesTotal
   * @access public
   */
  public $NbDepannagesTotal = null;

  /**
   * 
   * @var int $NbDysfonctionnements
   * @access public
   */
  public $NbDysfonctionnements = null;

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
   * @var logementEAU $LogementEC
   * @access public
   */
  public $LogementEC = null;

  /**
   * 
   * @var logementEAU $LogementEF
   * @access public
   */
  public $LogementEF = null;

  /**
   * 
   * @var logementRepart $LogementRepart
   * @access public
   */
  public $LogementRepart = null;

  /**
   * 
   * @var logementCET $LogementCET
   * @access public
   */
  public $LogementCET = null;

  /**
   * 
   * @var logementCapteur $LogementCapteur
   * @access public
   */
  public $LogementCapteur = null;

  /**
   * 
   * @var logementElect $LogementElect
   * @access public
   */
  public $LogementElect = null;

  /**
   * 
   * @var logementGaz $LogementGaz
   * @access public
   */
  public $LogementGaz = null;

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
   * @param int $NbDepannages
   * @param int $NbDepannagesTotal
   * @param int $NbDysfonctionnements
   * @param int $NbTicketsInter
   * @param boolean $TicketsInterEnabled
   * @param logementEAU $LogementEC
   * @param logementEAU $LogementEF
   * @param logementRepart $LogementRepart
   * @param logementCET $LogementCET
   * @param logementCapteur $LogementCapteur
   * @param logementElect $LogementElect
   * @param logementGaz $LogementGaz
   * @access public
   */
  public function __construct($Immeuble, $Logement, $Occupant, $NbAppareils, $NbCompteursEC, $NbCompteursEF, $NbCompteursRepart, $NbCompteursCET, $NbCompteursCapteur, $NbCompteursElect, $NbCompteursGaz, $NbDepannages, $NbDepannagesTotal, $NbDysfonctionnements, $NbTicketsInter, $TicketsInterEnabled, $LogementEC, $LogementEF, $LogementRepart, $LogementCET, $LogementCapteur, $LogementElect, $LogementGaz)
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
    $this->NbDepannages = $NbDepannages;
    $this->NbDepannagesTotal = $NbDepannagesTotal;
    $this->NbDysfonctionnements = $NbDysfonctionnements;
    $this->NbTicketsInter = $NbTicketsInter;
    $this->TicketsInterEnabled = $TicketsInterEnabled;
    $this->LogementEC = $LogementEC;
    $this->LogementEF = $LogementEF;
    $this->LogementRepart = $LogementRepart;
    $this->LogementCET = $LogementCET;
    $this->LogementCapteur = $LogementCapteur;
    $this->LogementElect = $LogementElect;
    $this->LogementGaz = $LogementGaz;
  }

}
