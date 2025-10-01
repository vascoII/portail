<?php

class occupant
{

  /**
   * 
   * @var int $PkOccupant
   * @access public
   */
  public $PkOccupant = null;

  /**
   * 
   * @var string $Nom
   * @access public
   */
  public $Nom = null;

  /**
   * 
   * @var string $Ref
   * @access public
   */
  public $Ref = null;

  /**
   * 
   * @var dateTime $DateArrivee
   * @access public
   */
  public $DateArrivee = null;

  /**
   * 
   * @var dateTime $DateDepart
   * @access public
   */
  public $DateDepart = null;

  /**
   * 
   * @param int $PkOccupant
   * @param string $Nom
   * @param string $Ref
   * @param dateTime $DateArrivee
   * @param dateTime $DateDepart
   * @access public
   */
  public function __construct($PkOccupant, $Nom, $Ref, $DateArrivee, $DateDepart)
  {
    $this->PkOccupant = $PkOccupant;
    $this->Nom = $Nom;
    $this->Ref = $Ref;
    $this->DateArrivee = $DateArrivee;
    $this->DateDepart = $DateDepart;
  }

}
