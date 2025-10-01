<?php

class chantier
{

  /**
   * 
   * @var int $PkChantier
   * @access public
   */
  public $PkChantier = null;

  /**
   * 
   * @var int $PkDevis
   * @access public
   */
  public $PkDevis = null;

  /**
   * 
   * @var int $PkImmeuble
   * @access public
   */
  public $PkImmeuble = null;

  /**
   * 
   * @var dateTime $DateEntreeChantier
   * @access public
   */
  public $DateEntreeChantier = null;

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
   * @param int $PkChantier
   * @param int $PkDevis
   * @param int $PkImmeuble
   * @param dateTime $DateEntreeChantier
   * @param int $NbCompteursPoses
   * @param int $NbCompteursCommandes
   * @access public
   */
  public function __construct($PkChantier, $PkDevis, $PkImmeuble, $DateEntreeChantier, $NbCompteursPoses, $NbCompteursCommandes)
  {
    $this->PkChantier = $PkChantier;
    $this->PkDevis = $PkDevis;
    $this->PkImmeuble = $PkImmeuble;
    $this->DateEntreeChantier = $DateEntreeChantier;
    $this->NbCompteursPoses = $NbCompteursPoses;
    $this->NbCompteursCommandes = $NbCompteursCommandes;
  }

}
