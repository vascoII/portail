<?php

class GetExportParams
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
   * @var string $clientName
   * @access public
   */
  public $clientName = null;

  /**
   * 
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param string $clientName
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $clientName)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->clientName = $clientName;
  }

}
