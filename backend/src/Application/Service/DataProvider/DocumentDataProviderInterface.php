<?php

declare(strict_types=1);

namespace App\Application\Service\DataProvider;

use App\Application\Dto\Output\Document\SoapOutputDto;

interface DocumentDataProviderInterface
{
  public function generateDocumentService(string $format, string $reportType, array $paramsFiltres): SoapOutputDto;
}
