<?php

class infosAppareilEAU
{

  /**
   * 
   * @var appareil $Appareil
   * @access public
   */
  public $Appareil = null;

  /**
   * 
   * @var serie $SerieConsos
   * @access public
   */
  public $SerieConsos = null;

  /**
   * 
   * @var indexReleve $R6
   * @access public
   */
  public $R6 = null;

  /**
   * 
   * @var indexReleve $R5
   * @access public
   */
  public $R5 = null;

  /**
   * 
   * @var indexReleve $R4
   * @access public
   */
  public $R4 = null;

  /**
   * 
   * @var indexReleve $R3
   * @access public
   */
  public $R3 = null;

  /**
   * 
   * @var indexReleve $R2
   * @access public
   */
  public $R2 = null;

  /**
   * 
   * @var indexReleve $R1
   * @access public
   */
  public $R1 = null;

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
   * @param appareil $Appareil
   * @param serie $SerieConsos
   * @param indexReleve $R6
   * @param indexReleve $R5
   * @param indexReleve $R4
   * @param indexReleve $R3
   * @param indexReleve $R2
   * @param indexReleve $R1
   * @param int $NbFuites
   * @param int $NbDepannages
   * @param int $NbDysfonctionnements
   * @param int $NbAnomalies
   * @access public
   */
  public function __construct($Appareil, $SerieConsos, $R6, $R5, $R4, $R3, $R2, $R1, $NbFuites, $NbDepannages, $NbDysfonctionnements, $NbAnomalies)
  {
    $this->Appareil = $Appareil;
    $this->SerieConsos = $SerieConsos;
    $this->R6 = $R6;
    $this->R5 = $R5;
    $this->R4 = $R4;
    $this->R3 = $R3;
    $this->R2 = $R2;
    $this->R1 = $R1;
    $this->NbFuites = $NbFuites;
    $this->NbDepannages = $NbDepannages;
    $this->NbDysfonctionnements = $NbDysfonctionnements;
    $this->NbAnomalies = $NbAnomalies;
  }

}
