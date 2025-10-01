<?php

class logementEAU
{

  /**
   * 
   * @var int $NbFuites
   * @access public
   */
  public $NbFuites = null;

  /**
   * 
   * @var int $NbAnomalies
   * @access public
   */
  public $NbAnomalies = null;

  /**
   * 
   * @var consosPeriode $ConsoPeriode
   * @access public
   */
  public $ConsoPeriode = null;

  /**
   * 
   * @var InfosAppareilEAU[] $ListeInfosAppareils
   * @access public
   */
  public $ListeInfosAppareils = null;

  /**
   * 
   * @var serie $SerieConsos
   * @access public
   */
  public $SerieConsos = null;

  /**
   * 
   * @var float $ConsoMemeTypeLogement
   * @access public
   */
  public $ConsoMemeTypeLogement = null;

  /**
   * 
   * @param int $NbFuites
   * @param int $NbAnomalies
   * @param consosPeriode $ConsoPeriode
   * @param InfosAppareilEAU[] $ListeInfosAppareils
   * @param serie $SerieConsos
   * @param float $ConsoMemeTypeLogement
   * @access public
   */
  public function __construct($NbFuites, $NbAnomalies, $ConsoPeriode, $ListeInfosAppareils, $SerieConsos, $ConsoMemeTypeLogement)
  {
    $this->NbFuites = $NbFuites;
    $this->NbAnomalies = $NbAnomalies;
    $this->ConsoPeriode = $ConsoPeriode;
    $this->ListeInfosAppareils = $ListeInfosAppareils;
    $this->SerieConsos = $SerieConsos;
    $this->ConsoMemeTypeLogement = $ConsoMemeTypeLogement;
  }

}
