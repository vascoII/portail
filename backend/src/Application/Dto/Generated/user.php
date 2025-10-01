<?php

class user
{

  /**
   * 
   * @var string $LoginID
   * @access public
   */
  public $LoginID = null;

  /**
   * 
   * @var string $UserName
   * @access public
   */
  public $UserName = null;

  /**
   * 
   * @var string $Password
   * @access public
   */
  public $Password = null;

  /**
   * 
   * @var string $EMail
   * @access public
   */
  public $EMail = null;

  /**
   * 
   * @var string $UserType
   * @access public
   */
  public $UserType = null;

  /**
   * 
   * @var int $PKUser
   * @access public
   */
  public $PKUser = null;

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
   * @var int $FK
   * @access public
   */
  public $FK = null;

  /**
   * 
   * @var string $PhoneNumber
   * @access public
   */
  public $PhoneNumber = null;

  /**
   * 
   * @var string $FirstName
   * @access public
   */
  public $FirstName = null;

  /**
   * 
   * @var string $UserRole
   * @access public
   */
  public $UserRole = null;

  /**
   * 
   * @var string $ClientName
   * @access public
   */
  public $ClientName = null;

  /**
   * 
   * @var string $ClientID
   * @access public
   */
  public $ClientID = null;

  /**
   * 
   * @var dateTime $ExpirationDate
   * @access public
   */
  public $ExpirationDate = null;

  /**
   * 
   * @var dateTime $PasswordExpirationDate
   * @access public
   */
  public $PasswordExpirationDate = null;

  /**
   * 
   * @var string $CGU
   * @access public
   */
  public $CGU = null;

  /**
   * 
   * @var int $FKClient
   * @access public
   */
  public $FKClient = null;

  /**
   * 
   * @var int $FKClientTop
   * @access public
   */
  public $FKClientTop = null;

  /**
   * 
   * @var int $NbImmeubles
   * @access public
   */
  public $NbImmeubles = null;

  /**
   * 
   * @var int $Seuil_Conso_EF
   * @access public
   */
  public $Seuil_Conso_EF = null;

  /**
   * 
   * @var int $Seuil_Conso_EC
   * @access public
   */
  public $Seuil_Conso_EC = null;

  /**
   * 
   * @var int $Seuil_Conso_Repart
   * @access public
   */
  public $Seuil_Conso_Repart = null;

  /**
   * 
   * @var int $Seuil_Conso_CET
   * @access public
   */
  public $Seuil_Conso_CET = null;

  /**
   * 
   * @var boolean $Seuil_Conso_Actif
   * @access public
   */
  public $Seuil_Conso_Actif = null;

  /**
   * 
   * @var string $Seuil_Conso_Email
   * @access public
   */
  public $Seuil_Conso_Email = null;

  /**
   * 
   * @var boolean $showImmeublesArc
   * @access public
   */
  public $showImmeublesArc = null;

  /**
   * 
   * @var boolean $showFactures
   * @access public
   */
  public $showFactures = null;

  /**
   * 
   * @var boolean $showChgtOccupant
   * @access public
   */
  public $showChgtOccupant = null;

  /**
   * 
   * @var boolean $showChantiers
   * @access public
   */
  public $showChantiers = null;

  /**
   * 
   * @param string $LoginID
   * @param string $UserName
   * @param string $Password
   * @param string $EMail
   * @param string $UserType
   * @param int $PKUser
   * @param string $Adresse
   * @param string $CP
   * @param string $Ville
   * @param int $FK
   * @param string $PhoneNumber
   * @param string $FirstName
   * @param string $UserRole
   * @param string $ClientName
   * @param string $ClientID
   * @param dateTime $ExpirationDate
   * @param dateTime $PasswordExpirationDate
   * @param string $CGU
   * @param int $FKClient
   * @param int $FKClientTop
   * @param int $NbImmeubles
   * @param int $Seuil_Conso_EF
   * @param int $Seuil_Conso_EC
   * @param int $Seuil_Conso_Repart
   * @param int $Seuil_Conso_CET
   * @param boolean $Seuil_Conso_Actif
   * @param string $Seuil_Conso_Email
   * @param boolean $showImmeublesArc
   * @param boolean $showFactures
   * @param boolean $showChgtOccupant
   * @param boolean $showChantiers
   * @access public
   */
  public function __construct($LoginID, $UserName, $Password, $EMail, $UserType, $PKUser, $Adresse, $CP, $Ville, $FK, $PhoneNumber, $FirstName, $UserRole, $ClientName, $ClientID, $ExpirationDate, $PasswordExpirationDate, $CGU, $FKClient, $FKClientTop, $NbImmeubles, $Seuil_Conso_EF, $Seuil_Conso_EC, $Seuil_Conso_Repart, $Seuil_Conso_CET, $Seuil_Conso_Actif, $Seuil_Conso_Email, $showImmeublesArc, $showFactures, $showChgtOccupant, $showChantiers)
  {
    $this->LoginID = $LoginID;
    $this->UserName = $UserName;
    $this->Password = $Password;
    $this->EMail = $EMail;
    $this->UserType = $UserType;
    $this->PKUser = $PKUser;
    $this->Adresse = $Adresse;
    $this->CP = $CP;
    $this->Ville = $Ville;
    $this->FK = $FK;
    $this->PhoneNumber = $PhoneNumber;
    $this->FirstName = $FirstName;
    $this->UserRole = $UserRole;
    $this->ClientName = $ClientName;
    $this->ClientID = $ClientID;
    $this->ExpirationDate = $ExpirationDate;
    $this->PasswordExpirationDate = $PasswordExpirationDate;
    $this->CGU = $CGU;
    $this->FKClient = $FKClient;
    $this->FKClientTop = $FKClientTop;
    $this->NbImmeubles = $NbImmeubles;
    $this->Seuil_Conso_EF = $Seuil_Conso_EF;
    $this->Seuil_Conso_EC = $Seuil_Conso_EC;
    $this->Seuil_Conso_Repart = $Seuil_Conso_Repart;
    $this->Seuil_Conso_CET = $Seuil_Conso_CET;
    $this->Seuil_Conso_Actif = $Seuil_Conso_Actif;
    $this->Seuil_Conso_Email = $Seuil_Conso_Email;
    $this->showImmeublesArc = $showImmeublesArc;
    $this->showFactures = $showFactures;
    $this->showChgtOccupant = $showChgtOccupant;
    $this->showChantiers = $showChantiers;
  }

}
