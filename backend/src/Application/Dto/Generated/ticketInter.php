<?php

class ticketInter
{

  /**
   * 
   * @var string $Nom
   * @access public
   */
  public $Nom = null;

  /**
   * 
   * @var string $Email
   * @access public
   */
  public $Email = null;

  /**
   * 
   * @var string $TelFixe
   * @access public
   */
  public $TelFixe = null;

  /**
   * 
   * @var string $TelMobile
   * @access public
   */
  public $TelMobile = null;

  /**
   * 
   * @var dateTime $TicketDate
   * @access public
   */
  public $TicketDate = null;

  /**
   * 
   * @var string $MotifLibre
   * @access public
   */
  public $MotifLibre = null;

  /**
   * 
   * @var string $Statut
   * @access public
   */
  public $Statut = null;

  /**
   * 
   * @var string $ObjetRetour
   * @access public
   */
  public $ObjetRetour = null;

  /**
   * 
   * @var int $FkLogement
   * @access public
   */
  public $FkLogement = null;

  /**
   * 
   * @var string $RefLogement
   * @access public
   */
  public $RefLogement = null;

  /**
   * 
   * @var string $NumIntervention
   * @access public
   */
  public $NumIntervention = null;

  /**
   * 
   * @var string $FkIntervention
   * @access public
   */
  public $FkIntervention = null;

  /**
   * 
   * @var string $WebUser_Nom
   * @access public
   */
  public $WebUser_Nom = null;

  /**
   * 
   * @var string $WebUser_Prenom
   * @access public
   */
  public $WebUser_Prenom = null;

  /**
   * 
   * @var string $WebUser_Tel
   * @access public
   */
  public $WebUser_Tel = null;

  /**
   * 
   * @var string $WebUser_Email
   * @access public
   */
  public $WebUser_Email = null;

  /**
   * 
   * @var string $WebUser_UserType
   * @access public
   */
  public $WebUser_UserType = null;

  /**
   * 
   * @var string $Imm_Id
   * @access public
   */
  public $Imm_Id = null;

  /**
   * 
   * @var int $FkImmeuble
   * @access public
   */
  public $FkImmeuble = null;

  /**
   * 
   * @var string $Statut_Client
   * @access public
   */
  public $Statut_Client = null;

  /**
   * 
   * @var string $CaseNumber
   * @access public
   */
  public $CaseNumber = null;

  /**
   * 
   * @var string $CaseId
   * @access public
   */
  public $CaseId = null;

  /**
   * 
   * @var string $AttachmentName
   * @access public
   */
  public $AttachmentName = null;

  /**
   * 
   * @var dateTime $LastUpdateDate
   * @access public
   */
  public $LastUpdateDate = null;

  /**
   * 
   * @param string $Nom
   * @param string $Email
   * @param string $TelFixe
   * @param string $TelMobile
   * @param dateTime $TicketDate
   * @param string $MotifLibre
   * @param string $Statut
   * @param string $ObjetRetour
   * @param int $FkLogement
   * @param string $RefLogement
   * @param string $NumIntervention
   * @param string $FkIntervention
   * @param string $WebUser_Nom
   * @param string $WebUser_Prenom
   * @param string $WebUser_Tel
   * @param string $WebUser_Email
   * @param string $WebUser_UserType
   * @param string $Imm_Id
   * @param int $FkImmeuble
   * @param string $Statut_Client
   * @param string $CaseNumber
   * @param string $CaseId
   * @param string $AttachmentName
   * @param dateTime $LastUpdateDate
   * @access public
   */
  public function __construct($Nom, $Email, $TelFixe, $TelMobile, $TicketDate, $MotifLibre, $Statut, $ObjetRetour, $FkLogement, $RefLogement, $NumIntervention, $FkIntervention, $WebUser_Nom, $WebUser_Prenom, $WebUser_Tel, $WebUser_Email, $WebUser_UserType, $Imm_Id, $FkImmeuble, $Statut_Client, $CaseNumber, $CaseId, $AttachmentName, $LastUpdateDate)
  {
    $this->Nom = $Nom;
    $this->Email = $Email;
    $this->TelFixe = $TelFixe;
    $this->TelMobile = $TelMobile;
    $this->TicketDate = $TicketDate;
    $this->MotifLibre = $MotifLibre;
    $this->Statut = $Statut;
    $this->ObjetRetour = $ObjetRetour;
    $this->FkLogement = $FkLogement;
    $this->RefLogement = $RefLogement;
    $this->NumIntervention = $NumIntervention;
    $this->FkIntervention = $FkIntervention;
    $this->WebUser_Nom = $WebUser_Nom;
    $this->WebUser_Prenom = $WebUser_Prenom;
    $this->WebUser_Tel = $WebUser_Tel;
    $this->WebUser_Email = $WebUser_Email;
    $this->WebUser_UserType = $WebUser_UserType;
    $this->Imm_Id = $Imm_Id;
    $this->FkImmeuble = $FkImmeuble;
    $this->Statut_Client = $Statut_Client;
    $this->CaseNumber = $CaseNumber;
    $this->CaseId = $CaseId;
    $this->AttachmentName = $AttachmentName;
    $this->LastUpdateDate = $LastUpdateDate;
  }

}
