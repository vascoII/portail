<?php

class immeubleGaz
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
   * @var Releve[] $ListeReleves
   * @access public
   */
  public $ListeReleves = null;

  /**
   * 
   * @param int $NbCompteursARelever
   * @param int $NbCompteursReleves
   * @param chantier $Chantier
   * @param topConsos $TopConsos
   * @param Releve[] $ListeReleves
   * @access public
   */
  public function __construct($NbCompteursARelever, $NbCompteursReleves, $Chantier, $TopConsos, $ListeReleves)
  {
    $this->NbCompteursARelever = $NbCompteursARelever;
    $this->NbCompteursReleves = $NbCompteursReleves;
    $this->Chantier = $Chantier;
    $this->TopConsos = $TopConsos;
    $this->ListeReleves = $ListeReleves;
  }

}
