<?php

class infosAppareilElect
{

  /**
   * 
   * @var appareil $Appareil
   * @access public
   */
  public $Appareil = null;

  /**
   * 
   * @param appareil $Appareil
   * @access public
   */
  public function __construct($Appareil)
  {
    $this->Appareil = $Appareil;
  }

}
