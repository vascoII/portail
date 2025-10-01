<?php

class immeubleEAU
{

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
   * @var chantier $Chantier
   * @access public
   */
  public $Chantier = null;

  /**
   * 
   * @var topConsos $TopConsos
   * @access public
   */
  public $TopConsos = null;

  /**
   * 
   * @var serie $SerieConsos1
   * @access public
   */
  public $SerieConsos1 = null;

  /**
   * 
   * @var serie $SerieConsos2
   * @access public
   */
  public $SerieConsos2 = null;

  /**
   * 
   * @var Releve[] $ListeReleves
   * @access public
   */
  public $ListeReleves = null;

  /**
   * 
   * @param int $NbCompteursARelever
   * @param int $NbCompteursReleves
   * @param int $NbFuites
   * @param int $DegresFuites
   * @param int $NbAnomalies
   * @param int $DegresAnomalies
   * @param chantier $Chantier
   * @param topConsos $TopConsos
   * @param serie $SerieConsos1
   * @param serie $SerieConsos2
   * @param Releve[] $ListeReleves
   * @access public
   */
  public function __construct($NbCompteursARelever, $NbCompteursReleves, $NbFuites, $DegresFuites, $NbAnomalies, $DegresAnomalies, $Chantier, $TopConsos, $SerieConsos1, $SerieConsos2, $ListeReleves)
  {
    $this->NbCompteursARelever = $NbCompteursARelever;
    $this->NbCompteursReleves = $NbCompteursReleves;
    $this->NbFuites = $NbFuites;
    $this->DegresFuites = $DegresFuites;
    $this->NbAnomalies = $NbAnomalies;
    $this->DegresAnomalies = $DegresAnomalies;
    $this->Chantier = $Chantier;
    $this->TopConsos = $TopConsos;
    $this->SerieConsos1 = $SerieConsos1;
    $this->SerieConsos2 = $SerieConsos2;
    $this->ListeReleves = $ListeReleves;
  }

}
