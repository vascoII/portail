<?php

class setOccupants4Chgt4LER
{

  /**
   * 
   * @var string $SuperLoginID
   * @access public
   */
  public $SuperLoginID = null;

  /**
   * 
   * @var string $SuperPassword
   * @access public
   */
  public $SuperPassword = null;

  /**
   * 
   * @var Occupant4Chgt[] $occupants
   * @access public
   */
  public $occupants = null;

  /**
   * 
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param Occupant4Chgt[] $occupants
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $occupants)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->occupants = $occupants;
  }

}
