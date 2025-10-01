<?php

class userLog
{

  /**
   * 
   * @var string $loginId
   * @access public
   */
  public $loginId = null;

  /**
   * 
   * @var dateTime $loginTime
   * @access public
   */
  public $loginTime = null;

  /**
   * 
   * @param string $loginId
   * @param dateTime $loginTime
   * @access public
   */
  public function __construct($loginId, $loginTime)
  {
    $this->loginId = $loginId;
    $this->loginTime = $loginTime;
  }

}
