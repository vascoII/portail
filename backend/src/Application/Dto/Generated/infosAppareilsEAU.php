<?php

class infosAppareilsEAU
{

  /**
   * 
   * @var InfosAppareilEAU[] $ListeInfosAppareils
   * @access public
   */
  public $ListeInfosAppareils = null;

  /**
   * 
   * @var dateTime $DateR6
   * @access public
   */
  public $DateR6 = null;

  /**
   * 
   * @var dateTime $DateR5
   * @access public
   */
  public $DateR5 = null;

  /**
   * 
   * @var dateTime $DateR4
   * @access public
   */
  public $DateR4 = null;

  /**
   * 
   * @var dateTime $DateR3
   * @access public
   */
  public $DateR3 = null;

  /**
   * 
   * @var dateTime $DateR2
   * @access public
   */
  public $DateR2 = null;

  /**
   * 
   * @var dateTime $DateR1
   * @access public
   */
  public $DateR1 = null;

  /**
   * 
   * @param InfosAppareilEAU[] $ListeInfosAppareils
   * @param dateTime $DateR6
   * @param dateTime $DateR5
   * @param dateTime $DateR4
   * @param dateTime $DateR3
   * @param dateTime $DateR2
   * @param dateTime $DateR1
   * @access public
   */
  public function __construct($ListeInfosAppareils, $DateR6, $DateR5, $DateR4, $DateR3, $DateR2, $DateR1)
  {
    $this->ListeInfosAppareils = $ListeInfosAppareils;
    $this->DateR6 = $DateR6;
    $this->DateR5 = $DateR5;
    $this->DateR4 = $DateR4;
    $this->DateR3 = $DateR3;
    $this->DateR2 = $DateR2;
    $this->DateR1 = $DateR1;
  }

}
