<?php

class GetFile
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
   * @var string $FileName
   * @access public
   */
  public $FileName = null;

  /**
   * 
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param string $FileName
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $FileName)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->FileName = $FileName;
  }

}
