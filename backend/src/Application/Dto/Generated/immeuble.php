<?php

class immeuble
{

  /**
   * 
   * @var int $PkImmeuble
   * @access public
   */
  public $PkImmeuble = null;

  /**
   * 
   * @var string $Nom
   * @access public
   */
  public $Nom = null;

  /**
   * 
   * @var string $Numero
   * @access public
   */
  public $Numero = null;

  /**
   * 
   * @var string $Ref
   * @access public
   */
  public $Ref = null;

  /**
   * 
   * @var string $Adresse1
   * @access public
   */
  public $Adresse1 = null;

  /**
   * 
   * @var string $Adresse2
   * @access public
   */
  public $Adresse2 = null;

  /**
   * 
   * @var string $Adresse3
   * @access public
   */
  public $Adresse3 = null;

  /**
   * 
   * @var string $Cp
   * @access public
   */
  public $Cp = null;

  /**
   * 
   * @var string $Ville
   * @access public
   */
  public $Ville = null;

  /**
   * 
   * @var boolean $HasTelereleve
   * @access public
   */
  public $HasTelereleve = null;

  /**
   * 
   * @var int $FkClientTop
   * @access public
   */
  public $FkClientTop = null;

  /**
   * 
   * @var boolean $Actif
   * @access public
   */
  public $Actif = null;

  /**
   * 
   * @var dateTime $DateActivationClient
   * @access public
   */
  public $DateActivationClient = null;

  /**
   * 
   * @var dateTime $DateActivationOccupant
   * @access public
   */
  public $DateActivationOccupant = null;

  /**
   * 
   * @var boolean $HasNoteOccupant
   * @access public
   */
  public $HasNoteOccupant = null;

  /**
   * 
   * @var boolean $HasDecompteOccupant
   * @access public
   */
  public $HasDecompteOccupant = null;

  /**
   * 
   * @var boolean $HasFactures
   * @access public
   */
  public $HasFactures = null;

  /**
   * 
   * @var boolean $HasChantiers
   * @access public
   */
  public $HasChantiers = null;

  /**
   * 
   * @param int $PkImmeuble
   * @param string $Nom
   * @param string $Numero
   * @param string $Ref
   * @param string $Adresse1
   * @param string $Adresse2
   * @param string $Adresse3
   * @param string $Cp
   * @param string $Ville
   * @param boolean $HasTelereleve
   * @param int $FkClientTop
   * @param boolean $Actif
   * @param dateTime $DateActivationClient
   * @param dateTime $DateActivationOccupant
   * @param boolean $HasNoteOccupant
   * @param boolean $HasDecompteOccupant
   * @param boolean $HasFactures
   * @param boolean $HasChantiers
   * @access public
   */
  public function __construct($PkImmeuble, $Nom, $Numero, $Ref, $Adresse1, $Adresse2, $Adresse3, $Cp, $Ville, $HasTelereleve, $FkClientTop, $Actif, $DateActivationClient, $DateActivationOccupant, $HasNoteOccupant, $HasDecompteOccupant, $HasFactures, $HasChantiers)
  {
    $this->PkImmeuble = $PkImmeuble;
    $this->Nom = $Nom;
    $this->Numero = $Numero;
    $this->Ref = $Ref;
    $this->Adresse1 = $Adresse1;
    $this->Adresse2 = $Adresse2;
    $this->Adresse3 = $Adresse3;
    $this->Cp = $Cp;
    $this->Ville = $Ville;
    $this->HasTelereleve = $HasTelereleve;
    $this->FkClientTop = $FkClientTop;
    $this->Actif = $Actif;
    $this->DateActivationClient = $DateActivationClient;
    $this->DateActivationOccupant = $DateActivationOccupant;
    $this->HasNoteOccupant = $HasNoteOccupant;
    $this->HasDecompteOccupant = $HasDecompteOccupant;
    $this->HasFactures = $HasFactures;
    $this->HasChantiers = $HasChantiers;
  }

}
