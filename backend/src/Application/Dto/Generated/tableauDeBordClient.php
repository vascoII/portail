<?php

class tableauDeBordClient
{

  /**
   * 
   * @var int $NbImmeubles
   * @access public
   */
  public $NbImmeubles = null;

  /**
   * 
   * @var int $NbImmeublesTelereleve
   * @access public
   */
  public $NbImmeublesTelereleve = null;

  /**
   * 
   * @var int $NbImmeublesTransfertFichiers
   * @access public
   */
  public $NbImmeublesTransfertFichiers = null;

  /**
   * 
   * @var int $NbCompteursARelever
   * @access public
   */
  public $NbCompteursARelever = null;

  /**
   * 
   * @var int $NbCompteursReleves
   * @access public
   */
  public $NbCompteursReleves = null;

  /**
   * 
   * @var int $NbLogements
   * @access public
   */
  public $NbLogements = null;

  /**
   * 
   * @var int $NbCompteurs
   * @access public
   */
  public $NbCompteurs = null;

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
   * @var int $DegresFuites
   * @access public
   */
  public $DegresFuites = null;

  /**
   * 
   * @var int $NbDepannages
   * @access public
   */
  public $NbDepannages = null;

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
   * @var int $NbAnomalies
   * @access public
   */
  public $NbAnomalies = null;

  /**
   * 
   * @var int $DegresAnomalies
   * @access public
   */
  public $DegresAnomalies = null;

  /**
   * 
   * @var int $NbChantiers
   * @access public
   */
  public $NbChantiers = null;

  /**
   * 
   * @var int $NbCompteursPoses
   * @access public
   */
  public $NbCompteursPoses = null;

  /**
   * 
   * @var int $NbCompteursCommandes
   * @access public
   */
  public $NbCompteursCommandes = null;

  /**
   * 
   * @param int $NbImmeubles
   * @param int $NbImmeublesTelereleve
   * @param int $NbImmeublesTransfertFichiers
   * @param int $NbCompteursARelever
   * @param int $NbCompteursReleves
   * @param int $NbLogements
   * @param int $NbCompteurs
   * @param int $NbCompteursEC
   * @param int $NbCompteursEF
   * @param int $NbCompteursRepart
   * @param int $NbCompteursCET
   * @param int $NbCompteursCapteur
   * @param int $NbCompteursElect
   * @param int $NbCompteursGaz
   * @param int $NbFuites
   * @param int $DegresFuites
   * @param int $NbDepannages
   * @param int $DegresDepannages
   * @param int $NbDysfonctionnements
   * @param int $DegresDysfonctionnements
   * @param int $NbAnomalies
   * @param int $DegresAnomalies
   * @param int $NbChantiers
   * @param int $NbCompteursPoses
   * @param int $NbCompteursCommandes
   * @access public
   */
  public function __construct($NbImmeubles, $NbImmeublesTelereleve, $NbImmeublesTransfertFichiers, $NbCompteursARelever, $NbCompteursReleves, $NbLogements, $NbCompteurs, $NbCompteursEC, $NbCompteursEF, $NbCompteursRepart, $NbCompteursCET, $NbCompteursCapteur, $NbCompteursElect, $NbCompteursGaz, $NbFuites, $DegresFuites, $NbDepannages, $DegresDepannages, $NbDysfonctionnements, $DegresDysfonctionnements, $NbAnomalies, $DegresAnomalies, $NbChantiers, $NbCompteursPoses, $NbCompteursCommandes)
  {
    $this->NbImmeubles = $NbImmeubles;
    $this->NbImmeublesTelereleve = $NbImmeublesTelereleve;
    $this->NbImmeublesTransfertFichiers = $NbImmeublesTransfertFichiers;
    $this->NbCompteursARelever = $NbCompteursARelever;
    $this->NbCompteursReleves = $NbCompteursReleves;
    $this->NbLogements = $NbLogements;
    $this->NbCompteurs = $NbCompteurs;
    $this->NbCompteursEC = $NbCompteursEC;
    $this->NbCompteursEF = $NbCompteursEF;
    $this->NbCompteursRepart = $NbCompteursRepart;
    $this->NbCompteursCET = $NbCompteursCET;
    $this->NbCompteursCapteur = $NbCompteursCapteur;
    $this->NbCompteursElect = $NbCompteursElect;
    $this->NbCompteursGaz = $NbCompteursGaz;
    $this->NbFuites = $NbFuites;
    $this->DegresFuites = $DegresFuites;
    $this->NbDepannages = $NbDepannages;
    $this->DegresDepannages = $DegresDepannages;
    $this->NbDysfonctionnements = $NbDysfonctionnements;
    $this->DegresDysfonctionnements = $DegresDysfonctionnements;
    $this->NbAnomalies = $NbAnomalies;
    $this->DegresAnomalies = $DegresAnomalies;
    $this->NbChantiers = $NbChantiers;
    $this->NbCompteursPoses = $NbCompteursPoses;
    $this->NbCompteursCommandes = $NbCompteursCommandes;
  }

}
