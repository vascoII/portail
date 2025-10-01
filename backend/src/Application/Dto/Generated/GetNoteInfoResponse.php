<?php

class GetNoteInfoResponse
{

  /**
   * 
   * @var base64Binary $GetNoteInfoResult
   * @access public
   */
  public $GetNoteInfoResult = null;

  /**
   * 
   * @param base64Binary $GetNoteInfoResult
   * @access public
   */
  public function __construct($GetNoteInfoResult)
  {
    $this->GetNoteInfoResult = $GetNoteInfoResult;
  }

}
