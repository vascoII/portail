<?php

class GetResetTokenIDValidation
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
   * @var string $TokenID
   * @access public
   */
  public $TokenID = null;

  /**
   * 
   * @var string $Salt
   * @access public
   */
  public $Salt = null;

  /**
   * 
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param string $TokenID
   * @param string $Salt
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $TokenID, $Salt)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->TokenID = $TokenID;
    $this->Salt = $Salt;
  }

}
