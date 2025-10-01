<?php

class serie
{

  /**
   * 
   * @var int $DefaultIntervalle
   * @access public
   */
  public $DefaultIntervalle = null;

  /**
   * 
   * @var string $ValeursXYL
   * @access public
   */
  public $ValeursXYL = null;

  /**
   * 
   * @var string $Annee
   * @access public
   */
  public $Annee = null;

  /**
   * 
   * @param int $DefaultIntervalle
   * @param string $ValeursXYL
   * @param string $Annee
   * @access public
   */
  public function __construct($DefaultIntervalle, $ValeursXYL, $Annee)
  {
    $this->DefaultIntervalle = $DefaultIntervalle;
    $this->ValeursXYL = $ValeursXYL;
    $this->Annee = $Annee;
  }

}
