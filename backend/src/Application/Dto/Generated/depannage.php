<?php

class depannage
{

  /**
   * 
   * @var string $WorkOrderNumber
   * @access public
   */
  public $WorkOrderNumber = null;

  /**
   * 
   * @var string $Numero
   * @access public
   */
  public $Numero = null;

  /**
   * 
   * @var string $Statut
   * @access public
   */
  public $Statut = null;

  /**
   * 
   * @var string $StatutAbrege
   * @access public
   */
  public $StatutAbrege = null;

  /**
   * 
   * @var dateTime $Date
   * @access public
   */
  public $Date = null;

  /**
   * 
   * @var string $Motif
   * @access public
   */
  public $Motif = null;

  /**
   * 
   * @var string $MotifAbrege
   * @access public
   */
  public $MotifAbrege = null;

  /**
   * 
   * @var string $CompteRendu
   * @access public
   */
  public $CompteRendu = null;

  /**
   * 
   * @param string $WorkOrderNumber
   * @param string $Numero
   * @param string $Statut
   * @param string $StatutAbrege
   * @param dateTime $Date
   * @param string $Motif
   * @param string $MotifAbrege
   * @param string $CompteRendu
   * @access public
   */
  public function __construct($WorkOrderNumber, $Numero, $Statut, $StatutAbrege, $Date, $Motif, $MotifAbrege, $CompteRendu)
  {
    $this->WorkOrderNumber = $WorkOrderNumber;
    $this->Numero = $Numero;
    $this->Statut = $Statut;
    $this->StatutAbrege = $StatutAbrege;
    $this->Date = $Date;
    $this->Motif = $Motif;
    $this->MotifAbrege = $MotifAbrege;
    $this->CompteRendu = $CompteRendu;
  }

}
