<?php

class fuite
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
   * @param int $Duree
   * @param dateTime $DateDebut
   * @param float $IndexDebut
   * @param float $Conso
   * @access public
   */
  public function __construct($Duree, $DateDebut, $IndexDebut, $Conso)
  {
    $this->Duree = $Duree;
    $this->DateDebut = $DateDebut;
    $this->IndexDebut = $IndexDebut;
    $this->Conso = $Conso;
  }

}
