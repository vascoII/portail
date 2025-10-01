<?php

class logement
{

  /**
   * 
   * @var int $PkLogement
   * @access public
   */
  public $PkLogement = null;

  /**
   * 
   * @var string $NumBatiment
   * @access public
   */
  public $NumBatiment = null;

  /**
   * 
   * @var string $AdrBatiment
   * @access public
   */
  public $AdrBatiment = null;

  /**
   * 
   * @var string $NumEscalier
   * @access public
   */
  public $NumEscalier = null;

  /**
   * 
   * @var string $AdrEscalier
   * @access public
   */
  public $AdrEscalier = null;

  /**
   * 
   * @var string $NumEtage
   * @access public
   */
  public $NumEtage = null;

  /**
   * 
   * @var string $NumOrdre
   * @access public
   */
  public $NumOrdre = null;

  /**
   * 
   * @var string $Type
   * @access public
   */
  public $Type = null;

  /**
   * 
   * @param int $PkLogement
   * @param string $NumBatiment
   * @param string $AdrBatiment
   * @param string $NumEscalier
   * @param string $AdrEscalier
   * @param string $NumEtage
   * @param string $NumOrdre
   * @param string $Type
   * @access public
   */
  public function __construct($PkLogement, $NumBatiment, $AdrBatiment, $NumEscalier, $AdrEscalier, $NumEtage, $NumOrdre, $Type)
  {
    $this->PkLogement = $PkLogement;
    $this->NumBatiment = $NumBatiment;
    $this->AdrBatiment = $AdrBatiment;
    $this->NumEscalier = $NumEscalier;
    $this->AdrEscalier = $AdrEscalier;
    $this->NumEtage = $NumEtage;
    $this->NumOrdre = $NumOrdre;
    $this->Type = $Type;
  }

}
