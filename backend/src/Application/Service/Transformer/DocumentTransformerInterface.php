<?php

declare(strict_types=1);

namespace App\Application\Service\Transformer;

use App\Application\Dto\Output\Document\SoapOutputDto;

interface DocumentTransformerInterface
{
  public function transformInsertPrintJobs(object $dataSourceResult): SoapOutputDto;
}
