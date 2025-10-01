<?php

class GetStatOccupantsGraph
{

  /**
   * 
   * @var string $SessionID
   * @access public
   */
  public $SessionID = null;

  /**
   * 
   * @var int $PkUser
   * @access public
   */
  public $PkUser = null;

  /**
   * 
   * @var string $typeGraph
   * @access public
   */
  public $typeGraph = null;

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
   * @param string $SessionID
   * @param int $PkUser
   * @param string $typeGraph
   * @param string $startDate
   * @param string $endDate
   * @access public
   */
  public function __construct($SessionID, $PkUser, $typeGraph, $startDate, $endDate)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->typeGraph = $typeGraph;
    $this->startDate = $startDate;
    $this->endDate = $endDate;
  }

}
