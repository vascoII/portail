<?php

class CreateTicketInter
{

  /**
   * 
   * @var string $SessionID
   * @access public
   */
  public $SessionID = null;

  /**
   * 
   * @var int $PkUser
   * @access public
   */
  public $PkUser = null;

  /**
   * 
   * @var int $PkLogement
   * @access public
   */
  public $PkLogement = null;

  /**
   * 
   * @var string $Objet
   * @access public
   */
  public $Objet = null;

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
   * @var string $MotifLibre
   * @access public
   */
  public $MotifLibre = null;

  /**
   * 
   * @var string $AttachmentName
   * @access public
   */
  public $AttachmentName = null;

  /**
   * 
   * @var base64Binary $AttachmentContent
   * @access public
   */
  public $AttachmentContent = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param int $PkLogement
   * @param string $Objet
   * @param string $Nom
   * @param string $Email
   * @param string $TelFixe
   * @param string $TelMobile
   * @param string $MotifLibre
   * @param string $AttachmentName
   * @param base64Binary $AttachmentContent
   * @access public
   */
  public function __construct($SessionID, $PkUser, $PkLogement, $Objet, $Nom, $Email, $TelFixe, $TelMobile, $MotifLibre, $AttachmentName, $AttachmentContent)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->PkLogement = $PkLogement;
    $this->Objet = $Objet;
    $this->Nom = $Nom;
    $this->Email = $Email;
    $this->TelFixe = $TelFixe;
    $this->TelMobile = $TelMobile;
    $this->MotifLibre = $MotifLibre;
    $this->AttachmentName = $AttachmentName;
    $this->AttachmentContent = $AttachmentContent;
  }

}
