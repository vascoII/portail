<?php

class userExportParams
{

  /**
   * 
   * @var boolean $exportAll
   * @access public
   */
  public $exportAll = null;

  /**
   * 
   * @var string $exportFormat
   * @access public
   */
  public $exportFormat = null;

  /**
   * 
   * @param boolean $exportAll
   * @param string $exportFormat
   * @access public
   */
  public function __construct($exportAll, $exportFormat)
  {
    $this->exportAll = $exportAll;
    $this->exportFormat = $exportFormat;
  }

}
