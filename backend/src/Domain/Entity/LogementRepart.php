<?php

class logementRepart
{

  /**
   * 
   * @var InfosAppareilRepart[] $ListeInfosAppareils
   * @access public
   */
  public $ListeInfosAppareils = null;

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
   * @var float $URepartLog
   * @access public
   */
  public $URepartLog = null;

  /**
   * 
   * @var float $TantLog
   * @access public
   */
  public $TantLog = null;

  /**
   * 
   * @var float $Prix_ChauffTantLog
   * @access public
   */
  public $Prix_ChauffTantLog = null;

  /**
   * 
   * @var float $CT_ChauffLog
   * @access public
   */
  public $CT_ChauffLog = null;

  /**
   * 
   * @var serie $SerieConsosDJU
   * @access public
   */
  public $SerieConsosDJU = null;

  /**
   * 
   * @var ConsoPieceRepart[] $ConsosPieces
   * @access public
   */
  public $ConsosPieces = null;

  /**
   * 
   * @param InfosAppareilRepart[] $ListeInfosAppareils
   * @param float $Tot_URepart
   * @param float $Tot_TantChauff
   * @param float $PU_Tant
   * @param float $Prix_URepart
   * @param float $Prix_Abonn
   * @param float $Mont_ARepartTant
   * @param float $Part_RepartConsos
   * @param float $CT_Combust
   * @param float $URepartLog
   * @param float $TantLog
   * @param float $Prix_ChauffTantLog
   * @param float $CT_ChauffLog
   * @param serie $SerieConsosDJU
   * @param ConsoPieceRepart[] $ConsosPieces
   * @access public
   */
  public function __construct($ListeInfosAppareils, $Tot_URepart, $Tot_TantChauff, $PU_Tant, $Prix_URepart, $Prix_Abonn, $Mont_ARepartTant, $Part_RepartConsos, $CT_Combust, $URepartLog, $TantLog, $Prix_ChauffTantLog, $CT_ChauffLog, $SerieConsosDJU, $ConsosPieces)
  {
    $this->ListeInfosAppareils = $ListeInfosAppareils;
    $this->Tot_URepart = $Tot_URepart;
    $this->Tot_TantChauff = $Tot_TantChauff;
    $this->PU_Tant = $PU_Tant;
    $this->Prix_URepart = $Prix_URepart;
    $this->Prix_Abonn = $Prix_Abonn;
    $this->Mont_ARepartTant = $Mont_ARepartTant;
    $this->Part_RepartConsos = $Part_RepartConsos;
    $this->CT_Combust = $CT_Combust;
    $this->URepartLog = $URepartLog;
    $this->TantLog = $TantLog;
    $this->Prix_ChauffTantLog = $Prix_ChauffTantLog;
    $this->CT_ChauffLog = $CT_ChauffLog;
    $this->SerieConsosDJU = $SerieConsosDJU;
    $this->ConsosPieces = $ConsosPieces;
  }

}
