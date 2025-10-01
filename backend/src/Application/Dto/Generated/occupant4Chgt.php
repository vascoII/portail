<?php

class occupant4Chgt
{

  /**
   * 
   * @var int $PkOccupant
   * @access public
   */
  public $PkOccupant = null;

  /**
   * 
   * @var string $Nom
   * @access public
   */
  public $Nom = null;

  /**
   * 
   * @var string $CodeLogeGestio
   * @access public
   */
  public $CodeLogeGestio = null;

  /**
   * 
   * @var dateTime $DateArrivee
   * @access public
   */
  public $DateArrivee = null;

  /**
   * 
   * @var string $email
   * @access public
   */
  public $email = null;

  /**
   * 
   * @var string $telfixe
   * @access public
   */
  public $telfixe = null;

  /**
   * 
   * @var string $telmobile
   * @access public
   */
  public $telmobile = null;

  /**
   * 
   * @var string $numbail
   * @access public
   */
  public $numbail = null;

  /**
   * 
   * @var string $idIMM
   * @access public
   */
  public $idIMM = null;

  /**
   * 
   * @var string $codegestioIMM
   * @access public
   */
  public $codegestioIMM = null;

  /**
   * 
   * @var string $adresseIMM
   * @access public
   */
  public $adresseIMM = null;

  /**
   * 
   * @var string $cpIMM
   * @access public
   */
  public $cpIMM = null;

  /**
   * 
   * @var string $villeIMM
   * @access public
   */
  public $villeIMM = null;

  /**
   * 
   * @var string $numBAT
   * @access public
   */
  public $numBAT = null;

  /**
   * 
   * @var string $adresseBAT
   * @access public
   */
  public $adresseBAT = null;

  /**
   * 
   * @var string $numESC
   * @access public
   */
  public $numESC = null;

  /**
   * 
   * @var string $adresseESC
   * @access public
   */
  public $adresseESC = null;

  /**
   * 
   * @var string $numetage
   * @access public
   */
  public $numetage = null;

  /**
   * 
   * @var string $numordre
   * @access public
   */
  public $numordre = null;

  /**
   * 
   * @var int $newPkOccupant
   * @access public
   */
  public $newPkOccupant = null;

  /**
   * 
   * @var string $newNom
   * @access public
   */
  public $newNom = null;

  /**
   * 
   * @var string $newCodeLogeGestio
   * @access public
   */
  public $newCodeLogeGestio = null;

  /**
   * 
   * @var dateTime $newDateArrivee
   * @access public
   */
  public $newDateArrivee = null;

  /**
   * 
   * @var string $newEmail
   * @access public
   */
  public $newEmail = null;

  /**
   * 
   * @var string $newTelfixe
   * @access public
   */
  public $newTelfixe = null;

  /**
   * 
   * @var string $newTelmobile
   * @access public
   */
  public $newTelmobile = null;

  /**
   * 
   * @var string $newNumbail
   * @access public
   */
  public $newNumbail = null;

  /**
   * 
   * @var boolean $isNew
   * @access public
   */
  public $isNew = null;

  /**
   * 
   * @var string $Erreur
   * @access public
   */
  public $Erreur = null;

  /**
   * 
   * @param int $PkOccupant
   * @param string $Nom
   * @param string $CodeLogeGestio
   * @param dateTime $DateArrivee
   * @param string $email
   * @param string $telfixe
   * @param string $telmobile
   * @param string $numbail
   * @param string $idIMM
   * @param string $codegestioIMM
   * @param string $adresseIMM
   * @param string $cpIMM
   * @param string $villeIMM
   * @param string $numBAT
   * @param string $adresseBAT
   * @param string $numESC
   * @param string $adresseESC
   * @param string $numetage
   * @param string $numordre
   * @param int $newPkOccupant
   * @param string $newNom
   * @param string $newCodeLogeGestio
   * @param dateTime $newDateArrivee
   * @param string $newEmail
   * @param string $newTelfixe
   * @param string $newTelmobile
   * @param string $newNumbail
   * @param boolean $isNew
   * @param string $Erreur
   * @access public
   */
  public function __construct($PkOccupant, $Nom, $CodeLogeGestio, $DateArrivee, $email, $telfixe, $telmobile, $numbail, $idIMM, $codegestioIMM, $adresseIMM, $cpIMM, $villeIMM, $numBAT, $adresseBAT, $numESC, $adresseESC, $numetage, $numordre, $newPkOccupant, $newNom, $newCodeLogeGestio, $newDateArrivee, $newEmail, $newTelfixe, $newTelmobile, $newNumbail, $isNew, $Erreur)
  {
    $this->PkOccupant = $PkOccupant;
    $this->Nom = $Nom;
    $this->CodeLogeGestio = $CodeLogeGestio;
    $this->DateArrivee = $DateArrivee;
    $this->email = $email;
    $this->telfixe = $telfixe;
    $this->telmobile = $telmobile;
    $this->numbail = $numbail;
    $this->idIMM = $idIMM;
    $this->codegestioIMM = $codegestioIMM;
    $this->adresseIMM = $adresseIMM;
    $this->cpIMM = $cpIMM;
    $this->villeIMM = $villeIMM;
    $this->numBAT = $numBAT;
    $this->adresseBAT = $adresseBAT;
    $this->numESC = $numESC;
    $this->adresseESC = $adresseESC;
    $this->numetage = $numetage;
    $this->numordre = $numordre;
    $this->newPkOccupant = $newPkOccupant;
    $this->newNom = $newNom;
    $this->newCodeLogeGestio = $newCodeLogeGestio;
    $this->newDateArrivee = $newDateArrivee;
    $this->newEmail = $newEmail;
    $this->newTelfixe = $newTelfixe;
    $this->newTelmobile = $newTelmobile;
    $this->newNumbail = $newNumbail;
    $this->isNew = $isNew;
    $this->Erreur = $Erreur;
  }

}
