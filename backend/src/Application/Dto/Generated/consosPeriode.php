<?php

class consosPeriode
{

  /**
   * 
   * @var float $Conso
   * @access public
   */
  public $Conso = null;

  /**
   * 
   * @var dateTime $DateDeb
   * @access public
   */
  public $DateDeb = null;

  /**
   * 
   * @var dateTime $DateFin
   * @access public
   */
  public $DateFin = null;

  /**
   * 
   * @var indexReleve $R5
   * @access public
   */
  public $R5 = null;

  /**
   * 
   * @var indexReleve $R4
   * @access public
   */
  public $R4 = null;

  /**
   * 
   * @var indexReleve $R3
   * @access public
   */
  public $R3 = null;

  /**
   * 
   * @var indexReleve $R2
   * @access public
   */
  public $R2 = null;

  /**
   * 
   * @var indexReleve $R1
   * @access public
   */
  public $R1 = null;

  /**
   * 
   * @var float $VAR4
   * @access public
   */
  public $VAR4 = null;

  /**
   * 
   * @var float $VAR3
   * @access public
   */
  public $VAR3 = null;

  /**
   * 
   * @var float $VAR2
   * @access public
   */
  public $VAR2 = null;

  /**
   * 
   * @var float $VAR1
   * @access public
   */
  public $VAR1 = null;

  /**
   * 
   * @var int $DegresVAR4
   * @access public
   */
  public $DegresVAR4 = null;

  /**
   * 
   * @var int $DegresVAR3
   * @access public
   */
  public $DegresVAR3 = null;

  /**
   * 
   * @var int $DegresVAR2
   * @access public
   */
  public $DegresVAR2 = null;

  /**
   * 
   * @var int $DegresVAR1
   * @access public
   */
  public $DegresVAR1 = null;

  /**
   * 
   * @param float $Conso
   * @param dateTime $DateDeb
   * @param dateTime $DateFin
   * @param indexReleve $R5
   * @param indexReleve $R4
   * @param indexReleve $R3
   * @param indexReleve $R2
   * @param indexReleve $R1
   * @param float $VAR4
   * @param float $VAR3
   * @param float $VAR2
   * @param float $VAR1
   * @param int $DegresVAR4
   * @param int $DegresVAR3
   * @param int $DegresVAR2
   * @param int $DegresVAR1
   * @access public
   */
  public function __construct($Conso, $DateDeb, $DateFin, $R5, $R4, $R3, $R2, $R1, $VAR4, $VAR3, $VAR2, $VAR1, $DegresVAR4, $DegresVAR3, $DegresVAR2, $DegresVAR1)
  {
    $this->Conso = $Conso;
    $this->DateDeb = $DateDeb;
    $this->DateFin = $DateFin;
    $this->R5 = $R5;
    $this->R4 = $R4;
    $this->R3 = $R3;
    $this->R2 = $R2;
    $this->R1 = $R1;
    $this->VAR4 = $VAR4;
    $this->VAR3 = $VAR3;
    $this->VAR2 = $VAR2;
    $this->VAR1 = $VAR1;
    $this->DegresVAR4 = $DegresVAR4;
    $this->DegresVAR3 = $DegresVAR3;
    $this->DegresVAR2 = $DegresVAR2;
    $this->DegresVAR1 = $DegresVAR1;
  }

}
