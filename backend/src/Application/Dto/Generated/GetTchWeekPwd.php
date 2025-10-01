<?php

class GetTchWeekPwd
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
   * @var dateTime $Date
   * @access public
   */
  public $Date = null;

  /**
   * 
   * @param string $SuperLoginID
   * @param string $SuperPassword
   * @param dateTime $Date
   * @access public
   */
  public function __construct($SuperLoginID, $SuperPassword, $Date)
  {
    $this->SuperLoginID = $SuperLoginID;
    $this->SuperPassword = $SuperPassword;
    $this->Date = $Date;
  }

}
