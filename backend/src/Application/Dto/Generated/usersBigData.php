<?php

class usersBigData
{

  /**
   * 
   * @var User[] $ListeUsersBigData
   * @access public
   */
  public $ListeUsersBigData = null;

  /**
   * 
   * @param User[] $ListeUsersBigData
   * @access public
   */
  public function __construct($ListeUsersBigData)
  {
    $this->ListeUsersBigData = $ListeUsersBigData;
  }

}
