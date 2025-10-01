<?php

class releve
{

  /**
   * 
   * @var int $PkReleve
   * @access public
   */
  public $PkReleve = null;

  /**
   * 
   * @var dateTime $DateReleve
   * @access public
   */
  public $DateReleve = null;

  /**
   * 
   * @var string $TypeERC
   * @access public
   */
  public $TypeERC = null;

  /**
   * 
   * @param int $PkReleve
   * @param dateTime $DateReleve
   * @param string $TypeERC
   * @access public
   */
  public function __construct($PkReleve, $DateReleve, $TypeERC)
  {
    $this->PkReleve = $PkReleve;
    $this->DateReleve = $DateReleve;
    $this->TypeERC = $TypeERC;
  }

}
