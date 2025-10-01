<?php

class anomalie
{

  /**
   * 
   * @var float $Index
   * @access public
   */
  public $Index = null;

  /**
   * 
   * @var float $Conso
   * @access public
   */
  public $Conso = null;

  /**
   * 
   * @var string $Observations
   * @access public
   */
  public $Observations = null;

  /**
   * 
   * @param float $Index
   * @param float $Conso
   * @param string $Observations
   * @access public
   */
  public function __construct($Index, $Conso, $Observations)
  {
    $this->Index = $Index;
    $this->Conso = $Conso;
    $this->Observations = $Observations;
  }

}
