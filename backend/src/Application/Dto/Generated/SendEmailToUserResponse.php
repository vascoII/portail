<?php

class SendEmailToUserResponse
{

  /**
   * 
   * @var retour $SendEmailToUserResult
   * @access public
   */
  public $SendEmailToUserResult = null;

  /**
   * 
   * @param retour $SendEmailToUserResult
   * @access public
   */
  public function __construct($SendEmailToUserResult)
  {
    $this->SendEmailToUserResult = $SendEmailToUserResult;
  }

}
