<?php

class dysfonctionnement
{

  /**
   * 
   * @var int $Duree
   * @access public
   */
  public $Duree = null;

  /**
   * 
   * @var dateTime $DateDebut
   * @access public
   */
  public $DateDebut = null;

  /**
   * 
   * @var float $IndexDebut
   * @access public
   */
  public $IndexDebut = null;

  /**
   * 
   * @var float $Conso
   * @access public
   */
  public $Conso = null;

  /**
   * 
   * @var string $Type
   * @access public
   */
  public $Type = null;

  /**
   * 
   * @param int $Duree
   * @param dateTime $DateDebut
   * @param float $IndexDebut
   * @param float $Conso
   * @param string $Type
   * @access public
   */
  public function __construct($Duree, $DateDebut, $IndexDebut, $Conso, $Type)
  {
    $this->Duree = $Duree;
    $this->DateDebut = $DateDebut;
    $this->IndexDebut = $IndexDebut;
    $this->Conso = $Conso;
    $this->Type = $Type;
  }

}
