<?php

class GetStatOccupants2
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
   * @var string $idClient
   * @access public
   */
  public $idClient = null;

  /**
   * 
   * @var string $startDate
   * @access public
   */
  public $startDate = null;

  /**
   * 
   * @var string $endDate
   * @access public
   */
  public $endDate = null;

  /**
   * 
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param string $idClient
   * @param string $startDate
   * @param string $endDate
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $idClient, $startDate, $endDate)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->idClient = $idClient;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
  }

}
