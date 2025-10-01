<?php

class tableauDeBordImmeuble
{

  /**
   * 
   * @var immeuble $Immeuble
   * @access public
   */
  public $Immeuble = null;

  /**
   * 
   * @var int $NbLogements
   * @access public
   */
  public $NbLogements = null;

  /**
   * 
   * @var int $NbAppareils
   * @access public
   */
  public $NbAppareils = null;

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
   * @var int $DegresDepannages
   * @access public
   */
  public $DegresDepannages = null;

  /**
   * 
   * @var int $NbDysfonctionnements
   * @access public
   */
  public $NbDysfonctionnements = null;

  /**
   * 
   * @var int $DegresDysfonctionnements
   * @access public
   */
  public $DegresDysfonctionnements = null;

  /**
   * 
   * @var boolean $HasTelereleve
   * @access public
   */
  public $HasTelereleve = null;

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
   * @var int $NbCompteursTelereveleTotal
   * @access public
   */
  public $NbCompteursTelereveleTotal = null;

  /**
   * 
   * @var int $NbCompteursTelereveleOK
   * @access public
   */
  public $NbCompteursTelereveleOK = null;

  /**
   * 
   * @var boolean $HasTransfertFichiers
   * @access public
   */
  public $HasTransfertFichiers = null;

  /**
   * 
   * @var immeubleEAU $ImmeubleEC
   * @access public
   */
  public $ImmeubleEC = null;

  /**
   * 
   * @var immeubleEAU $ImmeubleEF
   * @access public
   */
  public $ImmeubleEF = null;

  /**
   * 
   * @var immeubleRepart $ImmeubleRepart
   * @access public
   */
  public $ImmeubleRepart = null;

  /**
   * 
   * @var immeubleCET $ImmeubleCET
   * @access public
   */
  public $ImmeubleCET = null;

  /**
   * 
   * @var immeubleCapteur $ImmeubleCapteur
   * @access public
   */
  public $ImmeubleCapteur = null;

  /**
   * 
   * @var immeubleElect $ImmeubleElect
   * @access public
   */
  public $ImmeubleElect = null;

  /**
   * 
   * @var immeubleGaz $ImmeubleGaz
   * @access public
   */
  public $ImmeubleGaz = null;

  /**
   * 
   * @var serie $SerieConsosEAU
   * @access public
   */
  public $SerieConsosEAU = null;

  /**
   * 
   * @var serie $SerieConsosCompteurGeneral
   * @access public
   */
  public $SerieConsosCompteurGeneral = null;

  /**
   * 
   * @param immeuble $Immeuble
   * @param int $NbLogements
   * @param int $NbAppareils
   * @param int $NbDepannages
   * @param int $NbDepannagesTotal
   * @param int $DegresDepannages
   * @param int $NbDysfonctionnements
   * @param int $DegresDysfonctionnements
   * @param boolean $HasTelereleve
   * @param int $NbCompteursEC
   * @param int $NbCompteursEF
   * @param int $NbCompteursRepart
   * @param int $NbCompteursCET
   * @param int $NbCompteursCapteur
   * @param int $NbCompteursElect
   * @param int $NbCompteursGaz
   * @param int $NbCompteursTelereveleTotal
   * @param int $NbCompteursTelereveleOK
   * @param boolean $HasTransfertFichiers
   * @param immeubleEAU $ImmeubleEC
   * @param immeubleEAU $ImmeubleEF
   * @param immeubleRepart $ImmeubleRepart
   * @param immeubleCET $ImmeubleCET
   * @param immeubleCapteur $ImmeubleCapteur
   * @param immeubleElect $ImmeubleElect
   * @param immeubleGaz $ImmeubleGaz
   * @param serie $SerieConsosEAU
   * @param serie $SerieConsosCompteurGeneral
   * @access public
   */
  public function __construct($Immeuble, $NbLogements, $NbAppareils, $NbDepannages, $NbDepannagesTotal, $DegresDepannages, $NbDysfonctionnements, $DegresDysfonctionnements, $HasTelereleve, $NbCompteursEC, $NbCompteursEF, $NbCompteursRepart, $NbCompteursCET, $NbCompteursCapteur, $NbCompteursElect, $NbCompteursGaz, $NbCompteursTelereveleTotal, $NbCompteursTelereveleOK, $HasTransfertFichiers, $ImmeubleEC, $ImmeubleEF, $ImmeubleRepart, $ImmeubleCET, $ImmeubleCapteur, $ImmeubleElect, $ImmeubleGaz, $SerieConsosEAU, $SerieConsosCompteurGeneral)
  {
    $this->Immeuble = $Immeuble;
    $this->NbLogements = $NbLogements;
    $this->NbAppareils = $NbAppareils;
    $this->NbDepannages = $NbDepannages;
    $this->NbDepannagesTotal = $NbDepannagesTotal;
    $this->DegresDepannages = $DegresDepannages;
    $this->NbDysfonctionnements = $NbDysfonctionnements;
    $this->DegresDysfonctionnements = $DegresDysfonctionnements;
    $this->HasTelereleve = $HasTelereleve;
    $this->NbCompteursEC = $NbCompteursEC;
    $this->NbCompteursEF = $NbCompteursEF;
    $this->NbCompteursRepart = $NbCompteursRepart;
    $this->NbCompteursCET = $NbCompteursCET;
    $this->NbCompteursCapteur = $NbCompteursCapteur;
    $this->NbCompteursElect = $NbCompteursElect;
    $this->NbCompteursGaz = $NbCompteursGaz;
    $this->NbCompteursTelereveleTotal = $NbCompteursTelereveleTotal;
    $this->NbCompteursTelereveleOK = $NbCompteursTelereveleOK;
    $this->HasTransfertFichiers = $HasTransfertFichiers;
    $this->ImmeubleEC = $ImmeubleEC;
    $this->ImmeubleEF = $ImmeubleEF;
    $this->ImmeubleRepart = $ImmeubleRepart;
    $this->ImmeubleCET = $ImmeubleCET;
    $this->ImmeubleCapteur = $ImmeubleCapteur;
    $this->ImmeubleElect = $ImmeubleElect;
    $this->ImmeubleGaz = $ImmeubleGaz;
    $this->SerieConsosEAU = $SerieConsosEAU;
    $this->SerieConsosCompteurGeneral = $SerieConsosCompteurGeneral;
  }

}
