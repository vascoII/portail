<?php

class indexRecapDate
{

  /**
   * 
   * @var dateTime $Date
   * @access public
   */
  public $Date = null;

  /**
   * 
   * @var float $Moy
   * @access public
   */
  public $Moy = null;

  /**
   * 
   * @var float $Max
   * @access public
   */
  public $Max = null;

  /**
   * 
   * @var float $Min
   * @access public
   */
  public $Min = null;

  /**
   * 
   * @param dateTime $Date
   * @param float $Moy
   * @param float $Max
   * @param float $Min
   * @access public
   */
  public function __construct($Date, $Moy, $Max, $Min)
  {
    $this->Date = $Date;
    $this->Moy = $Moy;
    $this->Max = $Max;
    $this->Min = $Min;
  }

}
