<?php

class logementCapteur
{

  /**
   * 
   * @var indexRecapDate $IndexRecapTemperature
   * @access public
   */
  public $IndexRecapTemperature = null;

  /**
   * 
   * @var indexRecapDate $IndexRecapHumidite
   * @access public
   */
  public $IndexRecapHumidite = null;

  /**
   * 
   * @var serie $SerieConsosTemperature
   * @access public
   */
  public $SerieConsosTemperature = null;

  /**
   * 
   * @var serie $SerieConsosHumidite
   * @access public
   */
  public $SerieConsosHumidite = null;

  /**
   * 
   * @param indexRecapDate $IndexRecapTemperature
   * @param indexRecapDate $IndexRecapHumidite
   * @param serie $SerieConsosTemperature
   * @param serie $SerieConsosHumidite
   * @access public
   */
  public function __construct($IndexRecapTemperature, $IndexRecapHumidite, $SerieConsosTemperature, $SerieConsosHumidite)
  {
    $this->IndexRecapTemperature = $IndexRecapTemperature;
    $this->IndexRecapHumidite = $IndexRecapHumidite;
    $this->SerieConsosTemperature = $SerieConsosTemperature;
    $this->SerieConsosHumidite = $SerieConsosHumidite;
  }

}
