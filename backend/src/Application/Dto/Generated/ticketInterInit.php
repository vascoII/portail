<?php

class ticketInterInit
{

  /**
   * 
   * @var int $FkLogement
   * @access public
   */
  public $FkLogement = null;

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
   * @param int $FkLogement
   * @param string $Nom
   * @param string $Email
   * @param string $TelFixe
   * @param string $TelMobile
   * @access public
   */
  public function __construct($FkLogement, $Nom, $Email, $TelFixe, $TelMobile)
  {
    $this->FkLogement = $FkLogement;
    $this->Nom = $Nom;
    $this->Email = $Email;
    $this->TelFixe = $TelFixe;
    $this->TelMobile = $TelMobile;
  }

}
