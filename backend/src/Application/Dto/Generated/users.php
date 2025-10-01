<?php

class users
{

  /**
   * 
   * @var User[] $ListeUsers
   * @access public
   */
  public $ListeUsers = null;

  /**
   * 
   * @param User[] $ListeUsers
   * @access public
   */
  public function __construct($ListeUsers)
  {
    $this->ListeUsers = $ListeUsers;
  }

}
