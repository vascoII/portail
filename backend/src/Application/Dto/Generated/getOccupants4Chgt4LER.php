<?php

class getOccupants4Chgt4LER
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
   * @var boolean $showArchive
   * @access public
   */
  public $showArchive = null;

  /**
   * 
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param boolean $showArchive
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $showArchive)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->showArchive = $showArchive;
  }

}
