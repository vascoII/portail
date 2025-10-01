<?php

class GetFileResponse
{

  /**
   * 
   * @var base64Binary $GetFileResult
   * @access public
   */
  public $GetFileResult = null;

  /**
   * 
   * @param base64Binary $GetFileResult
   * @access public
   */
  public function __construct($GetFileResult)
  {
    $this->GetFileResult = $GetFileResult;
  }

}
