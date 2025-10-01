<?php

class appareil
{

  /**
   * 
   * @var int $PkAppareil
   * @access public
   */
  public $PkAppareil = null;

  /**
   * 
   * @var string $Numero
   * @access public
   */
  public $Numero = null;

  /**
   * 
   * @var string $Emplacement
   * @access public
   */
  public $Emplacement = null;

  /**
   * 
   * @var string $Fluide
   * @access public
   */
  public $Fluide = null;

  /**
   * 
   * @var string $TypeAppareil
   * @access public
   */
  public $TypeAppareil = null;

  /**
   * 
   * @var string $Unite
   * @access public
   */
  public $Unite = null;

  /**
   * 
   * @param int $PkAppareil
   * @param string $Numero
   * @param string $Emplacement
   * @param string $Fluide
   * @param string $TypeAppareil
   * @param string $Unite
   * @access public
   */
  public function __construct($PkAppareil, $Numero, $Emplacement, $Fluide, $TypeAppareil, $Unite)
  {
    $this->PkAppareil = $PkAppareil;
    $this->Numero = $Numero;
    $this->Emplacement = $Emplacement;
    $this->Fluide = $Fluide;
    $this->TypeAppareil = $TypeAppareil;
    $this->Unite = $Unite;
  }

}
