<?php

class GraphPoint
{

  /**
   * 
   * @var dateTime $date
   * @access public
   */
  public $date = null;

  /**
   * 
   * @var float $value
   * @access public
   */
  public $value = null;

  /**
   * 
   * @param dateTime $date
   * @param float $value
   * @access public
   */
  public function __construct($date, $value)
  {
    $this->date = $date;
    $this->value = $value;
  }

}
