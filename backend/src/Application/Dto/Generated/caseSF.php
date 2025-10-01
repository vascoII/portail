<?php

class caseSF
{

  /**
   * 
   * @var string $Id
   * @access public
   */
  public $Id = null;

  /**
   * 
   * @var string $Statut
   * @access public
   */
  public $Statut = null;

  /**
   * 
   * @var string $CaseNumber
   * @access public
   */
  public $CaseNumber = null;

  /**
   * 
   * @var string $Categorie
   * @access public
   */
  public $Categorie = null;

  /**
   * 
   * @var string $SousCategorie
   * @access public
   */
  public $SousCategorie = null;

  /**
   * 
   * @var string $Subject
   * @access public
   */
  public $Subject = null;

  /**
   * 
   * @var string $Type
   * @access public
   */
  public $Type = null;

  /**
   * 
   * @var WorkOrderSF[] $ListeWorkOrderSF
   * @access public
   */
  public $ListeWorkOrderSF = null;

  /**
   * 
   * @param string $Id
   * @param string $Statut
   * @param string $CaseNumber
   * @param string $Categorie
   * @param string $SousCategorie
   * @param string $Subject
   * @param string $Type
   * @param WorkOrderSF[] $ListeWorkOrderSF
   * @access public
   */
  public function __construct($Id, $Statut, $CaseNumber, $Categorie, $SousCategorie, $Subject, $Type, $ListeWorkOrderSF)
  {
    $this->Id = $Id;
    $this->Statut = $Statut;
    $this->CaseNumber = $CaseNumber;
    $this->Categorie = $Categorie;
    $this->SousCategorie = $SousCategorie;
    $this->Subject = $Subject;
    $this->Type = $Type;
    $this->ListeWorkOrderSF = $ListeWorkOrderSF;
  }

}
