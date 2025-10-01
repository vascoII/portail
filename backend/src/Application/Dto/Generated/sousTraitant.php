<?php

class sousTraitant
{

  /**
   * 
   * @var string $Nom
   * @access public
   */
  public $Nom = null;

  /**
   * 
   * @var string $Description
   * @access public
   */
  public $Description = null;

  /**
   * 
   * @var string $Territoires
   * @access public
   */
  public $Territoires = null;

  /**
   * 
   * @var string $Pays
   * @access public
   */
  public $Pays = null;

  /**
   * 
   * @var string $Adresse
   * @access public
   */
  public $Adresse = null;

  /**
   * 
   * @var string $CP
   * @access public
   */
  public $CP = null;

  /**
   * 
   * @var string $Ville
   * @access public
   */
  public $Ville = null;

  /**
   * 
   * @var string $Protection
   * @access public
   */
  public $Protection = null;

  /**
   * 
   * @param string $Nom
   * @param string $Description
   * @param string $Territoires
   * @param string $Pays
   * @param string $Adresse
   * @param string $CP
   * @param string $Ville
   * @param string $Protection
   * @access public
   */
  public function __construct($Nom, $Description, $Territoires, $Pays, $Adresse, $CP, $Ville, $Protection)
  {
    $this->Nom = $Nom;
    $this->Description = $Description;
    $this->Territoires = $Territoires;
    $this->Pays = $Pays;
    $this->Adresse = $Adresse;
    $this->CP = $CP;
    $this->Ville = $Ville;
    $this->Protection = $Protection;
  }

}
