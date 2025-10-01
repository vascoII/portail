<?php

class workOrderLineItemSF
{

  /**
   * 
   * @var string $AssetSerialNumber
   * @access public
   */
  public $AssetSerialNumber = null;

  /**
   * 
   * @var string $WorkType
   * @access public
   */
  public $WorkType = null;

  /**
   * 
   * @var string $MotifExecution
   * @access public
   */
  public $MotifExecution = null;

  /**
   * 
   * @var string $MotifNonExecution
   * @access public
   */
  public $MotifNonExecution = null;

  /**
   * 
   * @var string $Statut
   * @access public
   */
  public $Statut = null;

  /**
   * 
   * @param string $AssetSerialNumber
   * @param string $WorkType
   * @param string $MotifExecution
   * @param string $MotifNonExecution
   * @param string $Statut
   * @access public
   */
  public function __construct($AssetSerialNumber, $WorkType, $MotifExecution, $MotifNonExecution, $Statut)
  {
    $this->AssetSerialNumber = $AssetSerialNumber;
    $this->WorkType = $WorkType;
    $this->MotifExecution = $MotifExecution;
    $this->MotifNonExecution = $MotifNonExecution;
    $this->Statut = $Statut;
  }

}
