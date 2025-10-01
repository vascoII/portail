<?php

class facture
{

  /**
   * 
   * @var int $PKFacture
   * @access public
   */
  public $PKFacture = null;

  /**
   * 
   * @var string $NumFacture
   * @access public
   */
  public $NumFacture = null;

  /**
   * 
   * @var dateTime $DateEdition
   * @access public
   */
  public $DateEdition = null;

  /**
   * 
   * @var dateTime $DateDebut
   * @access public
   */
  public $DateDebut = null;

  /**
   * 
   * @var dateTime $DateFin
   * @access public
   */
  public $DateFin = null;

  /**
   * 
   * @var float $MontantTotalHT
   * @access public
   */
  public $MontantTotalHT = null;

  /**
   * 
   * @var float $MontantTotalTTC
   * @access public
   */
  public $MontantTotalTTC = null;

  /**
   * 
   * @var float $MontantTotalAPayer
   * @access public
   */
  public $MontantTotalAPayer = null;

  /**
   * 
   * @var string $IDImm
   * @access public
   */
  public $IDImm = null;

  /**
   * 
   * @var string $CodeGestio
   * @access public
   */
  public $CodeGestio = null;

  /**
   * 
   * @var string $CP
   * @access public
   */
  public $CP = null;

  /**
   * 
   * @var string $Adresse
   * @access public
   */
  public $Adresse = null;

  /**
   * 
   * @var string $Ville
   * @access public
   */
  public $Ville = null;

  /**
   * 
   * @param int $PKFacture
   * @param string $NumFacture
   * @param dateTime $DateEdition
   * @param dateTime $DateDebut
   * @param dateTime $DateFin
   * @param float $MontantTotalHT
   * @param float $MontantTotalTTC
   * @param float $MontantTotalAPayer
   * @param string $IDImm
   * @param string $CodeGestio
   * @param string $CP
   * @param string $Adresse
   * @param string $Ville
   * @access public
   */
  public function __construct($PKFacture, $NumFacture, $DateEdition, $DateDebut, $DateFin, $MontantTotalHT, $MontantTotalTTC, $MontantTotalAPayer, $IDImm, $CodeGestio, $CP, $Adresse, $Ville)
  {
    $this->PKFacture = $PKFacture;
    $this->NumFacture = $NumFacture;
    $this->DateEdition = $DateEdition;
    $this->DateDebut = $DateDebut;
    $this->DateFin = $DateFin;
    $this->MontantTotalHT = $MontantTotalHT;
    $this->MontantTotalTTC = $MontantTotalTTC;
    $this->MontantTotalAPayer = $MontantTotalAPayer;
    $this->IDImm = $IDImm;
    $this->CodeGestio = $CodeGestio;
    $this->CP = $CP;
    $this->Adresse = $Adresse;
    $this->Ville = $Ville;
  }

}
