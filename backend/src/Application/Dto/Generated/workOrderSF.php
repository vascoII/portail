<?php

class workOrderSF
{

  /**
   * 
   * @var string $WorkOrderNumber
   * @access public
   */
  public $WorkOrderNumber = null;

  /**
   * 
   * @var string $Statut
   * @access public
   */
  public $Statut = null;

  /**
   * 
   * @var dateTime $SchedStartTime
   * @access public
   */
  public $SchedStartTime = null;

  /**
   * 
   * @var string $Tech_ArrivalStartTime
   * @access public
   */
  public $Tech_ArrivalStartTime = null;

  /**
   * 
   * @var string $Tech_ArrivalEndTime
   * @access public
   */
  public $Tech_ArrivalEndTime = null;

  /**
   * 
   * @var string $IdImm
   * @access public
   */
  public $IdImm = null;

  /**
   * 
   * @var string $CodeGestioImm
   * @access public
   */
  public $CodeGestioImm = null;

  /**
   * 
   * @var logement $Logement
   * @access public
   */
  public $Logement = null;

  /**
   * 
   * @var occupant $Occupant
   * @access public
   */
  public $Occupant = null;

  /**
   * 
   * @var WorkOrderLineItemSF[] $ListeWorkOrderLineItemSF
   * @access public
   */
  public $ListeWorkOrderLineItemSF = null;

  /**
   * 
   * @param string $WorkOrderNumber
   * @param string $Statut
   * @param dateTime $SchedStartTime
   * @param string $Tech_ArrivalStartTime
   * @param string $Tech_ArrivalEndTime
   * @param string $IdImm
   * @param string $CodeGestioImm
   * @param logement $Logement
   * @param occupant $Occupant
   * @param WorkOrderLineItemSF[] $ListeWorkOrderLineItemSF
   * @access public
   */
  public function __construct($WorkOrderNumber, $Statut, $SchedStartTime, $Tech_ArrivalStartTime, $Tech_ArrivalEndTime, $IdImm, $CodeGestioImm, $Logement, $Occupant, $ListeWorkOrderLineItemSF)
  {
    $this->WorkOrderNumber = $WorkOrderNumber;
    $this->Statut = $Statut;
    $this->SchedStartTime = $SchedStartTime;
    $this->Tech_ArrivalStartTime = $Tech_ArrivalStartTime;
    $this->Tech_ArrivalEndTime = $Tech_ArrivalEndTime;
    $this->IdImm = $IdImm;
    $this->CodeGestioImm = $CodeGestioImm;
    $this->Logement = $Logement;
    $this->Occupant = $Occupant;
    $this->ListeWorkOrderLineItemSF = $ListeWorkOrderLineItemSF;
  }

}
