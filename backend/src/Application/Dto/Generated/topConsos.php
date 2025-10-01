<?php

class topConsos
{

  /**
   * 
   * @var dateTime $DateReleve
   * @access public
   */
  public $DateReleve = null;

  /**
   * 
   * @var Conso[] $consosGrandes
   * @access public
   */
  public $consosGrandes = null;

  /**
   * 
   * @var Conso[] $consosPetites
   * @access public
   */
  public $consosPetites = null;

  /**
   * 
   * @param dateTime $DateReleve
   * @param Conso[] $consosGrandes
   * @param Conso[] $consosPetites
   * @access public
   */
  public function __construct($DateReleve, $consosGrandes, $consosPetites)
  {
    $this->DateReleve = $DateReleve;
    $this->consosGrandes = $consosGrandes;
    $this->consosPetites = $consosPetites;
  }

}
