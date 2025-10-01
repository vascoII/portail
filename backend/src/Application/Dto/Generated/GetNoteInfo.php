<?php

class GetNoteInfo
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
   * @var string $Params
   * @access public
   */
  public $Params = null;

  /**
   * 
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param string $Params
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $Params)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->Params = $Params;
  }

}
