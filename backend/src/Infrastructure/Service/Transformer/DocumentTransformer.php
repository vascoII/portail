<?php

declare(strict_types=1);

namespace App\Infrastructure\Service\Transformer;

use App\Application\Dto\Output\Document\SoapOutputDto;
use App\Application\Service\Transformer\DocumentTransformerInterface;

final class DocumentTransformer implements DocumentTransformerInterface
{
  public function transformInsertPrintJobs(object $dataSourceResult): SoapOutputDto
  {
    // Extract the ID from the SOAP response
    // Assuming the SOAP response contains an ID field
    $id = is_object($dataSourceResult) && isset($dataSourceResult->InsertPrintJobsResult)
      ? (int) $dataSourceResult->InsertPrintJobsResult
      : 0;

    return new SoapOutputDto(id: $id);
  }
}
