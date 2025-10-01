<?php

class immeubleCET
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
   * @var serie $SerieConsos
   * @access public
   */
  public $SerieConsos = null;

  /**
   * 
   * @var Releve[] $ListeReleves
   * @access public
   */
  public $ListeReleves = null;

  /**
   * 
   * @var float $Tot_URepart
   * @access public
   */
  public $Tot_URepart = null;

  /**
   * 
   * @var float $Tot_TantChauff
   * @access public
   */
  public $Tot_TantChauff = null;

  /**
   * 
   * @var float $PU_Tant
   * @access public
   */
  public $PU_Tant = null;

  /**
   * 
   * @var float $Prix_URepart
   * @access public
   */
  public $Prix_URepart = null;

  /**
   * 
   * @var float $Prix_Abonn
   * @access public
   */
  public $Prix_Abonn = null;

  /**
   * 
   * @var float $Mont_ARepartTant
   * @access public
   */
  public $Mont_ARepartTant = null;

  /**
   * 
   * @var float $Part_RepartConsos
   * @access public
   */
  public $Part_RepartConsos = null;

  /**
   * 
   * @var float $CT_Combust
   * @access public
   */
  public $CT_Combust = null;

  /**
   * 
   * @var serie $SerieConsosTotale1
   * @access public
   */
  public $SerieConsosTotale1 = null;

  /**
   * 
   * @var serie $SerieConsosTotale2
   * @access public
   */
  public $SerieConsosTotale2 = null;

  /**
   * 
   * @var serie $SerieConsosDJU
   * @access public
   */
  public $SerieConsosDJU = null;

  /**
   * 
   * @param int $NbCompteursARelever
   * @param int $NbCompteursReleves
   * @param chantier $Chantier
   * @param topConsos $TopConsos
   * @param serie $SerieConsos
   * @param Releve[] $ListeReleves
   * @param float $Tot_URepart
   * @param float $Tot_TantChauff
   * @param float $PU_Tant
   * @param float $Prix_URepart
   * @param float $Prix_Abonn
   * @param float $Mont_ARepartTant
   * @param float $Part_RepartConsos
   * @param float $CT_Combust
   * @param serie $SerieConsosTotale1
   * @param serie $SerieConsosTotale2
   * @param serie $SerieConsosDJU
   * @access public
   */
  public function __construct($NbCompteursARelever, $NbCompteursReleves, $Chantier, $TopConsos, $SerieConsos, $ListeReleves, $Tot_URepart, $Tot_TantChauff, $PU_Tant, $Prix_URepart, $Prix_Abonn, $Mont_ARepartTant, $Part_RepartConsos, $CT_Combust, $SerieConsosTotale1, $SerieConsosTotale2, $SerieConsosDJU)
  {
    $this->NbCompteursARelever = $NbCompteursARelever;
    $this->NbCompteursReleves = $NbCompteursReleves;
    $this->Chantier = $Chantier;
    $this->TopConsos = $TopConsos;
    $this->SerieConsos = $SerieConsos;
    $this->ListeReleves = $ListeReleves;
    $this->Tot_URepart = $Tot_URepart;
    $this->Tot_TantChauff = $Tot_TantChauff;
    $this->PU_Tant = $PU_Tant;
    $this->Prix_URepart = $Prix_URepart;
    $this->Prix_Abonn = $Prix_Abonn;
    $this->Mont_ARepartTant = $Mont_ARepartTant;
    $this->Part_RepartConsos = $Part_RepartConsos;
    $this->CT_Combust = $CT_Combust;
    $this->SerieConsosTotale1 = $SerieConsosTotale1;
    $this->SerieConsosTotale2 = $SerieConsosTotale2;
    $this->SerieConsosDJU = $SerieConsosDJU;
  }

}
