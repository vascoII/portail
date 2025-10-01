<?php

class consoPieceRepart
{

  /**
   * 
   * @var string $Emplacement
   * @access public
   */
  public $Emplacement = null;

  /**
   * 
   * @var indexReleve $R1
   * @access public
   */
  public $R1 = null;

  /**
   * 
   * @var indexReleve $R2
   * @access public
   */
  public $R2 = null;

  /**
   * 
   * @param string $Emplacement
   * @param indexReleve $R1
   * @param indexReleve $R2
   * @access public
   */
  public function __construct($Emplacement, $R1, $R2)
  {
    $this->Emplacement = $Emplacement;
    $this->R1 = $R1;
    $this->R2 = $R2;
  }

}
