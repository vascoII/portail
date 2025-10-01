<?php

class GetDetailsDepannage
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
   * @var string $WorkOrderNumber
   * @access public
   */
  public $WorkOrderNumber = null;

  /**
   * 
   * @param string $SessionID
   * @param int $PkUser
   * @param string $WorkOrderNumber
   * @access public
   */
  public function __construct($SessionID, $PkUser, $WorkOrderNumber)
  {
    $this->SessionID = $SessionID;
    $this->PkUser = $PkUser;
    $this->WorkOrderNumber = $WorkOrderNumber;
  }

}
