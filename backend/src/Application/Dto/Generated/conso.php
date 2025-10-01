<?php

class conso
{

  /**
   * 
   * @var int $PkLogement
   * @access public
   */
  public $PkLogement = null;

  /**
   * 
   * @var string $NomOcc
   * @access public
   */
  public $NomOcc = null;

  /**
   * 
   * @var string $RefOcc
   * @access public
   */
  public $RefOcc = null;

  /**
   * 
   * @var int $Fluide
   * @access public
   */
  public $Fluide = null;

  /**
   * 
   * @var float $Conso
   * @access public
   */
  public $Conso = null;

  /**
   * 
   * @param int $PkLogement
   * @param string $NomOcc
   * @param string $RefOcc
   * @param int $Fluide
   * @param float $Conso
   * @access public
   */
  public function __construct($PkLogement, $NomOcc, $RefOcc, $Fluide, $Conso)
  {
    $this->PkLogement = $PkLogement;
    $this->NomOcc = $NomOcc;
    $this->RefOcc = $RefOcc;
    $this->Fluide = $Fluide;
    $this->Conso = $Conso;
  }

}
