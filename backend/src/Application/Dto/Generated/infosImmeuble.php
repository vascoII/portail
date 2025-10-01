<?php

class infosImmeuble
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
   * @var int $NbChantiers
   * @access public
   */
  public $NbChantiers = null;

  /**
   * 
   * @param immeuble $Immeuble
   * @param int $NbLogements
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
   * @param int $NbChantiers
   * @access public
   */
  public function __construct($Immeuble, $NbLogements, $NbAppareils, $NbCompteursEC, $NbCompteursEF, $NbCompteursRepart, $NbCompteursCET, $NbCompteursCapteur, $NbCompteursElect, $NbCompteursGaz, $NbFuites, $NbDepannages, $NbDysfonctionnements, $NbAnomalies, $NbChantiers)
  {
    $this->Immeuble = $Immeuble;
    $this->NbLogements = $NbLogements;
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
    $this->NbChantiers = $NbChantiers;
  }

}
