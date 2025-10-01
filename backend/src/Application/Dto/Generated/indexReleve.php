<?php

class indexReleve
{

  /**
   * 
   * @var dateTime $DateReleve
   * @access public
   */
  public $DateReleve = null;

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
   * @param dateTime $DateReleve
   * @param float $Index
   * @param float $Conso
   * @access public
   */
  public function __construct($DateReleve, $Index, $Conso)
  {
    $this->DateReleve = $DateReleve;
    $this->Index = $Index;
    $this->Conso = $Conso;
  }

}
