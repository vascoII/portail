<?php

class GetReportByToken
{

  /**
   * 
   * @var string $SessionID
   * @access public
   */
  public $SessionID = null;

  /**
   * 
   * @var string $tokenid
   * @access public
   */
  public $tokenid = null;

  /**
   * 
   * @param string $SessionID
   * @param string $tokenid
   * @access public
   */
  public function __construct($SessionID, $tokenid)
  {
    $this->SessionID = $SessionID;
    $this->tokenid = $tokenid;
  }

}
